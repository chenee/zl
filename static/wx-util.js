if (typeof AGG == "undefined") {
    var AGG = {};
}

$(function(){
    function randomString(len) {
        len = len || 20;
        var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';
        var maxPos = $chars.length;
        var pwd = '';
        for (var i = 0; i < len; i++) {
            pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
        }
        return pwd;
    }

    var ranStr=randomString();
    var nurl = encodeURIComponent(document.URL.split('#')[0]);
    var timestamp = (new Date().getTime());
    timestamp = parseInt(timestamp / 1000);
    var defaultApiList = [
        'checkJsApi',
        'onMenuShareTimeline',
        'onMenuShareAppMessage',
        'onMenuShareQQ',
        'onMenuShareQZone',
        'getLocation',
        'chooseWXPay',
        'translateVoice',
        'startRecord',
        'stopRecord',
        'onVoiceRecordEnd',
        'playVoice',
        'pauseVoice',
        'stopVoice',
        'onVoicePlayEnd',
        'uploadVoice',
        'downloadVoice',
        'translateVoice'
    ];

    AGG.WXUtil = {
        requestApi:function(ready,error){
            $.ajax({
                url: ApiUrl + "/index.php?act=member_login&client_type=wap&op=web_get_agg_sign&timestamp="+timestamp+"&url="+nurl+"&nonceStr="+ranStr,
                type:'get',
                dataType:'jsonp',
                cache : false,
                jsonp:"callback",
                success:function(data){
                    if (data.code !== 200) {
                        console.log("微信签名获取失败");
                    }
                    wx.config({
                        debug: false,
                        appId: 'wxa0641282049ed265',
                        timestamp:timestamp,
                        nonceStr: ranStr,
                        signature: data.data.sign.toLowerCase(),
                        jsApiList: defaultApiList
                    });

                    wx.ready(function () {
                        if (typeof ready == "function") {
                            ready();
                        }
                    });

                    wx.error(function(res){
                        console.log('微信sdk接口调用失败');
                        if (typeof error == "function") {
                            error();
                        }
                    });

                },
                error:function(){
                    if (typeof error == "function") {
                        error();
                    }
                }
            });
        }
    };

});