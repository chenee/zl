<?
$appid='wxbc5b302c49712761';
$appsecret='a0819adf247e075d4c4b9fa9f1c1c7f0';

$redirect_url = urlencode("http://zl.chenee.cn/zl/redirect.php?lastpage=1");

$newURL = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_url&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";

header('Location: '.$newURL);

