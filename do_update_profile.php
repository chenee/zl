<?php

if(empty($_REQUEST["wx_openid"])){
    echo "获取微信信息出错!";
    exit;
}

require_once ("db.php");

$db = dbinit();
$insert_sql = "update user_info set name=?, sex=?, birthday=?, cellphone=?, email=?,
company_name=?, company_address=?, experience=?, product_info=?,
source_info=? where wx_openid=?";

$result = $db->prepare($insert_sql);

$result->bind_param("sisssssssss",
$name, $sex, $birthday, $cellphone, $email,
$company_name, $company_address, $experience, $product_info,
$source_info, $wx_openid
);


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
//get from last page,we donot change it for ever
$wx_openid = getRequest($db,"wx_openid");
$wx_openid = $_REQUEST["wx_openid"];
//$wx_nickname = getRequest($db,"wx_nickname");
//$wx_headimgurl = getRequest($db,"wx_headimgurl");


$result->execute();
if ($result->affected_rows > 0){
    echo "Update ok!";
}else{
    echo $result->error;
    echo "Update failed!";
}

$result->free_result();

$db->close();
