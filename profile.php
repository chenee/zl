<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- TemplateBeginEditable name="doctitle" -->
<title>更新界面</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>
<body>
<?php
require_once ("db.php");
require_once("wx_info.php");

//judge whether already registered
$select_sql = "select * FROM user_info where wx_openid = ?";
$result = $db->prepare($select_sql);
$result->bind_param("s",$wx_openid);
//$wx_openid = "}}XyhKE{";
//$wx_openid = generate_password(8);
$wx_openid = $wxinfo->openid;

$result->bind_result(
	$wx_openid, $wx_nickname , $wx_headimgurl,
	$name, $sex, $birthday,
	$cellphone, $email, $company_name,
	$company_address, $experience, $product_info,
	$source_info, $register_time
);

$result->execute();
if ($result->fetch()){//if is enough
}else{
    echo "<br> 需要先注册 <a href='user_register.html'> 注册通道</a> </br>";
    exit;
};
?>
	<form action="update_profile.php" method="POST">
        <input type="hidden" name="wx_openid" value=<?php echo $wx_openid ?> />
        <input type="hidden" name="wx_nickname" value=<?php echo $wx_nickname ?> />
        <input type="hidden" name="wx_headimgurl" value=<?php echo $wx_headimgurl ?> />
        <img width="200" height="200" src="<?php echo $wxinfo->headimgurl ?>">
        
		<p>姓名 <input type="text" name="name" value=<?php echo $name ?> /><br/>

		<p>性别 <input type="text" name="sex" value=<?php echo $sex ?> /><br/>

		<p>出生年月 <input type="text" name="birthday" value=<?php echo $birthday ?> /> <br/>

		<p>电话号码 <input type="text" name="cellphone" value=<?php echo $cellphone ?> /><br/>
		<p>Email <input type="text" name="email" value=<?php echo $email ?> /><br/>
		<p>公司名称 <input type="text" name="company_name" value=<?php echo $company_name ?> /> <br/>
		<p>办公地址 <input type="text" name="company_address" value=<?php echo $company_address ?> /> <br/>
		<p>工作经历 <input type="text" name="experience" value=<?php echo $experience ?> /> <br/>
		<p>产品简介</p> <input type="text" name="product_info" value=<?php echo $product_info ?> /> <br/>
		<p>所缺资源说明</p> <input type="text" name="source_info" value=<?php echo $source_info ?> /> <br/>

		<input type="submit" value="更新" />&nbsp;
		<input type="reset" value="重置"/>
	</form>
<body>
</body>
</html>