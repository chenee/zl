<?php
require_once ("wx_info.php");
require_once ("db.php");

//judge whether already registered
$select_sql = "select wx_openid FROM user_info where wx_openid = ?";
$result = $db->prepare($select_sql);
$result->bind_param("s",$wx_openid);
$wx_openid = $wxinfo->openid;

$result->execute();
if ($result->fetch()){//if is enough
    echo "already registered!";
    exit;
}


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
    <input type="hidden" name="wx_openid" value=<?php echo $wxinfo->openid ?> />
    <input type="hidden" name="wx_nickname" value=<?php echo $wxinfo->nickname ?> />
    <input type="hidden" name="wx_headimgurl" value=<?php echo $wxinfo->headimgurl ?> />
    <img width="200" height="200" src="<?php echo $wxinfo->headimgurl ?>">
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



