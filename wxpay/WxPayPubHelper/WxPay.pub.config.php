<?php
/**
* 	配置账号信息
*/

class WxPayConf_pub
{
	//=======【基本信息设置】=====================================
	//微信公众号身份的唯一标识。审核通过后，在微信发送的邮件中查看
	const APPID = 'wx9756628d86fa20fc';
	//JSAPI接口中获取openid，审核后在公众平台开启开发模式后可查看
	const APPSECRET = 'aa4c2500bcfa15901ed6915a5201a15a';
	//受理商ID，身份标识
	const MCHID = '1341253301';
	//商户支付密钥Key。审核通过后，在微信发送的邮件中查看
	//https://pay.weixin.qq.com/index.php/core/cert/api_cert 在这里修改.看微信发给19841433@qq.com的邮件
	const KEY = 'c1h2e3n4e5e6i7s8p9i0gc1h2e3n4e5e';

	//=======【JSAPI路径设置】===================================
	//获取access_token过程中的跳转uri，通过跳转将code传入jsapi支付页面
	const JS_API_CALL_URL = 'http://zl.chenee.cn/zl/wxpay/demo/js_api_call.php';
	
	//=======【证书路径设置】=====================================
	//证书路径,注意应该填写绝对路径
	const SSLCERT_PATH = '/xxx/xxx/xxxx/WxPayPubHelper/cacert/apiclient_cert.pem';
	const SSLKEY_PATH = '/xxx/xxx/xxxx/WxPayPubHelper/cacert/apiclient_key.pem';
	
	//=======【异步通知url设置】===================================
	//异步通知url，商户根据实际开发过程设定
	const NOTIFY_URL = 'http://zl.chenee.cn/zl/wxpay/demo/notify_url.php';

	//=======【curl超时设置】===================================
	//本例程通过curl使用HTTP POST方法，此处可修改其超时时间，默认为30秒
	const CURL_TIMEOUT = 30;
}
	
?>