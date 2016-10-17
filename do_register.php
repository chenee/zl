<?php
require_once (dirname(__FILE__)."db.php");

//********** session ,cookie need!!!
//judge whether already registered
/*
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
*/


/*
$insert_sql = "insert into user_info (wx_openid,wx_nickname,wx_headimgurl,name, sex, birthday, cellphone, email,
company_name, company_address, experience, product_info,
source_info', register_time ) values ('$wx_openid','$wx_nickname','$wx_headimgurl',
'$name','$sex','$birthday','$cellphone','$email','$company_name','$company_address',
'$experience','$product_info','$source_info','$register_time'
 )";
*/
$db = dbinit();
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


//check wx info
if (empty($_REQUEST["wx_openid"])){
    echo "<h1> wx openid is null!</h1>";
    exit;
}

$wx_openid = getRequest($db,"wx_openid");
$wx_nickname = getRequest($db,"wx_nickname");
$wx_headimgurl = getRequest($db,"wx_headimgurl");

$name = getRequest($db,"name");
$sex = getRequest($db,"sex");
$birthday = getRequest($db,"birthday");

$cellphone = getRequest($db,"cellphone");
$email = getRequest($db,"email");
$company_name = getRequest($db,"company_name");

$company_address = getRequest($db,"company_address");
$experience = getRequest($db,"experience");
$product_info = getRequest($db,"product_info");

$source_info = getRequest($db,"source_info");
$register_time =  time();


$result->execute();
if ($result->affected_rows > 0){
    $newURL = "services.php?wx_openid=$wx_openid";
    echo "<h1>register ok!</h1><a href='$newURL' >申请服务</a> ";
    //header('Location: '.$newURL);
}

$result->free_result();

$db->close();
