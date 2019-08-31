<?php
session_start();
error_reporting(0);
header("Content-Type: text/html; charset=utf-8");
include('../data/config.php'); 
define('REWRITE',$_JDM['rewrite']);
define('SYSPATH',$_JDM['path']);
define('a','GoogleInit');$rep='foot';
if($_SESSION['adminSession']!=base64_decode('aHR0cDovL3d3dy5qaWFuZGFubWEuY29t')){
	header("location: ./login.php");
	exit;
}
$nav='';

?>