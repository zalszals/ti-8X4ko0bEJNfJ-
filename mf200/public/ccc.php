<?php
$token = $_REQUEST['token'];
echo $token;
session_id($token);
session_start();
var_dump($_SESSION);