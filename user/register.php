<?php
	/*****文档注释**********************************
	*作者：.
	*创建日期：2017.08.12
	*描述：用户注册页面，表单提交到add_user.php
	*修改日期：2017.08.18
	***********************************************/

	header("Content-Type:text/html;charset=gbk");
?>
<html>
	<head>
		<title>用户注册</title>
		<link rel="stylesheet" href="register.css">
		<script src="../js/jQuery.js"></script>
		<script src="../js/jQuery.form.js"></script>
		<style>
			body{
				background-image:url(../bgImage/register.jpg);
				z-index:0;
			}
			
			.register-wrap{
				background-color:#aaaaaa;
				height:230px;
				left:30%;
				position:absolute;
				top:20%;
				width:400px;
				//display:none;
			}
			
			.register-info{
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
				top:0px;
				width:380px;
			}
		</style>
	</head>

	<body>
	<!-- TODO:改为AJAX异步提交 -->
		<div class="register-wrap">
			<!-- TODO:上传头像 -->
			<form id="register-info-form" action="" 
			  class="register-info" method="post" enctype="multipart/form-data">
				
				&nbsp;&nbsp;&nbsp;
				<input id="head-image" name="head-image" type="file">
				<br><br>
				
				&nbsp;&nbsp;&nbsp;
				用户名：<input type="text" id="user-name" name="user-name">
				<span id="wt-user-name" class="wrong-tip">*用户名不能为空！</span>
				<br><br>
				
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				密码：<input type="password" id="user-pwd" name="user-pwd"><br><br>
				确认密码：<input type="password" id="user-pwd2">
				<span id="wt-pwd" class="wrong-tip">*前后密码不一致！</span>
				<hr id="sep-line">
				
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="reset" value="清空">
				&nbsp;
				<input type="submit" value="注册1">
				<input id="btn-register" type="button" value="注册">
			</form>
		</div>
		<div id="showDiv" style="display:none">ed
			<img id="head" src="bgImage/home.jpg" alt="asd">
			<img src="file://C:/Users/dell/Desktop/ima/watch.jpg"> 
		</div>
		<script>
			//file:///C:/Users/dell/Desktop/ima/paopao.jpg
			/** 
			 * 输入框发生改变时进行验证
			 * 用户名为空或者首字符为数字时给出提示
			 */
			$("document").ready(function(){
				$("#user-name").change(function(){
					var user_name=$("#user-name").val();
					var patt_number=/^[0-9]/;

					if (user_name == "")
					{
						$("#wt-user-name").html("*用户名不能为空！");
						$("#wt-user-name").css("display","inline");
					}
					else if (user_name.match(patt_number) != null)
					{
						$("#wt-user-name").html("*不能以数字开头！");
						$("#wt-user-name").css("display","inline");
					}
					else
						$("#wt-user-name").css("display","none");
						
				});
				
			});


			/** 输入框发生改变时进行验证
			 * 验证前后密码是否一致
			 * 不一致时给出提示
			 */
			$("document").ready(function(){
				$("#user-pwd,#user-pwd2").change(function(){
					var pwd=$("#user-pwd").val();
					var pwd2=$("#user-pwd2").val();
					if (pwd2 != pwd)
						$("#wt-pwd").css("display","inline");
					else
						$("#wt-pwd").css("display","none");
				});
			});

			/** 点击提交后进行验证 */
			$("#btn-register").click(function(){
				
				var user_name=$("#user-name").val();
				var patt_number=/^[0-9]/;
				if (user_name == "" || user_name.match(patt_number) != null)
				{
					alert("用户名为空或者首字符为数字！");
					$("#user-name").focus();
					return;
				}

				//前后密码不一致时弹出窗口提示	
				var pwd=$("#user-pwd").val();
				var pwd2=$("#user-pwd2").val();				
				if (pwd2 != pwd){
					alert("前后密码不一致！");
					$("#user-pwd2").focus();
					return;
				}
					
				//进行提交
				var ajax_register_url = "register_add_user.php";
	
				var options = {
					"beforeSubmit" : checkForm,
					"dataType" : "script",
					"resetForm" : true,
					"success" : submitResult,
					"url":"register_add_user.php",
				};
				
				$("#register-info-form").ajaxSubmit(options);
				function checkForm(formData, form, options) 
				{
					//表单提交前处理
					console.log("hello");
				}
				
				function submitResult (data, status)
				{
					//alert("ajksdh");
					console.log("success");;
					alert(data);
					
					if (data == "注册成功！")
					{
						//alert("ajsd");
						location.href = "login.php";
					}
						
				}
				
			});
	
		</script>

	</body>
</html>