<?php
$token = $_REQUEST['token'];

$db_name = $_REQUEST['db_name'];

session_id($token);

session_start();

$_SESSION['db_name'] = $db_name;

echo json_encode(['status'=>1,'token'=>$token,'db_name'=>$db_name]);