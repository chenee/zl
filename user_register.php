<?php


$db = new mysqli('localhost', 'root', 'chenee', 'zl');

if($db->connect_errno > 0){
    die('Unable to connect to database (' . $db->connect_error . ')');
}

function generate_password( $length = 8 ) {
    // 密码字符集，可任意添加你需要的字符
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ (){}<>~`+=,.;:/?|';
    $password = "";

    for ( $i = 0; $i < $length; $i++ )
    {
    // 这里提供两种字符获取方式
    // 第一种是使用 substr 截取$chars中的任意一位字符；
    // 第二种是取字符数组 $chars 的任意元素
    // $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);
        $password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
    }
    return $password;
}

function check_input($value)
{
// 去除斜杠
    if (get_magic_quotes_gpc())
    {
        $value = stripslashes($value);
    }
// 如果不是数字则加引号
    if (!is_numeric($value))
    {
        $value = "'" . mysql_real_escape_string($value) . "'";
    }
    return $value;
}

function getRequest($value)
{
   return check_input($_REQUEST[$value]);
}

//judge whether already registered
$select_sql = "select wx_openid FROM user_info where wx_openid = ?";
$result = $db->prepare($select_sql);
$result->bind_param("s",$wx_openid);
//$wx_openid = "YL9ZSXz6";
$wx_openid = generate_password(8);

$result->execute();
if ($result->fetch()){//if is enough
    echo "already registered!";
    exit;
}


/*
$insert_sql = "insert into user_info (wx_openid,wx_nickname,wx_headimgurl,name, sex, birthday, cellphone, email,
company_name, company_address, experience, product_info,
source_info', register_time ) values ('$wx_openid','$wx_nickname','$wx_headimgurl',
'$name','$sex','$birthday','$cellphone','$email','$company_name','$company_address',
'$experience','$product_info','$source_info','$register_time'
 )";
*/

$insert_sql = "insert into user_info (wx_openid,wx_nickname,wx_headimgurl,name, sex, birthday, cellphone, email,
company_name, company_address, experience, product_info,
source_info, register_time ) values (?,?,?, ?,?,?,?,?,?,?, ?,?,?,?)";

$result = $db->prepare($insert_sql);

$result->bind_param("ssssisssssssss",
$wx_openid, $wx_nickname , $wx_headimgurl,
$name, $sex, $birthday,
$cellphone, $email, $company_name,
$company_address, $experience, $product_info,
$source_info, $register_time
);


//we will use weixin value later
/*
$wx_openid = getRequest("wx_openid");
$wx_nickname = getRequest("wx_nickname");
$wx_headimgurl = getRequest("wx_headimgurl");
*/
$wx_openid = generate_password(8);
$wx_nickname = generate_password(6);
$wx_headimgurl = generate_password(12);

$name = getRequest("name");
$sex = getRequest("sex");
$birthday = getRequest("birthday");

$cellphone = getRequest("cellphone");
$email = getRequest("email");
$company_name = getRequest("company_name");

$company_address = getRequest("company_address");
$experience = getRequest("experience");
$product_info = getRequest("product_info");

$source_info = getRequest("source_info");
$register_time =  '"'. time() . '"';


$result->execute();
if ($result->affected_rows > 0){
    echo "register ok!";
}

$result->free_result();

$db->close();
