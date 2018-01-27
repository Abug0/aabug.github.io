<?php
	/**
	 *作者：.
	 *创建日期：2017.08.12
	 *描述：网站首页
	 *修改日期：2017.08.20
	*/

	//echo $_SERVER["DOCUMENT_ROOT"];
	header("Content-Type: text/html; charset=gbk");
	include_once("php_class/User.class.php");
	if (!isset($_SESSION))
		session_start();
?>

<?php
		//通过检查session判断用户是否登录
		$is_login=FAlSE;
		if (isset($_SESSION["user"]))
		{
			$user=$_SESSION["user"];
			$head_image_path = $user->getHeadImagePath();
			//echo $user->getPropertyValue("mName");
			//echo $user->getPropertyValue("mLastLoginDate");
			$is_login=TRUE;
		}
?>
	
<html>
	<head>
		<title>Welcome to myWorld</title>
		<meta http-equiv="Content-Type" content="text/html;charset=gbk">
		<link rel="stylesheet" href="home.css">
		<script src="js/jQuery.js"></script>
	</head>
	
	<body>
		<!-- TODO:填充超链接地址 -->
		<div id="not-login">
			Hello World!
		</div>
		
		<!-- 用户信息 -->
		<div id="user">
			<!-- 用户头像 -->
			<!-- TODO:头像地址替换为动态数据 -->
			<a href="image/head/awei.jpg" target="_blank">
				<img id="user-head-image" src="<?php echo $head_image_path; ?>" title="awei" alt="">
			</a>
			
			<!-- 用户名 -->
			<div id="user-name">
				<a href="" alt="" title="awei">awei</a>
				<div class="down-arrow"></div>
				<div id="user-info-nav">
					<ul class="sub-menu">
						<li><a href="">个人资料</a></li>
						<li><a href="user/login.php">重新登录</a></li>
						<li><a href="">退出</a></li>
						<li><a href="user/logout.php">注销</a></li>
					</ul>
				</div>
			</div>
			
		</div>
		
		<!--
		<a id="user-change" href="">切换用户</a>
		-->
		
		<div id="user-manager">
			<a href="">联系作者</a>
		</div>
		
		<!-- 登录与注册 -->
		<div id="user-login">
			<input id="btn-login" class="login" type="button" value="登录">
			<input id="btn-register" class="login" type="button" value="注册">
		</div>
		
		<!-- 分割线 -->
		<hr class="sep-line">
		
		<div id="welcome">Welcome to you!</div>
		
		<!-- 主要功能导航 -->
		<div id="nav">
			<ul>
				<li><a href="">动态</a></li>
				<li><a href="blog/blog.php">博客</a></li>
				<li><a href="">相册</a></li>
				<li><a href="">书架</a></li>
				<li><a href="">自我管理</a></li>
				<li><a href="">资源管理</a></li>
				<li><a href="">网站简介</a></li>
			</ul>
		</div>
		
		<!-- 引言 -->
		<div id="quote">
			路漫漫其修远兮<br>
			吾将上下而求索
		</div>
		
	</body>
	<script src="home.js"></script>


	<!-- 登录与注册按钮的点击事件 -->
	<script>
		$("#btn-login").click(function(){
			location.href="user/login.php";
		});
		
		$("#btn-register").click(function(){
			location.href="user/register.php";
		});
	</script>

	<!-- 用户登录后修改元素显示设置 -->
	<script>
		var is_login="<?php echo $is_login; ?>";

		//用户登录后隐藏某些元素，并显示用户头像和昵称
		if(is_login){
			var user_name=
				"<?php 
					if ($is_login)
						echo iconv("utf-8","gbk",$user->getName()); 
				?>";
			$("#user-name a:first").text(user_name);
			$("#not-login").css("display","none");
			$("#user-login").css("display","none");
			$("#user").css("display","block");
		}

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
	
	
	<!-- 设置div#quote的显示内容 -->
	<script>
		var quotes=new Array();//JS数组，存放quote

		<?php
			//读取quote.txt
			include("general_function.php");
			$quote_source_file="quote.txt";
			$quote_array=getFileInner($quote_source_file);
			
			//读取成功，将文件内容放入quotes数组中
			if($quote_array){
				$quote_count=sizeof($quote_array);
				for ($i=0; $i<sizeof($quote_array); $i++)
				{
					//"，"和","替换为"<br>"，在页面中换行显示
					$tmp_line=str_replace("，","<br>",rtrim($quote_array[$i]));
					$tmp_line=str_replace(",","<br>",$tmp_line);
					echo "quotes[".$i."]='".$tmp_line."';";
				}

			}
		?>

		//随机读取quotes的元素，并设置为div#quote的文本
		function setQuote(){
			var quote_count=quotes.length;
			var random_index=Math.floor(Math.random()*quote_count);
			$("#quote").html(quotes[random_index]);
		}
		
		window.setInterval("setQuote();",5000);//定时执行setQuote()

	</script>
</html>
