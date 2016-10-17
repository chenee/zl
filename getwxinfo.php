<?
require_once(dirname(__FILE__)."/wxid.php");

$next=$_REQUEST["next"];


$redirect_url = urlencode("http://zl.chenee.cn/zl/$next.php");
#$scope = snsapi_base;
$scope = snsapi_userinfo;

$newURL = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_url&response_type=code&scope=$scope&state=STATE#wechat_redirect";

header('Location: '.$newURL);

