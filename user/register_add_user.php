<?php
	/**
	 * 作者：.
	 * 创建日期：2017.08.12
	 * 描述：从register.php获取表单数据，插入数据库
	 * 修改日期：2017.08.18
	 */

	header("Content-Type:text/html;charset=utf-8");
	require_once("../php_class/User.class.php");
	require_once("../php_class/FileUploader.class.php");
	require_once("../php_class/UserAccountActionImpl.class.php");

	date_default_timezone_set('PRC');//设置为中国时区


	/* 获取参数，组装SQL语句 */
	$name = $_REQUEST["user-name"];
	$pwd = $_REQUEST["user-pwd"];
	$head_image_path = "";
	
	if (isset($_FILES["head-image"]))
	{
		$file = $_FILES["head-image"];
		$fileUploader = new FileUploader($file, $name.".jpg", "../image/head/");
		if (!$fileUploader->upload())
			echo "头像上传失败！";
		else
			$head_image_path = $fileUploader->getPropertyValue("mFullFileName");
	}

	$user=new User($name,$pwd, $head_image_path);
	$user_account_actor = new UserAccountActionImpl($user);
	//print_r($_FILES);
	if ($user_account_actor->register())
		echo "注册成功！";
	else
		echo "注册失败！请重新注册或与维护人员联系！";
?>