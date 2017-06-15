<?php
	include "mysql.php";

	$flag=$_POST["flag"];
	$num=(int)$_POST["num"];
	$id=$_POST["id"];

	if ($flag) {
		$sql="UPDATE message SET zan='$num' WHERE id='$id'";
		$result=mysql_query($sql);
		if (!$result) {
			echo "更新数据失败：".mysql_error();
			exit();
		} else {
			echo $num;
		}
	} else {
		$sql="UPDATE message SET cai='$num' WHERE id='$id'";
		$result=mysql_query($sql);
		if (!$result) {
			echo "更细数据失败：".mysql_error();
			exit();
		} else {
			echo $num;
		}
	}
?>