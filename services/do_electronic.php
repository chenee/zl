<?php
//TODO: session check !
echo "ssssss33";
require_once("../db.php");
echo "ssssss334";
//preset order ,state : notpayed;
function do_electronic_step1()
{
//  check wx info
    if (empty($_REQUEST["wx_openid"])) {
        echo "<h1> wx openid is null!</h1>";
        exit;
    }
    echo "sssssssssssssssssssssss3";

    $db = dbinit();

    $insert_sql = "insert into srv_electronic (
wx_openid, project_name, requirement,
number, requiretime, current,
nexttime, endtime, ordertime
 ) values (?,?,?, ?,?,?, ?,?,?)";

    $result = $db->prepare($insert_sql);


    $result->bind_param("ssssssssssss",
        $wx_openid, $project_name, $requirement,
        $number, $requiretime, $current,
        $nexttime, $endtime, $ordertime,
        $fee,$state,$out_trade_no
    );

    echo "sssssssssssssssssssssss4";

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
    echo json_encode($array);
    exit;

}
