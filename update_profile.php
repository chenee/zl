<?php
require_once ("db.php");


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
if (empty($_REQUEST["wx_openid"])){
    $wx_openid = generate_password(8);
}else{
    $wx_openid = getRequest($db,"wx_openid");
}
if (empty($_REQUEST["wx_nickname"])){
    $wx_nickname = generate_password(6);
}else{
    $wx_nickname = getRequest($db,"wx_nickname");
}
if (empty($_REQUEST["wx_headimgurl"])){
    $wx_headimgurl = generate_password(12);
}else{
    $wx_headimgurl = getRequest($db,"wx_headimgurl");
}

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
$register_time =  '"'. time() . '"';


$result->execute();
if ($result->affected_rows > 0){
    echo "register ok!";
}

$result->free_result();

$db->close();
