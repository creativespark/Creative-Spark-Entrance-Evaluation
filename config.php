<?php
session_start();
header("Cache-control: private");

set_magic_quotes_runtime(0);

error_reporting(E_ALL);//good for local host debugging.
$pos=stripos($_SERVER['DOCUMENT_ROOT'],'/www');
$this_path=substr($_SERVER['DOCUMENT_ROOT'],0,$pos);
ini_set('include_path', ".;$this_path/;");

define("MYSQL_HOST", "localhost");
define("MYSQL_USER", "root");
define("MYSQL_PASS", "");
define("DB_NAME", "int_csi_entrance");



require ("classes/DB.class.php");
$newDB = new DB();
//require_once("classes/job.class.php");
//$_job=new job($newDB);


?>