<?php
	include "mysql.php";

	$username=urldecode($_POST["user"]);
	$msg=urldecode($_POST["msg"]);
	date_default_timezone_set("Asia/Shanghai");
	$time=date("Y年m月d日 H:i:s",$_POST["time"]);

	$sql="INSERT INTO message(username,password,content,addate) VALUES('$username','default','$msg','$time')";

	$result=mysql_query($sql);
	if (!$result) {
		echo "写入数据库失败：".mysql_error();
		exit();
	} else {
		$_sql="SELECT * FROM message WHERE addate='$time'";
		$_result=mysql_query($_sql);
		if (!$_result) {
			echo "获取数据失败：".mysql_error();
			exit();
		} else {
			$_data=mysql_fetch_assoc($_result);
			echo json_encode($_data);
		}
	}

?>