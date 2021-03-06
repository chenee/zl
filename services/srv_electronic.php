<!DOCTYPE html>
<!-- saved from url=(0051)http://www.js-css.cn/divcss/admin/mac/register.html -->
<html lang="en" slick-uniqueid="3">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


    <!-- Title and other stuffs -->
    <title>电子类服务申请</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <!-- Stylesheets -->
    <link href="../static_register/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="static_register/font-awesome.css">
    <link href="../static_register/style.css" rel="stylesheet">
    <link href="../static_register/bootstrap-responsive.css" rel="stylesheet">

    <!-- Favicon -->
</head>
<?php
if(empty($_REQUEST["wx_openid"])){
    echo "<h4> 未取得微信信息 </h4>";
    //exit;
} else{
//    echo "<h4>". $_REQUEST['wx_openid'] . " </h4>";
}
?>
<body>
<div class="admin-form">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Widget starts -->
                <div class="widget wred">
                    <div class="widget-head">
                        <i class="icon-lock"></i> Register
                    </div>
                    <div class="widget-content">
                        <div class="padd">

                            <form action="../wxpayapi/example/do_pay.php" method="POST" class="form-horizontal">
                                <!-- Registration form starts -->
                                <input type="hidden" name="wx_openid" value=<?php echo $_REQUEST["wx_openid"] ?> />
                                <!-- Project Name-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="project_name">项目名称</label>

                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="product_name" name="project_name">
                                    </div>
                                </div>
                                <!-- 物流需求-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="requirement">物流需求</label>

                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="requirement" name="requirement">
                                    </div>
                                </div>
                                <!-- 需求数量-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="number">需求数量</label>

                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="number" name="number">
                                    </div>
                                </div>
                                <!-- 求料时间-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="requiretime">求料时间</label>

                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="requirtime" name="requiretime">
                                    </div>
                                </div>
                                <!-- 当前进度-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="current">当前进度</label>

                                    <div class="col-lg-9">
                                        <select class="form-control" id="current" name="current">
                                            <option value=0>&nbsp;</option>
                                            <option value="研发阶段">研发阶段</option>
                                            <option value="样机阶段">样机阶段</option>
                                            <option value="小批阶段">小批阶段</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- 下一阶段时间-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="nexttime">下一阶段时间</label>

                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="nexttime" name="nexttime">
                                    </div>
                                </div>
                                <!-- 上市时间-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="endtime">上市时间</label>

                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="endtime" name="endtime">
                                    </div>
                                </div>

                                <!-- Accept box and button s-->
                                <div class="form-group">
                                    <div class="col-lg-9 col-lg-offset-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> 本人接受合作协议<a href="www.baidu.com">《合作协议内容》</a>
                                            </label>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-danger">Apply</button>
                                        <button type="reset" class="btn btn-success">Reset</button>
                                    </div>
                                </div>
                                <br>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- JS -->
<script src="static_register/jquery.js"></script>
<script src="static_register/bootstrap.js"></script>

</body>
</html>