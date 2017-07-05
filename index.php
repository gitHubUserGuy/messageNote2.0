<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>我的留言本</title>
<style>
#wrap {float:left; margin-right:100px; }
#user {display:none; }
input[name=btn] {display:none; }
#alert {color:red; font-weight:bold; display:none; }
#show_msg {float:left; width:400px; height:400px; border:1px solid #666; }
#show_msg .title {width:100%; height:30px; border-bottom:1px solid #999; text-align:center; vertical-align:middle; }
#show_msg .msg {width:100%; height:350px; overflow:auto; }
#show_msg .title {margin:10px 0;}
#show_msg .person {border-bottom:1px dotted #999; margin-bottom:10px; }
#show_msg .del {float:right; display:none; }
#show_msg span {margin-top:10px; }
#show_msg .words {margin:5px 0; width:100%; text-indent:30px; }
#show_msg .zan {margin-left:80%; }
#show_msg .zan,#show_msg .cai {cursor:pointer; }
</style>

</head>
<body>
<div id="wrap">
	<h3 id="entry">
		<a id="login" href="javascript:location.href='./login.html'">登录</a>
		<a id="regist" href="javascript:location.href='./regist.html'">注册</a>
	</h3>
	<h3 id="user">
		<span>用户：</span>
		<span id="username"><?php session_start();if(!empty($_SESSION["name"]))echo$_SESSION["name"];else echo "";?></span>
		<span id="checkOut">
			<a href="javascript:location.href='./checkout.php';">退出</a>
		</span>
	</h3>
	<h3>请在下方留言</h3>
	<form>
		留言区：<br><textarea name="msg" cols="30" rows="8"></textarea><br>
		<input type="button" name="btn" value="提交">
	</form>
	<span id="alert">留言内容不能为空！</span>
</div>
<div id="show_msg">
	<h3 class="title">留言展示区</h3>
	<div class="msg">
		<?php
			include "mysql.php";

			$sql="SELECT * FROM message ORDER BY id DESC";
			$result=mysql_query($sql);
			if (!$result) {
				echo "获取数据出错：".mysql_error();
				exit();
			} else {
				$str="";
				
				while($arr=mysql_fetch_assoc($result)) {
					$str.="<div class='person' name=".$arr["id"]."><a class='del' href='javascript:location.href=\"del.php?id=".$arr["id"]."\";'>&times;</a><span>用户：</span><span class='username'>".$arr['username']."</span><br><span>时间：</span><span class='time'>".$arr['addate']."</span><p class='words'>".$arr['content']."</p><span class='zan'>赞<a class='z' href='javascript:;'>".$arr["zan"]."</a></span><span class='cai'>踩<a class='c' href='javascript:;'>".$arr["cai"]."</a></span></div>";
				}
				echo $str;
			}
				
		?>
	</div>
</div>
<script src="http://cdn.bootcss.com/jquery/2.2.2/jquery.min.js"></script>
<script>
$(document).ready(function() {

	$("input[type=button]").on("click",function() {
		var	text1=$.trim($("textarea[name=msg]").val());
		var	oDate=new Date();
		var	s=Math.floor(oDate.getTime()/1000);
		var flag=true;

		if (!text1) {
			$("#alert").css("display","block");
			setTimeout(function() {
				$("#alert").css("display","none");
			},2000)
			flag=false;
		} else if (flag) {
			$.ajax({
				type:"POST",
				url:"conn.php",
				data:{
					user:encodeURI($("#username").html()),
					msg:encodeURI(text1),
					time:s
				},
				success:function(data,status,xhr) {
					var d=JSON.parse(data);
					
					var oDiv=$("<div class='person' name="+d.id+"><a class='del' href='javascript:location.href=\"./del.php?id="+d.id+"\";' >&times;</a><span>用户：</span><span class='username'>"+d.username+"</span><br><span>时间：</span><span class='time'>"+d.addate+"</span><p class='words'>"+d.content+"</p><span class='zan'>赞<a class='z' href='javascript:;'>"+d.zan+"</a></span><span class='cai'>踩<a class='c' href='javascript:;'>"+d.cai+"</a></span></div>");

					$(".msg").prepend($(oDiv));
					$("textarea[name=msg]").val("");

					adminNow();
					zanAndCai(".zan");
					zanAndCai(".cai");
				},
				error:function() {
					$("#alert").html("提交出错啦！");
				}
			})
		}
	});

	adminNow();
	function adminNow() {
		if (!$("#username").html()) {
			$("#user").css("display","none");
			$("input[name=btn]").css("display","none");
			$("#entry").css("display", "block");
		} else if ($("#username").html()==="admin") {
			$("#user").css("display","block");
			$("input[name=btn]").css("display","block");
			$("#entry").css("display", "none");

			$(".del").css("display","block");
		} else if ($("#username").html() && $("#username").html()!=="admin") {
			$("#user").css("display","block");
			$("input[name=btn]").css("display","block");
			$("#entry").css("display", "none");

			$(".del").css("display","none");
		}
	};

	// if ($("#username").html()==="admin") {
	// 	$(".del").css("display","block");
	// } else if ($("#username").html() && $("#username").html()!=="admin") {
	// 	$(".del").css("display","none");
	// }
	
	zanAndCai(".zan");
	zanAndCai(".cai");
	function zanAndCai(wrap) {
		$(wrap).on("click",function() {
			if (!$("#username").html()) {
				alert("请先登录！");
				return;
			} else {
				var num=parseInt($(this).find("a").html());
				var oId=$(this).parent().attr("name");
				var flag=$(wrap).attr("class")==="zan"? true:false;
				var $_this=$(this);
				num++;
				$.ajax({
					type:"POST",
					url:"zan_cai.php",
					data:{
						num:num,
						id:oId,
						flag:flag
					},
					success:function(data,status,xhr) {
						$_this.find("a").html(data);
					},
					error:function(xhr) {
						$("#alert").html("提交出错啦！");
					}
				})
			}
				
		})
	}

	
	
})
</script>
</body>
</html>
