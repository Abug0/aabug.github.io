<?php
	/*****�ĵ�ע��**********************************
	*���ߣ�.
	*�������ڣ�2017.08.12
	*�������û�ע��ҳ�棬���ύ��add_user.php
	*�޸����ڣ�2017.08.18
	***********************************************/

	header("Content-Type:text/html;charset=gbk");
?>
<html>
	<head>
		<title>�û�ע��</title>
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
	<!-- TODO:��ΪAJAX�첽�ύ -->
		<div class="register-wrap">
			<!-- TODO:�ϴ�ͷ�� -->
			<form id="register-info-form" action="" 
			  class="register-info" method="post" enctype="multipart/form-data">
				
				&nbsp;&nbsp;&nbsp;
				<input id="head-image" name="head-image" type="file">
				<br><br>
				
				&nbsp;&nbsp;&nbsp;
				�û�����<input type="text" id="user-name" name="user-name">
				<span id="wt-user-name" class="wrong-tip">*�û�������Ϊ�գ�</span>
				<br><br>
				
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				���룺<input type="password" id="user-pwd" name="user-pwd"><br><br>
				ȷ�����룺<input type="password" id="user-pwd2">
				<span id="wt-pwd" class="wrong-tip">*ǰ�����벻һ�£�</span>
				<hr id="sep-line">
				
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="reset" value="���">
				&nbsp;
				<input type="submit" value="ע��1">
				<input id="btn-register" type="button" value="ע��">
			</form>
		</div>
		<div id="showDiv" style="display:none">ed
			<img id="head" src="bgImage/home.jpg" alt="asd">
			<img src="file://C:/Users/dell/Desktop/ima/watch.jpg"> 
		</div>
		<script>
			//file:///C:/Users/dell/Desktop/ima/paopao.jpg
			/** 
			 * ��������ı�ʱ������֤
			 * �û���Ϊ�ջ������ַ�Ϊ����ʱ������ʾ
			 */
			$("document").ready(function(){
				$("#user-name").change(function(){
					var user_name=$("#user-name").val();
					var patt_number=/^[0-9]/;

					if (user_name == "")
					{
						$("#wt-user-name").html("*�û�������Ϊ�գ�");
						$("#wt-user-name").css("display","inline");
					}
					else if (user_name.match(patt_number) != null)
					{
						$("#wt-user-name").html("*���������ֿ�ͷ��");
						$("#wt-user-name").css("display","inline");
					}
					else
						$("#wt-user-name").css("display","none");
						
				});
				
			});


			/** ��������ı�ʱ������֤
			 * ��֤ǰ�������Ƿ�һ��
			 * ��һ��ʱ������ʾ
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

			/** ����ύ�������֤ */
			$("#btn-register").click(function(){
				
				var user_name=$("#user-name").val();
				var patt_number=/^[0-9]/;
				if (user_name == "" || user_name.match(patt_number) != null)
				{
					alert("�û���Ϊ�ջ������ַ�Ϊ���֣�");
					$("#user-name").focus();
					return;
				}

				//ǰ�����벻һ��ʱ����������ʾ	
				var pwd=$("#user-pwd").val();
				var pwd2=$("#user-pwd2").val();				
				if (pwd2 != pwd){
					alert("ǰ�����벻һ�£�");
					$("#user-pwd2").focus();
					return;
				}
					
				//�����ύ
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
					//���ύǰ����
					console.log("hello");
				}
				
				function submitResult (data, status)
				{
					//alert("ajksdh");
					console.log("success");;
					alert(data);
					
					if (data == "ע��ɹ���")
					{
						//alert("ajsd");
						location.href = "login.php";
					}
						
				}
				
			});
	
		</script>

	</body>
</html>