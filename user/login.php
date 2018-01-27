<?php
	/**
	 * 作者：.
	 * 创建日期：2017.08.13
	 * 描述：用户登录页面，表单提交到
	 * 修改日期：2017.08.17
	 */

	header("Content-Type:text/html;charset=utf-8");
?>
<html>
	<head>
		<title>用户登录</title>
		<link rel="stylesheet" href="">
		<script src="../js/jQuery.js"></script>
		<style>
			body{
				background-image:url(../bgImage/register.jpg);
			}
			
			.login-wrap{
				background-color:#aaaaaa;
				height:150px;
				left:30%;
				position:absolute;
				top:20%;
				width:400px;
				//display:none;
			}
			
			.login-info{
				position:absolute;
				left:30px;
				top:10px
			}
			
			.wrong-tip{
				color:red;
				display:none;
			}
			
			#sep-line{
				left:-20px;
				position:relative;
				top:5px;
				width:380px;
			}
		</style>
	</head>
	
	<body>
	<!-- TODO:改为AJAX异步提交 -->
		<div class="login-wrap">
			<form id="login-info-form" action="login_validate.php" 
			  class="login-info" method="post" enctype="multipart/form-data">
				
				&nbsp;&nbsp;&nbsp;
				用户名：<input type="text" id="user-name" name="user-name">
				<span id="wt-user-name" class="wrong-tip">*用户名不能为空！</span>
				<br><br>
				
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				密码：<input type="password" id="user-pwd" name="user-pwd">
				<br>
				
				<hr id="sep-line">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="reset" value="清空">
				
				&nbsp;
				<input id="btn-login" type="button" value="登录">
				<input type="submit">
			</form>
		</div>
		<div id='showDiv'></div>
		
		<script src="../js/ajax.js"></script>
		
		<!-- 对用户输入进行验证 -->
		<script>
			//点击提交后进行验证
			$("#btn-login").click(function(){

				//用户名为空时窗口提示
				var user_name=$("#user-name").val();
				if (user_name == "")
				{
					alert("请输入用户名！");
					$("#user-name").focus();
					return;
				}

				//密码为空时弹出窗口提示	
				var pwd=$("#user-pwd").val();			
				if (pwd == "")
				{
					alert("请输入密码！");
					$("#user-pwd").focus();
					return;
				}

				/** 
				 * 用户数据提交到后台
				 */
				var ajax_validate_url="login_validate.php";
				responseHtml=$.ajax({
					async:false,
					data:$("#login-info-form").serialize(),
					method:"POST",	
					url:ajax_validate_url	
				});
				
				/** 获取响应 */
				var login_status_text=responseHtml.responseText;
				//alert(login_status_text);
				if (login_status_text == "登录成功！")
				{
					alert("登录成功！");
					location.href="../home.php";
				}
				else if (login_status_text == "登录失败！")
				{
					alert(login_status_text);
					alert("登录失败！密码错误！");
					$("#user-name").focus();
				}
				else
				{
					//location.href = "login_validate.php";
					alert(login_status_text);
					//alert("登录失败！用户不存在！");
					$("#user-name").focus();
				}
			});
		</script>

		<!-- ajax提交用户名和密码到后台进行验证 -->
		<script src="../js/ajax.js"></script>
		<script>
			
			
			
		</script>
	</body>
</html>