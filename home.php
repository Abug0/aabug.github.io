<?php
	/**
	 *���ߣ�.
	 *�������ڣ�2017.08.12
	 *��������վ��ҳ
	 *�޸����ڣ�2017.08.20
	*/

	//echo $_SERVER["DOCUMENT_ROOT"];
	header("Content-Type: text/html; charset=gbk");
	include_once("php_class/User.class.php");
	if (!isset($_SESSION))
		session_start();
?>

<?php
		//ͨ�����session�ж��û��Ƿ��¼
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
		<!-- TODO:��䳬���ӵ�ַ -->
		<div id="not-login">
			Hello World!
		</div>
		
		<!-- �û���Ϣ -->
		<div id="user">
			<!-- �û�ͷ�� -->
			<!-- TODO:ͷ���ַ�滻Ϊ��̬���� -->
			<a href="image/head/awei.jpg" target="_blank">
				<img id="user-head-image" src="<?php echo $head_image_path; ?>" title="awei" alt="">
			</a>
			
			<!-- �û��� -->
			<div id="user-name">
				<a href="" alt="" title="awei">awei</a>
				<div class="down-arrow"></div>
				<div id="user-info-nav">
					<ul class="sub-menu">
						<li><a href="">��������</a></li>
						<li><a href="user/login.php">���µ�¼</a></li>
						<li><a href="">�˳�</a></li>
						<li><a href="user/logout.php">ע��</a></li>
					</ul>
				</div>
			</div>
			
		</div>
		
		<!--
		<a id="user-change" href="">�л��û�</a>
		-->
		
		<div id="user-manager">
			<a href="">��ϵ����</a>
		</div>
		
		<!-- ��¼��ע�� -->
		<div id="user-login">
			<input id="btn-login" class="login" type="button" value="��¼">
			<input id="btn-register" class="login" type="button" value="ע��">
		</div>
		
		<!-- �ָ��� -->
		<hr class="sep-line">
		
		<div id="welcome">Welcome to you!</div>
		
		<!-- ��Ҫ���ܵ��� -->
		<div id="nav">
			<ul>
				<li><a href="">��̬</a></li>
				<li><a href="blog/blog.php">����</a></li>
				<li><a href="">���</a></li>
				<li><a href="">���</a></li>
				<li><a href="">���ҹ���</a></li>
				<li><a href="">��Դ����</a></li>
				<li><a href="">��վ���</a></li>
			</ul>
		</div>
		
		<!-- ���� -->
		<div id="quote">
			·��������Զ��<br>
			�Ὣ���¶�����
		</div>
		
	</body>
	<script src="home.js"></script>


	<!-- ��¼��ע�ᰴť�ĵ���¼� -->
	<script>
		$("#btn-login").click(function(){
			location.href="user/login.php";
		});
		
		$("#btn-register").click(function(){
			location.href="user/register.php";
		});
	</script>

	<!-- �û���¼���޸�Ԫ����ʾ���� -->
	<script>
		var is_login="<?php echo $is_login; ?>";

		//�û���¼������ĳЩԪ�أ�����ʾ�û�ͷ����ǳ�
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

		//����Ƶ��û�����ʱ��ʾ�û������˵�	
		$("#user-name").mouseover(function(){
			$(".down-arrow").css("position","relative");
			$(".down-arrow").css("top","-15px");
			$(".down-arrow").css("border-bottom-color","white");
			$(".down-arrow").css("border-top-color","transparent");
			$("#user-name > a:first-child").css("color","#666666");
			$("#user-info-nav").css("display","block");
		});

		//�����û������ƿ�ʱ�����û������˵�
		$("#user-name").mouseleave(function(){
			$("#user-info-nav").css("display","none");
			$("#user-name > a:first-child").css("color","#eeaa66");
			$(".down-arrow").css("position","relative");
			$(".down-arrow").css("top","14px");
			$(".down-arrow").css("border-bottom-color","transparent");
			$(".down-arrow").css("border-top-color","white");
		});

	</script>
	
	
	<!-- ����div#quote����ʾ���� -->
	<script>
		var quotes=new Array();//JS���飬���quote

		<?php
			//��ȡquote.txt
			include("general_function.php");
			$quote_source_file="quote.txt";
			$quote_array=getFileInner($quote_source_file);
			
			//��ȡ�ɹ������ļ����ݷ���quotes������
			if($quote_array){
				$quote_count=sizeof($quote_array);
				for ($i=0; $i<sizeof($quote_array); $i++)
				{
					//"��"��","�滻Ϊ"<br>"����ҳ���л�����ʾ
					$tmp_line=str_replace("��","<br>",rtrim($quote_array[$i]));
					$tmp_line=str_replace(",","<br>",$tmp_line);
					echo "quotes[".$i."]='".$tmp_line."';";
				}

			}
		?>

		//�����ȡquotes��Ԫ�أ�������Ϊdiv#quote���ı�
		function setQuote(){
			var quote_count=quotes.length;
			var random_index=Math.floor(Math.random()*quote_count);
			$("#quote").html(quotes[random_index]);
		}
		
		window.setInterval("setQuote();",5000);//��ʱִ��setQuote()

	</script>
</html>
