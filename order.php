<!DOCTYPE html>
<!-- saved from url=(0062)http://localhost:63342/src/tmp/%E7%88%B1%E4%B8%AA%E8%B4%AD.htm -->
<html slick-uniqueid="3" style="font-size: 50px;">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <title>E2P</title>
    <link rel="stylesheet" href="static/build_index_o2o.min.css">
    <link href="static/wap-stylev2.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php
require_once("wx_info.php");
require_once("db.php");

//judge whether already registered
$select_sql = "select * FROM srv_electronic where wx_openid = ? ORDER BY id DESC";
$result = $db->prepare($select_sql);
$result->bind_param("s", $wx_openid);
$wx_openid = $wxinfo->openid;

$result->bind_result(
    $id,
    $wx_openid, $project_name, $requirement,
    $number, $requiretime, $current,
    $nexttime, $endtime, $ordertime
);

$result->execute();
?>

<div id="con" class="wide gt320 app">
    <div class="nlt new"><h4>我的服务订单</h4>
        <ul id="categorylist">
            <?php
            while ($result->fetch()) {
                ?>
                <li>
                    <a href="order_detail.php?wx_openid=<?php echo $wx_openid; ?>&type=electronic&orderid=<?php echo $id; ?>">
                        <span class="date"><?php echo date("Y-m-d",$ordertime);?></span> <span
                            class="title"> <?php echo $project_name;?></span> </a></li>
                <?php
            };
            ?>
        </ul>
    </div>


</div>
</body>
</html>