if (typeof AGG == "undefined") {
    var AGG = {};
}


$(function () {
    FastClick.attach(document.body);

    //获取用户上次定位信息
    AGG.latitude = localStorage.getItem("latitude");
    AGG.longitude = localStorage.getItem("longitude");
    AGG.cityname = localStorage.getItem("cityname");
    AGG.district = localStorage.getItem("district");
    AGG.isOne = sessionStorage.getItem('one');

    var isRefresh = false;
    var setCity = request("cityname");

    var WXshareData = {
        title: "爱个购",
        link: AGG.dynamic_url + "/index_o2o.html?client_type=wap",
        imgUrl: "http://shop.aigegou.com/agg/wap/images/smallLogo.png",
        desc: "中国第一家本土化生活消费购物手机分享平台，全新的商业模式，全新的消费理念，全方位的平台支持。"
    };


    if( (localStorage.getItem("key")&&(AGG.isWX)) || (!AGG.isWX) ){
        //判断用户是不是第一次进入首页
        if (AGG.isOne == null || request('fromRegister') == 1 || request('mustLocation') == 'yes') {
            sessionStorage.setItem('one', 1);
            $(".get-location").show();
            isRefresh = true;
        } else {
            if (setCity && (setCity != "undefined")) {
                AGG.cityname = setCity;
                localStorage.setItem("cityname", setCity);
                localStorage.setItem("district", '');
                ajaxDataTmpl(setCity, '', '31.337882', '120.616634');
                $(".get_area").html(setCity);
            } else {
                if (AGG.district == '' || AGG.district == null) {
                    $(".get_area").html(AGG.cityname);
                    ajaxDataTmpl(AGG.cityname, '', AGG.latitude, AGG.longitude);
                } else {
                    $(".get_area").html(AGG.district);
                    ajaxDataTmpl(AGG.cityname, AGG.district, AGG.latitude, AGG.longitude);
                }
            }
        }

        if (isRefresh) {
            if (AGG.isWX) {
                AGG.WXUtil.requestApi(function () {
                    if (isRefresh) {
                        wx.getLocation({
                            success: function (res) {
                                var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                                var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                                var data = {
                                    latitude: latitude,
                                    longitude: longitude
                                };
                                AGG.getLocation.cityname(data.latitude, data.longitude, function (datas) {
                                    getCityName(datas.cityname, datas.district, datas.latitude, datas.longitude);
                                });
                            },
                            cancel: function () {
                                //这个地方是用户拒绝获取地理位置
                                getLocation();
                            }
                        });
                    }
                    wx.onMenuShareTimeline(WXshareData);
                    wx.onMenuShareAppMessage(WXshareData);
                    wx.onMenuShareQQ(WXshareData);
                    wx.onMenuShareQZone(WXshareData);
                }, function(){
                    getLocationError();
                });
            } else {
                getLocation();
            }
        } else {
            AGG.WXUtil.requestApi(function () {
                wx.onMenuShareTimeline(WXshareData);
                wx.onMenuShareAppMessage(WXshareData);
                wx.onMenuShareQQ(WXshareData);
                wx.onMenuShareQZone(WXshareData);
            });
        }
    }




    function getLocationError() {
        localStorage.setItem("latitude", "31.337882");
        localStorage.setItem("longitude","120.616634");
        localStorage.setItem("district", '');
        layer.open({
            content: '定位失败，请手动设置城市',
            btn: ['选择城市', '取消'],
            shadeClose: false,
            yes: function () {
                window.location.href = WapSiteUrl + "/citylist.html";
            }, no: function () {
                var city = localStorage.getItem("cityname");
                if(city){
                    window.location.href = WapSiteUrl + "/index_o2o.html?cityname=" +city;
                }else{
                    window.location.href = WapSiteUrl + "/index_o2o.html?cityname=苏州市";
                }
            }
        });
    }

    //H5定位
    function getLocation() {
        AGG.getLocation.latAndLon(
            function (data) {
                AGG.getLocation.cityname(data.latitude, data.longitude, function (datas) {
                    getCityName(datas.cityname, datas.district, datas.latitude, datas.longitude);
                });
            }, getLocationError());
    }

    function getCityName(nowCity, nowDistrict, nowLat, nowLng) {
        if (isRefresh) {
            localStorage.setItem("nowCity", nowCity);
            if (AGG.latitude && AGG.longitude && AGG.cityname) {
                if (nowCity == AGG.cityname) {
                    if (AGG.district == '' || AGG.district == null) {
                        $(".get_area").html(AGG.cityname);
                        ajaxDataTmpl(AGG.cityname, '', AGG.latitude, AGG.longitude);
                    } else {
                        $(".get_area").html(AGG.district);
                        ajaxDataTmpl(AGG.cityname, AGG.district, AGG.latitude, AGG.longitude);
                    }
                } else {
                    new Win().newconfirm('', '系统定位您在' + nowCity + '，是否切换', function () {
                        AGG.latitude = nowLat;
                        AGG.longitude = nowLng;
                        AGG.cityname = nowCity;
                        AGG.district = nowDistrict;
                        addcookie("lat", AGG.latitude);
                        addcookie("lng", AGG.longitude);
                        addcookie("cityname", AGG.cityname);
                        addcookie("district", AGG.district);
                        localStorage.setItem("latitude", nowLat);
                        localStorage.setItem("longitude", nowLng);
                        localStorage.setItem("cityname", nowCity);
                        localStorage.setItem("district", '');
                        $(".get_area").html(nowCity);
                        ajaxDataTmpl(nowCity, '', nowLat, nowLng);
                    }, function () {
                        if (AGG.district == '' || AGG.district == null) {
                            $(".get_area").html(AGG.cityname);
                            ajaxDataTmpl(AGG.cityname, '', AGG.latitude, AGG.longitude);
                        } else {
                            $(".get_area").html(AGG.district);
                            ajaxDataTmpl(AGG.cityname, AGG.district, AGG.latitude, AGG.longitude);
                        }
                    })
                }
            } else {
                AGG.latitude = nowLat;
                AGG.longitude = nowLng;
                AGG.cityname = nowCity;
                AGG.district = nowDistrict;
                addcookie("lat", AGG.latitude);
                addcookie("lng", AGG.longitude);
                addcookie("cityname", AGG.cityname);
                addcookie("district", AGG.district);
                localStorage.setItem("latitude", nowLat);
                localStorage.setItem("longitude", nowLng);
                localStorage.setItem("cityname", nowCity);
                localStorage.setItem("district", '');
                $(".get_area").html(nowCity);
                ajaxDataTmpl(nowCity, '', nowLat, nowLng);
            }
        }
    }

    //区县列表
    function getDistrict(cityname, district) {
        $('#areaList').html('<li class="on">全部</li>');
        $.ajax({
            url: ApiUrl + "/index.php?act=unlimited_invitation&op=get_area_list&client_type=wap",
            type: "get",
            dataType: "jsonp",
            jsonp: "callback",
            success: function (data) {
                if (data.code == 200) {
                    var i = 0;
                    var cityList = data.data.city_district;
                    for (; i < cityList.length; i++) {
                        if (cityList[i].area_name == cityname) {
                            $(cityList[i].sub_area).each(function (vv, kk) {
                                if (kk.area_name == district) {
                                    $('#areaList li').removeClass('on');
                                    $('#areaList').append('<li class="on">' + kk.area_name + '</li>');
                                } else {
                                    $('#areaList').append('<li>' + kk.area_name + '</li>');
                                }
                            });
                            break;
                        }
                    }
                }
            }
        });
    }

    //获取分类图标
    $.ajax({
        url: ApiUrl + "/index.php?act=unlimited_invitation&op=get_class_in_home",
        type: "get",
        dataType: "jsonp",
        jsonp: "callback",
        success: function (data) {
            if (data.code == 200) {
                var typeDoTmpl = doT.template($("#typePBox-tmpl").html());
                $(".type").html(typeDoTmpl(data));
            }
        }
    });

    //今日推荐
    function today(latitude, longitude, cityname, district_name) {
        $.ajax({
            url: ApiUrl + "/index.php?act=unlimited_invitation&op=get_random_products&city_name=" + cityname + "&district_name=" + district_name + "&client_type=wap&limit=4",
            type: "get",
            dataType: "jsonp",
            jsonp: "callback",
            success: function (datap) {
                if (datap.code == 200) {
                    if (datap.data == null) {
                        $("#todayList").html('');
                    } else {
                        if (datap.data.length == 0) {
                            $("#todayList").html('');
                        } else {
                            datap.latitude = latitude;
                            datap.longitude = longitude;
                            var todayDoTmpl = doT.template($("#today-tmpl").html());
                            $("#todayList").html(todayDoTmpl(datap)).removeClass("loading");
                        }
                    }

                }
            }
        });
    }

    //猜你喜欢
    function like(latitude, longitude, cityname, district_name, pageN) {
        $.ajax({
            url: ApiUrl + "/index.php?act=unlimited_invitation&op=guess_your_like_goods&lat=" + latitude + "&lng=" + longitude + "&client_type=wap&city_name=" + cityname + "&district_name=" + district_name + "&curpage=" + pageN,
            type: "get",
            dataType: "jsonp",
            jsonp: "callback",
            success: function (data) {
                if (data.code == 200) {
                    if (data.data.length == 0) {
                        $(".like ul").html('');
                    } else {
                        data.latitude = latitude;
                        data.longitude = longitude;
                        for (var i = 0; i < data.data.length; i++) {
                            data.data[i].evaStar = parseInt(data.data[i].evaluation_good_star) * 20;
                            data.data[i].distance2 = (parseInt(data.data[i].distance) / 1000).toFixed(1);
                        }
                        var likeDoTmpl = doT.template($("#like-tmpl").html());
                        $(".like ul").html(likeDoTmpl(data)).removeClass("loading");
                    }
                }
            }
        });
    }

    function ajaxDataTmpl(cityname, district_name, latitude, longitude) {

        getDistrict(cityname, district_name);
        $('.getArea').text(cityname);

        $(".get-location").hide();

        //发现模块入口显示判断
        if (cityname == '苏州市') {
            $('.shareLink').show();
        } else {
            $('.shareLink').hide();
        }

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


        today(latitude, longitude, cityname, district_name);
        like(latitude, longitude, cityname, district_name, 1);

        $('#hotMore').unbind().on('click', function () {
            today(latitude, longitude, cityname, district_name);
        });
        var curpage = 1;
        $('#likeMore').unbind().on('click', function () {
            curpage++;
            like(latitude, longitude, cityname, district_name, curpage);
        })
    }

    var headS = {
        headBg: $('.head_bg'),
        addr: $('.address'),
        areaBg: $('.areaBg'),
        areaBox: $('.areaBox')
    };

    headS.addr.on('click', function () {
        if (headS.headBg.hasClass('headRed')) {
            headS.headBg.removeClass('headRed');
            headS.areaBg.hide();
            headS.areaBox.css('height', '0');
            $('body').css('overflow', 'auto');
        } else {
            headS.headBg.addClass('headRed');
            headS.areaBg.show();
            headS.areaBox.css('height', 'auto');
            $('body').css('overflow', 'hidden');
        }
    });

    $('#areaList').on('click', 'li', function () {
        AGG.district = $(this).text();
        if (AGG.district == '全部') {
            AGG.district = '';
            $(".get_area").html(AGG.cityname);
        } else {
            $(".get_area").html(AGG.district);
        }
        addcookie("district", AGG.district);
        localStorage.setItem("district", AGG.district);
        headS.headBg.removeClass('headRed');
        headS.areaBg.hide();
        headS.areaBox.css('height', '0');
        $('body').css('overflow', 'auto');
        ajaxDataTmpl(AGG.cityname, AGG.district, AGG.latitude, AGG.longitude);
    });

    window.onscroll = function () {
        var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        if (scrollTop > 100) {
            $(".head_bg").css({opacity: '1'});
        } else if (scrollTop < 100) {
            $(".head_bg").css({opacity: '0.3'});
        }
    };

    $("#searchInput").keyup(function () {
        if (event.keyCode == 13) {
            var store_name = $('#searchInput').val();
            window.location.href = WapSiteUrl + '/nearby.html?store_name=' + store_name;
        }
    });
    $('#clearInput').click(function () {
        $('#searchInput').val('');
    })

});

AGG.getLocation = {
    latAndLon: function (callback, error) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    var data = {
                        latitude: latitude,
                        longitude: longitude
                    };
                    if (typeof callback == "function") {
                        callback(data);
                    }
                },
                function () {
                    if (typeof error == "function") {
                        error();
                    }
                });
        } else {
            if (typeof error == "function") {
                error();
            }
        }
    },
    cityname: function (latitude, longitude, callback) {
        $.ajax({
            url: 'http://api.map.baidu.com/geocoder/v2/?ak=58sCjOGmpIii5wmxe33rTu9gG4nkA73u&callback=renderReverse&location=' + latitude + ',' + longitude + '&output=json&pois=1&coordtype=wgs84ll',
            type: "get",
            dataType: "jsonp",
            jsonp: "callback",
            success: function (data) {
                var cityname = data.result.addressComponent.city;
                var district = data.result.addressComponent.district;

                // var province = data.result.addressComponent.province;
                // var street = data.result.addressComponent.street;
                // var street_number = data.result.addressComponent.street_number;
                // var formatted_address = data.result.formatted_address;
                // localStorage.setItem("province", province);
                // localStorage.setItem("street", street);
                // localStorage.setItem("street_number", street_number);
                // localStorage.setItem("formatted_address", formatted_address);

                var data = {
                    latitude: latitude,
                    longitude: longitude,
                    cityname: cityname,
                    district: district
                };
                if (typeof callback == "function") {
                    callback(data);
                }

            }
        });
    },
    setDefaultCity: function (callback) {
        //默认经纬度
        var latitude = "31.337882";
        var longitude = "120.616634";
        var cityname = "苏州市";
        var district = "虎丘区";
        var data = {
            latitude: latitude,
            longitude: longitude,
            cityname: cityname,
            district: district
        };
        if (typeof callback == "function") {
            callback(data);
        }
    },
    refresh: function (callback) {
        var that = this;
        //重新获取经纬度和城市街道并设置到localStorage
        that.latAndLon(
            function (data) {
                that.cityname(data.latitude, data.longitude, function (datas) {
                    if (typeof callback == "function") {
                        callback();
                    }
                });
            },
            function () {
                that.setDefaultCity(function () {
                    if (typeof callback == "function") {
                        callback();
                    }
                });
            });
    }
};



