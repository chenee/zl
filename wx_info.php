<?php
require_once(dirname(__FILE__)."wxid.php");

$code = $_REQUEST["code"];

//$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=' + $appid + '&secret='+ $appsecret + '&code='+ $code +'&grant_type=authorization_code';
$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";


function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
    // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);
    curl_close($curl);

    return $res;
  }

/*
{
   "access_token":"ACCESS_TOKEN",
   "refresh_token":"REFRESH_TOKEN",
   "openid":"OPENID",
   "scope":"SCOPE"
}
*/

$res = json_decode(httpGet($url));
$access_token = $res->access_token;
if ($access_token) {
    $openid = $res->openid;
    if ($openid) {
        $url2 = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";

        $ret = httpGet($url2);
        //echo $ret;

        $wxinfo = json_decode($ret);
        //echo "<img src=$wxinfo->headimgurl>";
    }

}
else{
   echo "<h1>access_token is null!!</h1>" ;//debug
}
