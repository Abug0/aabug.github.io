<?php
/**
 * 作者：
 * 描述：
 * 创建日期：
 * 修改日期：2017.11.08
 */
	require_once("../php_class/Blog.class.php");
	require_once("../php_class/User.class.php");
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
		//$author = $user->getName();	
		$is_logged = 1;
	}
	/*foreach($_REQUEST as $k => $v)
	{
		echo $k," => ",$v,"<br>";
	}*/
	
	$blogSearcher = new BlogSearchImpl();

	if (isset($_GET["page_no"]))
	{
		$blog_no = (int)$_GET["page_no"];
		$blogSearcher->setLimit($blog_no, $blog_no+1);
	}
	else
		$blogSearcher->setLimit(0, 1);
	
	if (isset($_GET["author"]))
		$blogSearcher->setCond("author", $_GET["author"], 1);
	if (isset($_GET["title"]))
		$blogSearcher->setCond("title", $_GET["title"], 1);
	if (isset($_GET["tags"]))
		$blogSearcher->setCond("tags", $_GET["tags"], 1);
	
	$blogs = $blogSearcher->searchBlog();
	if( count($blogs) < 2 )
	{
		echo "0";
		//exit();
	}

	$browseStatisticer = new BrowseStatisticsImpl();
	$praiseRetriever = new PraiseRetrieveImpl();
	$praiseRetriever->setCond("praiser", $user->getName());
	$user_praises = $praiseRetriever->retrievePraises(); 
	$praiseRetriever->clearCond("praiser");
	$blogs_has_praised = array();
	for($i=0; $i<count($user_praises); $i++)
	{
		$blogs_has_praised[$i] = $user_praises[$i]->getBlogID();
	}

	
	foreach ($blogs as $blog)
	{
		if(in_array($blog->getID(), $blogs_has_praised))
			$img_src = "../icon/praise_fill.png";
		else
			$img_src = "../icon/praise.png";
		
		$praiseRetriever->setCond("blogID", $blog->getID());
		echo "<div class='blog'>";
		echo 	"<h3>";
		echo 	"<a href='blogDetails.php?title=",$blog->getTitle(),"'>",$blog->getTitle(),"</a>";
		echo 	"</h3>";
		echo 	"<div class='blog_content'>";
		echo 		$blog->getContent();
		echo 	"</div>";
		echo 	"<div class='blog_message'>
					<span id='tags'>标签:{$blog->getTags()}</span>
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