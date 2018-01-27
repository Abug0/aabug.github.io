<?php
/**
 * blog的详情页
 */
	
	require_once("../php_class/Blog.class.php");
	require_once("../php_class/BlogSearchImpl.class.php");
	require_once("../php_class/User.class.php");
	//print_r($_GET);
	if(!isset($_SESSION))
		session_start();
	if(!isset($_SESSION["user"]))
		echo "<script>location.href='../user/login.php';</script>";
	
	$user = $_SESSION["user"];
	$title = $_GET["title"];
	$searcher = new BlogSearchImpl();
	$searcher->setCond("author", $user->getName());
	$searcher->setCond("title", $title);
	$blogs = $searcher->searchBlog();
	if(count($blogs)>0)
		$blog = $blogs[0];
	else
		exit("出现异常！");
?>
<html>
	<head>
		<title><?php echo $blog->getTitle(); ?></title>
		<meta http-equiv="Content-Type" content="text/html;charset=gbk">
		<link rel="stylesheet" type="text/css" href="blogDetails.css">
	</head>
	
	<body>
		<div>
			<!-- 导航栏 -->
		</div>
		
		<div id="main">
			<!-- 主体内容区 -->
			<div id='main-left'>
			<!-- 左边区域，博客详情 -->
				<div id="blog_details">
					<div id="title">
						<!-- 标题区域 -->
						<h3>
							<?php echo $blog->getTitle(); ?>
						</h3>
						
						<div id="extra_info">
							<span>
								<?php echo $blog->getCreateDate(); ?>
							</span>
							<span>
								标签：<?php echo $blog->getCatalogue(),"/",$blog->getTags(); ?>
							</span>
						</div>
					</div>
					
					<div id="content">
						<!-- 内容区域 -->
						<?php
							echo $blog->getContent();
						?>
					</div>
				</div>
				
				<div id="comments">
					<!-- 评论区 -->
					<div class='user-comment'>
						<div id="user-head">
							<img class='user-head-image' src='../image/head/coder.jpg' >
						</div>
						<textarea id='ta-comment-content' placeholder='发表评论'></textarea>
					</div>
					
					<div class="comment">
						<div class="user_head_image">
							<!-- 用户头像 -->
							<img src="coder.jpg" alt="">
							<span class="comment_tit_user">root</span>
						</div>
						
						<div class="comment_right">
							<!-- 评论的右边区域 -->
							<div class="comment_tit">
								<div class="comment_tit_floor">#1楼 
									<span style="margin-left:20px">2017-11-01 20:00发表</span>
									<span class="comment_tit_option">
										<a href="">回复</a>
									</span>
								</div>
								<div class="comment_content">This is my first blog.</div>
								
							</div>
						</div>
					</div>
				</div>
				
			</div>
			
			<div id="user_info">
				<!-- 右边区域，用户信息 -->
				<div>
					<!-- 用户头像和信息 -->
					<img src="coder.jpg">
						<a href="" alt=""></a>
					</img>
					<div id="user_info_name">
						<a href="">coder</a>
					</div>
				</div>
				<div id="user_other_articles">
					<!-- 相关文章 -->
					<span id="user_other_articles_tit">更多文章</span>
					<ul>
						<?php
							$searcher->clearConds();
							$searcher->setCond("author", $user->getName());
							if($articles = $searcher->searchBlog())
							{
								for($i=0; $i<count($articles)&&$i<3;$i++)
									echo "<li><a href=''>",$articles[$i]->getTitle(),"</a></li>";
							}
							
						
						?>
					</ul>
				</div>
			</div>
		</div>
		<script src="../js/jQuery.js"></script>
		<script src="blogDetails.js"></script>
	</body>
</html>