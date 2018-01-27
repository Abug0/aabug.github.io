<?php
/**
 * 接收前端传递的Praise的信息，向数据库中添加记录
 */


	require_once("../php_class/User.class.php");
	require_once("../php_class/Praise.class.php");
	require_once("../php_class/UserPraiseActionImpl.class.php");
	
	if(!isset($_SESSION))
		session_start();
	if(isset($_SESSION["user"]))
		$user = $_SESSION["user"];
	
	$praiser = $user->getName();
	$blog_id = $_GET["blog_id"];
	$date = date("Y-m-d H:i:s");
	$ip = $_SERVER["REMOTE_ADDR"];
	
	$flag = $_GET["flag"];//标记位，为1时点赞，0时取消赞
	
	$praise = new Praise($praiser, $blog_id, $date, $ip);
	$user_praise_actor = new UserPraiseActionImpl($user);
	if ($flag == 1)
	{
		if ( $user_praise_actor->praiseBlog($blog_id) ) 
			echo 1;
		else
			echo 0;
	}
	else if ($flag == 0)
	{
		if ( $user_praise_actor->cancelPraise($blog_id) ) 
			echo 1;
		else
			echo 0;
	}
?>