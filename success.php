<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Document</title>
<style>
#info {margin:0 auto;}
</style>
</head>
<body>
<?php
	
?>
<div id="info">
	<h3 class="info1"><?php echo urldecode($_REQUEST["message"]); ?></h3>
	<div class="info2">
		系统自动将在<span id="time">3</span>秒后跳转至留言页面，如不想等待，可以<a href="./index.php?name=<?php session_start();echo $_SESSION['name']; ?>">点击这里</a>。
	</div>
</div>
<script>
timeChange(3);
function timeChange(num) {
	var timer=setInterval(function() {
		num--;
		if (num===0) {
			clearInterval(timer);
			window.location.href="./index.php?name=<?php echo $_SESSION['name']; ?>";
		}
		document.getElementById("time").innerHTML=num;
	},1000)
}
</script>

</body>
</html>