<?php
$appid=wxbc5b302c49712761;
$appsecret=a0819adf247e075d4c4b9fa9f1c1c7f0;

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

        $res2 = json_decode($ret);
        //echo "<img src=$res2->headimgurl>";
    }

}

$lastpage = $_REQUEST['lastpage'];
echo "from this page:   $lastpage";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- TemplateBeginEditable name="doctitle" -->
    <title>注册界面</title>
    <!-- TemplateEndEditable -->
    <!-- TemplateBeginEditable name="head" -->
    <!-- TemplateEndEditable -->
</head>
<form action="user_register.php" method="POST">
    <input type="hidden" name="wx_openid" value=<?php echo $res2->openid ?> />
    <input type="hidden" name="wx_nickname" value=<?php echo $res2->nickname ?> />
    <input type="hidden" name="wx_headimgurl" value=<?php echo $res2->headimgurl ?> />
    <img src="<?php echo $res2->headimgurl ?>">
    <p>姓名 <input type="text" name="name" /><br/>

    <p>性别 <input type="text" name="sex" /><br/>

    <p>出生年月 <input type="text" name="birthday"/> <br/>

    <p>电话号码 <input type="text" name="cellphone"/> <br/>
    <p>Email <input type="text" name="email"/> <br/>
    <p>公司名称 <input type="text" name="company_name"/> <br/>
    <p>办公地址 <input type="text" name="company_address"/> <br/>
    <p>工作经历 <input type="text" name="experience"/> <br/>
    <p>产品简介</p> <input type="text" name="product_info"/> <br/>
    <p>所缺资源说明</p> <input type="text" name="source_info"/> <br/>

    <input type="submit" value="注册" />&nbsp;
    <input type="reset" value="重置"/>
</form>
<body>
</body>
</html>



