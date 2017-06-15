<?php
header("Content-Type:text/html;charset=utf-8");

$local="localhost";
$root="root";
$pwd="20402991GnAt";
$db_name="mymessage";

$link=@mysql_connect($local,$root,$pwd);
if (!$link) {
	echo "数据库连接失败，错误原因：".mysql_error();
	exit();
}
$db=mysql_select_db($db_name,$link);
if (!$db) {
	echo "数据库{$db_name}选择失败，错误原因：".mysql_error();
	exit();
}
mysql_query("set names utf8");

?>