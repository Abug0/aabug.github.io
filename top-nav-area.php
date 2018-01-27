<?php
/**
 * 作者：
 * 描述：
 * 创建日期：2017.
 * 修改日期：2017.11.25
 */

	require_once("php_class/User.class.php");
	if(!isset($_SESSION))
		session_start();
	if(isset($_SESSION["user"]))
	{
		$user = $_SESSION["user"];
		$author = $user->getName();	
	}
?>
<html>
	<!--
		顶级菜单，网页顶部的导航区
	-->

	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf8">
		<link rel="stylesheet" href="top-nav-area.css">
		<script src="js/jQuery.js"></script>
	</head>
	
	<style>
		
	</style>
	<body>
		<div id="user">
			<!-- 用户头像 -->
			<!-- TODO:头像地址替换为动态数据 -->
			<a href="./image/head/awei.jpg" target="_blank">
				<img id="user-head-image" src="./image/head/awei.jpg" title="<?php echo $user->getName(); ?>" alt="">
			</a>
			
			<!-- 用户名 -->
			<div id="user-name">
				<a href="" alt="" title="">
					<?php echo $user->getName(); ?>
				</a>
				<div class="down-arrow"></div>
				<div id="user-info-nav">
					<ul class="sub-menu">
						<li><a href="">个人资料</a></li>
						<li><a href="login.php">重新登录</a></li>
						<li><a href="">退出</a></li>
						<li><a href="logout.php">注销</a></li>
					</ul>
				</div>
			</div>
			
		</div>
		<div id="top-nav">
				<ul>
					<li><a href="home.php" target="_top">动态</a></li>
					<li><a href="blog/blog.php" target="_top">博客</a></li>
					<li><a href="">相册</a></li>
					<li><a href="">书架</a></li>
					<li><a href="">自我管理</a></li>
					<li><a href="">资源管理</a></li>
					<li><a href="">网站简介</a></li>
					
				</ul>
		</div>
		
		<hr class="sep-line">
	</body>
	<script>
		//鼠标移到用户名上时显示用户操作菜单	
		$("#user-name").mouseover(function(){
			$(".down-arrow").css("position","relative");
			$(".down-arrow").css("top","-15px");
			$(".down-arrow").css("border-bottom-color","white");
			$(".down-arrow").css("border-top-color","transparent");
			$("#user-name > a:first-child").css("color","#666666");
			$("#user-info-nav").css("display","block");
		});

		//鼠标从用户名上移开时隐藏用户操作菜单
		$("#user-name").mouseleave(function(){
			$("#user-info-nav").css("display","none");
			$("#user-name > a:first-child").css("color","#eeaa66");
			$(".down-arrow").css("position","relative");
			$(".down-arrow").css("top","14px");
			$(".down-arrow").css("border-bottom-color","transparent");
			$(".down-arrow").css("border-top-color","white");
		});
	</script>
</html>