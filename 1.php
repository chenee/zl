<?php
$jsonstring = '{"appid":"wx9756628d86fa20fc",
"attach":"E2P\u670d\u52a1","bank_type":"CFT","cash_fee":"1",
"fee_type":"CNY","is_subscribe":"Y","mch_id":"1341253301",
"nonce_str":"0moec0r3d7p6iqhkxkr1mjiyuhpf42na",
"openid":"o2lTjv0WAn22OKUzGubwXQslo_tU",
"out_trade_no":"134125330120161017134104",
"result_code":"SUCCESS","return_code":"SUCCESS",
"sign":"5CD70B8486EBAFD37C64418180846EE2",
"time_end":"20161017134119","total_fee":"1",
"trade_type":"JSAPI","transaction_id":"4009512001201610176926073661"}';
$d = json_decode($jsonstring);

echo
