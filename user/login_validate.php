<?php
	/**
	 * 作者：.
	 * 描述：对请求登录的用户信息进行合法性验证
	 * 创建日期：2017.08.14
	 * 修改日期：2017.11.30
	 */


	$current_dir = dirname(__FILE__);
	//echo $current_dir;
	include_once("../php_class/UserAccountActionImpl.class.php");
	include_once("../php_class/User.class.php");
	
	header("Content-Type:text/html;charset=utf-8");


	$name = $_REQUEST["user-name"];
	$pwd = $_REQUEST["user-pwd"];
	$user = new User($name, $pwd);
	$user_account_actor = new UserAccountActionImpl($user);

	if($user_account_actor->login())
	{
		/* 用户信息放入session */
		if (!isset($_SESSION))
			session_start();
		$_SESSION["user"]=$user;

		echo "登录成功！";
	}
	else
		echo "登录失败！";

?>