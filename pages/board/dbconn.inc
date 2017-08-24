<link href="style.css" rel="stylesheet" type="text/css"/>
<?php
// DB 접속 정보를 가지고 있는 파일
$db_name="winktest";
$user_name="winktest";
$user_password="winktest1";
$dbconn=mysql_connect("localhost",$user_name,$user_password);
$status=mysql_select_db($db_name,$dbconn);
?>