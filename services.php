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
    if(isset($_REQUEST["wx_openid"])){
         $wx_openid = $_REQUEST["wx_openid"];
    } else{
        require_once("wx_info.php");
        $wx_openid = $wxinfo->openid;
    }
?>

<div class="banner">
    <div class="swiper-container loading" style="visibility: visible;">
        <div class="swiper-wrapper" style="width: 1500px;">
            <div class="swiper-slide" data-index="0"
                 style="width: 375px; left: 0px; transition-duration: 400ms; transform: translate(0px, 0px) translateZ(0px);">
                <a href="http://www.baidu.com"> <img src="static/banner1.jpg" alt=""> </a>
            </div>
            <div class="swiper-slide" data-index="1"
                 style="width: 375px; left: -375px; transition-duration: 0ms; transform: translate(375px, 0px) translateZ(0px);">
                <a href="http://www.baidu.com"> <img src="static/banner2.jpg" alt=""> </a>
            </div>
            <div class="swiper-slide" data-index="2"
                 style="width: 375px; left: -750px; transition-duration: 400ms; transform: translate(-375px, 0px) translateZ(0px);">
                <a href="http://www.baidu.com"> <img src="static/banner3.jpg" alt=""> </a>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <!--分类-->
    <div class="nlt new" style="height: 4px"><h4></h4></div>
    <ul class="type p_box">
        <li><a href="services/srv_electronic.php?wx_openid=<?php echo $wx_openid; ?>" class="react"> <img
                    src="static/3.png">

                <p>电子</p></a></li>
        <li><a href="http://www.baidu.com" class="react"> <img src="static/3.png">

                <p>ID/MD</p></a></li>
        <li><a href="http://www.baidu.com" class="react"> <img src="static/3.png">

                <p>模塑</p></a></li>
        <li><a href="http://www.baidu.com" class="react"> <img src="static/3.png">

                <p>PCB/FP</p></a></li>
        <li><a href="http://www.baidu.com" class="react"> <img src="static/3.png">

                <p>SMT</p></a></li>
        <li><a href="http://www.baidu.com" class="react"> <img src="static/3.png">

                <p>包装</p></a></li>
        <li><a href="http://www.baidu.com" class="react"> <img src="static/3.png">

                <p>EMS</p></a></li>
        <li><a href="http://www.baidu.com" class="react"> <img src="static/3.png">

                <p>定制化服务</p></a></li>
    </ul>
</div>
<div id="con" class="wide gt320 app">
    <div class="nlt new"><h4>业界动态</h4>
        <ul id="categorylist">
            <li><a href="http://www.baidu.com"> <span class="date">2016-3-15</span> <span
                        class="title"> 关于E2P服务的相关说明和协议</span> </a></li>
            <li><a href="http://www.baidu.com"> <span class="date">2016-1-22</span> <span class="title"> 关于E2P深度合作服务的资费说明</span>
                </a></li>
            <li><a href="http://wap.ithome.com/html/202794.htm"> <span class="date">2016-1-22</span> <span
                        class="title"> 年底交答卷 周鸿祎去深圳做机一整年整出个啥</span> </a></li>
            <li><a href="http://wap.ithome.com/html/202793.htm"> <span class="date">2016-1-22</span> <span
                        class="title"> 五大平台红包一个都不落 360手机卫士抢红包专版正式上线</span> </a></li>
            <li><a href="http://wap.ithome.com/html/202778.htm"> <span class="date">2016-1-22</span> <span
                        class="title"> 在中国，为中国——戴尔商用渠道合作伙伴答谢晚宴在北京举行</span> </a></li>
            <li><a href="http://wap.ithome.com/html/202777.htm"> <span class="date">2016-1-22</span> <span
                        class="title"> 春节红包战况前瞻：360手机助手3.6亿现金红包上演诺曼底登陆</span> </a></li>
            <li><a href="http://wap.ithome.com/html/202773.htm"> <span class="date">2016-1-22</span> <span
                        class="title"> 第三方数据机构发布报告 今日头条个性化推荐方式成新闻APP发展趋势</span> </a></li>
            <li><a href="http://wap.ithome.com/html/202772.htm"> <span class="date">2016-1-22</span> <span
                        class="title"> 36氪2015年度最佳二次元社区产品评选，第一弹再次斩获高评价。</span> </a></li>

        </ul>
    </div>


</div>
<script type="text/javascript" src="static/zepto.fastclick.doT.layer.min.js"></script>
<script type="text/javascript" src="static/swipe.js"></script>
<script>
    //swiper
    document.removeEventListener("swipe", '#swiper-container', true);
    $('.swiper-container').each(function () {
        if ($(this).find('.swiper-slide').length < 2) {
            return;
        }
        Swipe(this, {
            startSlide: 2,
            speed: 400,
            auto: 3000,
            continuous: true,
            disableScroll: false,
            stopPropagation: false,
            callback: function (index, elem) {
            },
            transitionEnd: function (index, elem) {
            }
        });
    });
</script>
</body>
</html>