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

	if(!isset($_SESSION))
		session_start();
	if(!isset($_SESSION["user"]))
		echo "<script>location.href='../user/login.php';</script>";
	
	$user = $_SESSION["user"];
	$author = $user->getName();

	$searcher = new BlogSearchImpl();
	$searcher->setCond("author", $author);

	if(isset($_GET["catalogue"]))
	{
		$blog_catalogue = $_GET["catalogue"];
		$searcher->setCond("catalogue", $blog_catalogue);
	}
	$my_blogs = $searcher->searchBlog();
	
?>
<html>
	<head>
		<title><?php echo $author,"的博客"; ?></title>
		<link rel="stylesheet" type="text/css" href="myBlogs.css">
		<link rel="stylesheet" type="text/css" href="blog_general.css">
	</head>

	<body>
		<div id="header">
			<h2>coder的博客</h2>
			<div id="nav">
				<ul>
					<li><a href="../home.php">首页</a></li>
					<li><a href="blog.php">博客</a></li>
				<ul>
			</div>
		</div>
		
		<div>
			<!-- 导航菜单 -->
		
		</div>
		
		<!-- 用户信息 -->
		<div id="user_info">
			<div id="head_image">
				<img src="../image/head/coder.jpg"><a href=""></a></img>
				<span>coder<span>
			</div>
			
			<span style="margin-left:20%">文章：4篇</span>
			<div id="blog_catelog">
				<ul style="width:230px;background-color:#eee;">
					<span style="margin-left:-30px">文章分类<span>
				</ul>
				
				<ul style="margin-top:-5px;margin-left:-15px">
					<?php
						$statistican = new BlogStatisticsImpl();
						$statistican->setCond("author", $author);
						$catalogues = $statistican->retrieveCatalogues();
						foreach($catalogues as $catalogue)
						{
							$statistican->setCond("catalogue", $catalogue);
							echo "<li id='{$catalogue}'>";
							echo "<a href='myBlogs.php?catalogue={$catalogue}'>{$catalogue}</a>";
							echo "<span>(",$statistican->countBlogs(),")</span>";
							echo "<br>";
							echo "</li>";
						}
					?>
					
					<li id=''>
						<a href='myBlogs.php'>全部文章</a>
						<span>
							<?php
								$statistican->clearCond("catalogue");
								echo "(",$statistican->countBlogs(),")"; 
							?>
						</span>
					<br>
					</li>
				<ul>
			</div>
		</div>
		
		
		<div id="blogs">
			<div class="blog">
					<h3>
						<a href="blogDetails.php?title=<?php echo serialize($blogs); ?>">Hello</a>
					</h3>
					<div class="blog_content">
						Hello World!
					</div>
					<div class="blog_message">
						<span>2017-10-30 19:00</span>   
						<span><a href="">阅读：65 </a></span>
						<span><a href="">评论：10 </a></span>
						<span><a href="">编辑 </a></span>
						<span><a href="">删除 </a></span>
					</div>
			</div>
			<?php
				foreach($my_blogs as $blog)
				{
					//$my_blog = new Blog($author, $blog->bTitle);//
					//$my_blogs[$blog->bTitle] = $my_blog;
					
					echo "<div class='blog'>";
					echo 	"<h3>
								<a href='blogDetails.php?title={$blog->getTitle()}'>
									{$blog->getTitle()}
								</a>
							</h3>";
					
					echo 	"<div class='blog_content'>";
					echo 		$blog->getContent();
					echo 	"</div>"; 
					
					echo 	"<div class='blog_message'>
								<span>2017-10-30 19:00</span>   
								<span><a href=''>阅读：65 </a></span>
								<span><a href=''>评论：10 </a></span>
								<span><a href='blogPublish.php?title=Hello'>编辑 </a></span>
								<span><a href=''>删除 </a></span>
							</div>";
					
					echo "</div>";
					
				}
			?>
		</div>
		
		<script src="../js/jQuery.js"></script>
		<script>
			var blog_catalogue = "<?php echo $blog_catalogue; ?>";
			//alert(blog_catalogue.length);
			if(blog_catalogue.length > 0)
			{
				//alert("asd");
				$("#"+blog_catalogue).css("color", "#555");
				$("#"+blog_catalogue+" a").css("color", "#555");
				//alert("asd");
			}
		</script>
	</body>
</html>