<?php
header("content-type:text/html;charset=utf-8");
	include "mysql.php";

	$username=urldecode($_POST["username"]);
	$password=$_POST["password"];
	date_default_timezone_set("Asia/Shanghai");
	$time=date("Y年m月d日 H:i:s",time());

	$sql="INSERT INTO user_info VALUES(NULL,'$username','$password','$time')";
	$result=mysql_query($sql);
	if (!$result) {
		echo "写入数据库失败：".mysql_error();
		exit();
	} else {
		$_sql="SELECT * FROM user_info WHERE username='$username'";
		$_result=mysql_query($_sql);
		$_arr=mysql_fetch_assoc($_result);
		if (!$_result) {
			echo "获取用户信息失败：".mysql_error();
			exit();
		} else {
			session_unset();
			session_start();
			$_SESSION["name"]=$_arr["username"];

			$message="注册成功！";
			echo $message;
		}

		
	}


?>