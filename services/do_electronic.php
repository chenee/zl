<?php
//TODO: session check !
require_once(dirname(__FILE__)."/../db.php");

//preset order ,state : notpayed;
function do_electronic_step1()
{
//  check wx info
    if (empty($_REQUEST["wx_openid"])) {
//        echo "<h1> wx openid is null!</h1>";

        $array = array(
            'code' => 8001,
            'msg' => "wx_openid is null;at db_electronic_step1",
        );

        return json_encode($array);
    }

    $db = dbinit();

    $insert_sql = "insert into srv_electronic (
wx_openid, project_name, requirement,
number, requiretime, current,
nexttime, endtime, ordertime,
fee,state,out_trade_no
 ) values (?,?,?, ?,?,?, ?,?,?, ?,?,?)";

    $result = $db->prepare($insert_sql);


    $wx_openid = getRequest($db, "wx_openid");
    $project_name = getRequest($db, "project_name");
    $requirement = getRequest($db, "requirement");

    $number = getRequest($db, "number");
    $requiretime = getRequest($db, "requiretime");
    $current = getRequest($db, "current");

    $nexttime = getRequest($db, "nexttime");
    $endtime = getRequest($db, "endtime");
    $ordertime = time();

    $fee = getRequest($db, "fee");
    $state = "notpayed";
    $out_trade_no = getRequest($db, "out_trade_no");

    $result->bind_param("ssssssssssss",
        $wx_openid, $project_name, $requirement,
        $number, $requiretime, $current,
        $nexttime, $endtime, $ordertime,
        $fee,$state,$out_trade_no
    );

    $result->execute();

    $code = 200;
    $msg = "Apply OK";

    if ($result->affected_rows > 0) {
        //nothing;
    } else {
        $code = $result->errno;
        $msg = $result->error;
    }
    $result->free_result();
    $db->close();

    $array = array(
        'code' => $code,
        'msg' => $msg,
    );

    return json_encode($array);
}

function do_electronic_step2($out_trade_no,$fee,$state){

    $db = dbinit();
    $insert_sql = "update srv_electronic set state=? where out_trade_no=? and fee=?";

    $result = $db->prepare($insert_sql);

    $result->bind_param("sss", $state, $out_trade_no, $fee );

    $result->execute();


    $code = 200;
    $msg = "update order state ok!";

    if ($result->affected_rows > 0){
    }else{
        echo $result->error;
        $code = 80003;
        $msg = "Update failed!";
    }

    $result->free_result();

    $db->close();

    return json_encode(array(
       'code' => $code,
        'msg' => $msg
    ));

}
