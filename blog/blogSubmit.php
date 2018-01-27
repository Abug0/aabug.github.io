<?php
/**
 * 描述：接收从前端传递的博客信息，将记录添加到数据库
 *
 * 创建日期：2017
 * 修改日期：2017.11.30
 */


	require_once("../php_class/User.class.php");
	require_once("../php_class/Blog.class.php");
	require_once("../php_class/UserBlogActionImpl.class.php");
	
	if(!isset($_SESSION))
		session_start();
	
	$user = $_SESSION["user"];
	
	$author = $user->getName();
	$title = $_REQUEST["title"];
	$tags = $_REQUEST["tags"];
	$content = $_REQUEST["content"];
	$catalogue = $_REQUEST["catalogue"];

	$blog = new Blog($author, $title, $content, $tags, $catalogue);
	$user_blog_actor = new UserBlogActionImpl($user);

	if ($user_blog_actor->publishBlog($blog))
		echo "发布成功";
	else
		echo "发布失败";
?>