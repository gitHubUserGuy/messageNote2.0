<?php 
header("content-type:text/html;charset=utf-8");

	include "mysql.php";

	$id=$_GET["id"];
	$sql="DELETE FROM message WHERE id='$id'";
	$result=mysql_query($sql);
	if (!$result) {
		echo "删除数据出错：".mysql_error();
		exit();
	} else {
		$message=urlencode("删除成功！");
		header("location:./index.php?message=$message");
	}
?>