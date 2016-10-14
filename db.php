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

function check_input($db,$value)
{
// 去除斜杠
if (get_magic_quotes_gpc())
{
$value = stripslashes($value);
}
// 如果不是数字则加引号
if (!is_numeric($value))
{
$value = "'" . mysqli_real_escape_string($db,$value) . "'";
}
return $value;
}

function getRequest($db,$value)
{
return check_input($db,$_REQUEST[$value]);
}