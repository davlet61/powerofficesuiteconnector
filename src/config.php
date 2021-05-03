<?php

$currentEnv = $_SERVER['_'];

global $clientkey;
global $applicationkey;
global $testmode;
global $apiurl;
global $urlsuitcrm;
global $suitcrmusername;
global $suitcrmpassword;
global $conn;

global $db_host = 'localhost';
global $db_user = 'root';
global $db_password = 'root';
global $db_db = 'information_schema';
global $db_port = 3306;

$conn=mysqli_connect(
				$db_host,
				$db_user,
				$db_password,
				$db_db
			);

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}


$clientkey=$_SERVER['PO_CLIENT_KEY'];
$applicationkey=$_SERVER['PO_APP_KEY'];
$suitcrmusername=$_SERVER['SUITE_USER'];
$suitcrmpassword=$_SERVER['SUITE_USER_PWD'];
$testmode=true;
if($testmode==true)
{
	$apiurl=$_SERVER['PO_DEMO_URL'];
	
}
else	
{
	$apiurl=$_SERVER['PO_URL'];
}
$urlsuitcrm="https://crm.glass.no/service/v4_1/rest.php";