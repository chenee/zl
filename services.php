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
</head>

<body>

<div class="banner">
    <div class="swiper-container loading" style="visibility: visible;">
        <div class="swiper-wrapper" style="width: 1500px;">
            <div class="swiper-slide" data-index="0"
                 style="width: 375px; left: 0px; transition-duration: 400ms; transform: translate(0px, 0px) translateZ(0px);">
                <img src="static/s2_05229536260870862.jpg" alt=""></div>
            <div class="swiper-slide" data-index="1"
                 style="width: 375px; left: -375px; transition-duration: 0ms; transform: translate(375px, 0px) translateZ(0px);">
                <img src="static/s2_05251828738020061.jpg" alt="招商会广告图"></div>
            <div class="swiper-slide" data-index="2"
                 style="width: 375px; left: -750px; transition-duration: 400ms; transform: translate(-375px, 0px) translateZ(0px);">
                <img src="static/s2_05275310284521992.jpg" alt="新疆叭咂嘿"></div>
        </div>
    </div>
</div>
<div class="content">
    <!--分类-->
    <ul class="type p_box">
        <li><a href="http://www.baidu.com" class="react"> <img src="static/3.png"> <p>美食</p></a></li>
        <li><a href="http://www.baidu.com" class="react"> <img src="static/3.png"> <p>美食</p></a></li>
        <li><a href="http://www.baidu.com" class="react"> <img src="static/3.png"> <p>美食</p></a></li>
        <li><a href="http://www.baidu.com" class="react"> <img src="static/3.png"> <p>美食</p></a></li>
        <li><a href="http://www.baidu.com" class="react"> <img src="static/3.png"> <p>美食</p></a></li>
        <li><a href="http://www.baidu.com" class="react"> <img src="static/3.png"> <p>美食</p></a></li>
        <li><a href="http://www.baidu.com" class="react"> <img src="static/3.png"> <p>美食</p></a></li>
        <li><a href="http://www.baidu.com" class="react"> <img src="static/3.png"> <p>美食</p></a></li>
    </ul>
    <!--猜你喜欢-->
    <div class="like p_box">
        <div class="title">
            <!--<a id="likeMore" class="more">换一批</a>-->猜你喜欢
        </div>
        <ul class="">
            <li>
                <a href="http://www.baidu.com" class="react">
                    <div class="goods_img"> <img src="static/2.jpg"> </div>
                    <div class="goods-name">2016简约大方女神范</div>
                    <p><span class="store-name">小时代</span> <span class="distance">3.2km</span></p>

                    <p><span class="eva-star"><i style="width: 0%"></i></span> <span class="eva-num">0评价</span></p>

                    <p class="goods-info"><span class="goods-price"><strong>￥180</strong><i>门市价￥180</i></span> <span
                            class="num">已售1</span></p></a></li>
            <li>
                <a href="http://www.baidu.com" class="react">
                    <div class="goods_img"> <img src="static/2.jpg"> </div>
                    <div class="goods-name">2016简约大方女神范</div>
                    <p><span class="store-name">小时代</span> <span class="distance">3.2km</span></p>

                    <p><span class="eva-star"><i style="width: 0%"></i></span> <span class="eva-num">0评价</span></p>

                    <p class="goods-info"><span class="goods-price"><strong>￥180</strong><i>门市价￥180</i></span> <span
                            class="num">已售1</span></p></a></li>
            <li>
                <a href="http://www.baidu.com" class="react">
                    <div class="goods_img"> <img src="static/2.jpg"> </div>
                    <div class="goods-name">2016简约大方女神范</div>
                    <p><span class="store-name">小时代</span> <span class="distance">3.2km</span></p>

                    <p><span class="eva-star"><i style="width: 0%"></i></span> <span class="eva-num">0评价</span></p>

                    <p class="goods-info"><span class="goods-price"><strong>￥180</strong><i>门市价￥180</i></span> <span
                            class="num">已售1</span></p></a></li>
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