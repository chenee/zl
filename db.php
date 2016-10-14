<?php


$db = new mysqli('localhost', 'root', 'chenee', 'zl');

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

echo "connect to zl ok!<p>";

$user_name = $_REQUEST["user_name"];
$user_pwd = $_REQUEST["user_pwd"];
$select_sql = "select * from test where name = '$user_name' ";

echo $select_sql . "<p>";

if(!$result = $db->query($select_sql)){
    die('There was an error running the query [' . $db->error . ']');
}

echo 'Total results: ' . $result->num_rows;


while($row = $result->fetch_assoc()){
    echo 'Name:' . $row['name'] . '&nbsp&nbsp&nbsp&nbsp&nbsp ADDR:'. $row['address']. '<br />';
}

$db->close();