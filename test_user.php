<?php
	include "mysql.php";

	$u=urldecode($_POST["user"]);
	$sql="SELECT * FROM user_info WHERE username='$u'";
	$result=mysql_query($sql);
	$num=mysql_num_rows($result);

	echo $num;
?>