<?php
	/****************************************************
	 * 作者：.
	 * 创建日期：2017.08.18
	 * 描述：注销登录，销毁session
	 * 修改日期：2017.08.19
	****************************************************/
	session_start();
	if (session_destroy())
		$is_destroyed=TRUE;
?>

<html>
	<head>
		<title>注销登录</title>
	</head>

	<body>
		<script>
			var is_destroyed="<?php echo $is_destroyed; ?>";
			if (is_destroyed)
			{
				alert("注销成功！");
				history.back();
			}
			
		</script>
	</body>
</html>