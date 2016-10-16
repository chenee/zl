<?php
//check wx info
if (empty($_REQUEST["wx_openid"])){
    echo "<h1> wx openid is null!</h1>";
    exit;
}

require_once ("../db.php");

//********** session ,cookie need!!!
$insert_sql = "insert into srv_electronic (
wx_openid, project_name, requirement,
number, requiretime, current,
nexttime, endtime, ordertime
 ) values (?,?,?, ?,?,?, ?,?,?)";

//echo "<h4>" . $insert_sql . "</h4>";
//echo "<h4>" . $_REQUEST["wx_openid"] ."</h4>";

$result = $db->prepare($insert_sql);


$result->bind_param("sssssssss",
    $wx_openid, $project_name, $requirement,
    $number, $requiretime, $current,
    $nexttime, $endtime, $ordertime
);


$wx_openid = getRequest($db,"wx_openid");
$project_name = getRequest($db,"project_name");
$requirement = getRequest($db,"requirement");

$number = getRequest($db,"number");
$requiretime = getRequest($db,"requiretime");
$current = getRequest($db,"current");

$nexttime = getRequest($db,"nexttime");
$endtime = getRequest($db,"endtime");
$ordertime =  '"'. time() . '"';


$result->execute();
if ($result->affected_rows > 0){
    echo "<h1>Apply OK! Go Back </h1> ";
} else{
    echo $result->error;

}

$result->free_result();

$db->close();
