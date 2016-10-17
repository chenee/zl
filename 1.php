<?php
//$jsonstring = '{"appid":"wx9756628d86fa20fc",
//"attach":"E2P\u670d\u52a1","bank_type":"CFT","cash_fee":"1",
//"fee_type":"CNY","is_subscribe":"Y","mch_id":"1341253301",
//"nonce_str":"0moec0r3d7p6iqhkxkr1mjiyuhpf42na",
//"openid":"o2lTjv0WAn22OKUzGubwXQslo_tU",
//"out_trade_no":"134125330120161017134104",
//"result_code":"SUCCESS","return_code":"SUCCESS",
//"sign":"5CD70B8486EBAFD37C64418180846EE2",
//"time_end":"20161017134119","total_fee":"1",
//"trade_type":"JSAPI","transaction_id":"4009512001201610176926073661"}';
//$d = json_decode($jsonstring);
//
//echo
function do_electronic_step2($out_trade_no,$fee,$state){

    $db = dbinit();
    $insert_sql = "update srv_electronic set state=? where out_trade_no=? and fee=?";

    $result = $db->prepare($insert_sql);

    $s= getRequest($db,$state);
    $o= getRequest($db,$out_trade_no);
    $f= getRequest($db,$fee);
    $result->bind_param("sss", $s, $o, $f);


    $result->execute();


    $code = 200;
    $msg = "update order state ok!";

    if ($result->affected_rows > 0){
    }else{
        $code = $result->errno;
        $msg = "update order ERR: ".$out_trade_no ." | ".$fee." | ".$state." | ".$result->error;
    }

    $result->free_result();

    $db->close();

    return json_encode(array(
        'code' => $code,
        'msg' => $msg
    ));

}

require_once "db.php";
do_electronic_step2("134125330120161017165148","1","payed");