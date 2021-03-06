<?php
//get form info

//$requestdata=array(
//    "wx_openid" => $_REQUEST["wx_openid"],
//    "project_name" => $_REQUEST["project_name"],
//    "requirement" => $_REQUEST["requirement"],
//    "number" => $_REQUEST["number"],
//    "requiretime" => $_REQUEST["requiretime"],
//    "current" => $_REQUEST["current"],
//    "nexttime" => $_REQUEST["nexttime"],
//    "endtime" => $_REQUEST["endtime"],
//);
//$formdata = json_encode($requestdata);
//echo "====================";
//echo $formdata;
//echo "====================";

ini_set('date.timezone','Asia/Shanghai');
//error_reporting(E_ERROR);
require_once dirname(__FILE__)."/../lib/WxPay.Api.php";
require_once dirname(__FILE__)."/WxPay.JsApiPay.php";
require_once dirname(__FILE__).'/log.php';

//初始化日志
$logHandler= new CLogFileHandler("../logs/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);

//打印输出数组信息
function printf_info($data)
{
    foreach($data as $key=>$value){
        echo "<font color='#00ff55;'>$key</font> : $value <br/>";
    }
}

//①、获取用户openid
$tools = new JsApiPay();
//$openId = $tools->GetOpenid();
$openId = $_REQUEST["wx_openid"];

//②、统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody("E2P服务");
$input->SetAttach("E2P服务");

$_REQUEST["out_trade_no"] = WxPayConfig::MCHID.date("YmdHis");
$input->SetOut_trade_no($_REQUEST["out_trade_no"]);

$_REQUEST["fee"] = "1";
$input->SetTotal_fee($_REQUEST["fee"]);

$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag("E2P服务");
//$input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
//$input->SetNotify_url(dirname('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']).'/notify.php');
$input->SetNotify_url("http://zl.chenee.cn/zl/wxpayapi/example/notify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);
$order = WxPayApi::unifiedOrder($input);
echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
printf_info($order);
$jsApiParameters = $tools->GetJsApiParameters($order);

//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
/**
 * 注意：
 * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
 * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
 * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
 */
//order step 1
require_once dirname(__FILE__)."/../../services/do_electronic.php";
$ret = do_electronic_step1();
?>

<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>微信支付样例-支付</title>
	<script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
	<script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);

				// 使用以下方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回    ok，但并不保证它绝对可靠。
//                alert("MSG:"+res.err_msg);
                if(res.err_msg == "get_brand_wcpay_request:ok"){
                    alert("支付成功,查看订单");
                    window.location.href="http://zl.chenee.cn/zl/order.php?wx_openid=<?php echo $_REQUEST['wx_openid'];?>";

                    //ajax post
//					$.ajax({
//						url : "../../services/do_electronic.php",
//						type: "POST",
//						data : <?php //echo $formdata;?>//,
//						success: function(data, textStatus, jqXHR) {
//							//data - response from server
//							alert("data:"+data);
//							window.location.href="http://zl.chenee.cn/zl/order.php";
//						},
//						error: function (jqXHR, textStatus, errorThrown) {
//							alert("error:");
//
//						}
//					});

				}else{
					//alert("支付失败:".res.err_msg);
				};
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
	</script>
	<script type="text/javascript">
	//获取共享地址

	window.onload = function(){
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        //document.addEventListener('WeixinJSBridgeReady', editAddress, false);
				document.addEventListener('WeixinJSBridgeReady',  false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady');
		        document.attachEvent('onWeixinJSBridgeReady');
		    }
		}else{
			//editAddress();
		}
	};
	
	</script>
</head>
<body>
    <br/>
    <h5><?php echo $ret;?></h5>
    <br/>
    <font color="#9ACD32"><b>该笔订单支付金额为<span style="color:#f00;font-size:50px">1分</span>钱</b></font><br/><br/>
	<div align="center">
		<button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >立即支付</button>
	</div>
</body>
</html>
