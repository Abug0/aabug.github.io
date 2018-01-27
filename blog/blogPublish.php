<?php
/**
 * 作者：.
 * 描述：Blog的发表界面
 * 创建日期：2017.11
 * 修改日期：2017.11.26
 */

	require_once("../php_class/Blog.class.php");
	require_once("../php_class/User.class.php");
	require_once("../php_class/BlogSearchImpl.class.php");
	require_once("../php_class/BlogStatisticsImpl.class.php");
	if(!isset($_SESSION))
		session_start();
	if(!isset($_SESSION["user"]))
		echo "<script>location.href='../user/login.php';</script>";

?>
<?php
	if(isset($_GET["title"]))
	{
		$isModify = 1;
		$title = $_GET["title"];
		$user = $_SESSION["user"];
		$searcher = new BlogSearchImpl();
		$searcher->setCond("author", $user->getName());
		$searcher->setCond("title", $title);
		$blogs = $searcher->searchBlog();
		if(count($blogs)<=0)
			exit("出现异常！");
		else
		{
			$blog = $blogs[0];
			$bID = $blog->getID();
		}
	}	
?>

<html>
	<head>
		<title>编辑博客</title>
		<meta charset="utf8">
		<link rel="stylesheet" href="blogPublish.css">
	</head>
	
	<body>
	
		<div style="background:#556655;width:100%;height:70px">
			<iframe scrolling="no" width="100%" height="100%" frameborder="0" src="../top-nav-area.php"></iframe>
		</div>
		
		<div id="article">
			<form id="article-form" method="post" action="blogSubmit.php">
				
				<span id="subtit">文章标题:</span>
				<input type="text" id="title" name="title" style="width:60%">
				<br><br>
				
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span id="subtit">标签:</span>
				<input type="text" id="tags" name="tags" style="width:60%">
				<br><br>
				
				<span id="subtit">文章内容:</span>
				<br>
				<textarea id="content" name="content" cols="50%" rows="50" wrap="hard"></textarea>
				<br><br>
				
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<span id="subtit">分类:</span>
				<input type="text" id="catalogue" name="catalogue" style="width:60%">
				<br><br>
				
				<input type="button" value="发表文章" id="btn-publish">
				<input type="submit" value="发表文章">
				<br><br>
			</form>
		</div>
		
		<div style="positon:absolute;top:100%;">
			
		</div>
		
		<script src="../js/jQuery.js"></script>
		<script>
			var isModify = "<?php echo $isModify; ?>";
			if(isModify == 1)
			{
				//alert("asd");
				$("#title").val("<?php echo $blog->getTitle(); ?>");
				$("#tags").val("<?php echo $blog->getTags(); ?>");
				$("#content").val("<?php echo $blog->getContent(); ?>");
				$("#catalogue").val("<?php echo $blog->getCatalogue(); ?>");
			}
		</script>
	</body>
</html>
