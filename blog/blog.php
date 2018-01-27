<?php
/**
 * 作者：
 * 描述：
 * 创建日期：
 * 修改日期：2017.11.08
 */
	require_once("../php_class/Blog.class.php");
	require_once("../php_class/User.class.php");
	require_once("../php_class/UserSearchImpl.class.php");
	require_once("../php_class/BlogSearchImpl.class.php");
	require_once("../php_class/BlogStatisticsImpl.class.php");
	require_once("../php_class/PraiseRetrieveImpl.class.php");
	require_once("../php_class/BrowseStatisticImpl.class.php");

	$is_logged = 0; //登录标志，未登录置0，已登录置1
	if(!isset($_SESSION))
		session_start();
	if(isset($_SESSION["user"]))
	{
		$user = $_SESSION["user"];
		$author = $user->getName();	
		$is_logged = 1;
	}
	
?>
<html>
	<head>
		<title>博客</title>
		<link rel="stylesheet" href="blog_general.css">
		<link rel="stylesheet" href="blog.css">
	</head>

	<body>
		<div id="top-nav-iframe">
			<iframe scrolling="no" width="100%" height="100%" frameborder="0" src="../top-nav-area.php"></iframe>
		</div>
		
		<div id="">
			<div id="nav">
				<ul>
					<li><a href="myBlogs.php">我的博客</a></li>
					<li><a href="blogPublish.php">发表博客</a></li>
				</ul>
			</div>
			
			<div id="search">
				<form id="form-search">
					<input name="key-value" type="text" id="key-value" placeholder="输入搜索关键词">
					<select id="key-name" name="key-name">
						<option value="author">作者</option>
						<option value="tags">标签</option>
						<option value="title">标题</option>
					</select>
					<input id="btn-search" type="button" value="搜索">
					<!-- 
						<input type="submit" value="搜索">
					-->
				</form>
			</div>
		</div>
		
		<div id="main">
			
			<?php
				$praiseRetriever = new PraiseRetrieveImpl();
				$praiseRetriever->setCond("praiser", $user->getName());
				$user_praises = $praiseRetriever->retrievePraises(); 
				$praiseRetriever->clearCond("praiser");
				$blogs_has_praised = array();
				for($i=0; $i<count($user_praises); $i++)
				{
					$blogs_has_praised[$i] = $user_praises[$i]->getBlogID();
				}

				$blogSearcher = new BlogSearchImpl();
				$blogSearcher->setLimit(0,1);
				$blogs = $blogSearcher->searchBlog();
				
				$browseStatisticer = new BrowseStatisticsImpl();
				$userSearcher = new UserSearchImpl();

				foreach ($blogs as $blog)
				{
					if(in_array($blog->getID(), $blogs_has_praised))
						$img_src = "../icon/praise_fill.png";
					else
						$img_src = "../icon/praise.png";
					
					$blog_author = $userSearcher->searchByName($blog->getAuthor());
					$praiseRetriever->setCond("blogID", $blog->getID());
					echo "<div class='blog'>";
					echo 	"<h3>";
					echo 	"<a href='blogDetails.php?title=",$blog->getTitle(),"'>",$blog->getTitle(),"</a>";
					echo 	"</h3>";
					echo 	"<div class='blog_content'>";
					echo 		$blog->getContent();
					echo 	"</div>";
					echo 	"<div class='blog_message'>
								<span id='author'>
									<!--TODO:src改为动态数据-->
									<img src='../image/head/coder.jpg' class='author-head-image'>
									<span>{$blog->getAuthor()}</span>
								</span>
								
								<span id='tags'>
									<img src='../icon/label.png' class='icon'>
									标签:{$blog->getTags()}
								</span>
								
								<span>2017-10-30 19:00</span>   
								
								<span>
									<img src='../icon/browse.png' class='icon'>
									<a href=''>阅读({$browseStatisticer->statisticPageview($blog->getID())}) </a>
								</span>
								
								<span>
									<a href=''>
										<img src='../icon/comment.png' class='icon'>
										评论(10)
									</a>
								</span>
								
								<span class='praise'>
									<a href='javascript:void(0)' id='praise-{$blog->getID()}'>
										<img src='{$img_src}' class='icon'>
										<span id='praise-count' class='praise-count'>点赞({$praiseRetriever->countPraises()})</span>
									</a>
								</span>
							</div>";
					echo "</div>";
				}
			?>

		</div>
		
		<div id="footer">
			<a id="footer-a">显示更多</a>
			<img id="footer-img" src="..\icon\unfold.png" class="icon">
		</div>
		
		<script src="../js/jQuery.js"></script>
		<script src="blog.js"></script>
	</body>
</html>