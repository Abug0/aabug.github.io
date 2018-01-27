/**
 * 作者：
 * blog.php中使用的js函数和事件
 * 创建日期：2017.11.27
 * 修改日期：2017.11.27
 */

var page_count = 1;
var key = "";
	
/* 点击超链接后加载下一页 */
$("#footer-a").click(function(){
	
	/* 如果已经加载全部，再点击连接收起从第2页开始以后的博客 */
	if ( $("#footer-a").text()== "已加载全部" )
	{
		$(".blog:gt(1)").remove();
		$("#footer-a").text("显示更多");
		$("#footer-img").attr("src", "../icon/unfold.png");
		page_count = 1;
		//alert(page_count);
		return;
	}

	/* 没有全部加载完的时候点击链接显示下一页 */
	page_count = page_count+1;//要加载页的页码
	if(key=="")//构造url的查询参数
		var get_more_blog_url="blogPageSearch_bk.php?page_no="+page_count;
	else
	{
		var get_more_blog_url = "blogPageSearch_bk.php?"+key+"&page_no="+page_count;
		//alert(key);
	}

	responseHtml=$.ajax({
		async:false,
		method:"GET",
		url:get_more_blog_url	
	});
	
	/* 获取响应 */
	var response_text = responseHtml.responseText;
	if ( response_text.substring(0,1) == 0 )//加载到最后一页时修改#footer-a的文本
	{
		//alert(response_text.substring(0,1))
		$("#footer-a").text("已加载全部");
		$("#footer-img").attr("src", "../icon/packup.png");
		if (response_text.length <= 30)
		{
			page_count = page_count-1;
			return;
		}
		//alert(page_count);
	}
	
	//alert(response_text);
	/* 查询结果显示到页面 */
	var more_blogs = response_text.substr(1);
	$("#main").append(more_blogs);
	
});


$("#btn-search").click(function(){
	page_count = 1;
	//alert("ad");
	key = $("#key-name").val()+"="+$("#key-value").val();
	var get_blog_url = "blogPageSearch_bk.php?";
	get_blog_url = get_blog_url+key;
	responseHtml=$.ajax({
		async:false,
		//data:$("#form-search").serialize(),
		method:"GET",
		url:get_blog_url	
	});
	
	var blogs = responseHtml.responseText;
	$("#main").html(blogs);
	$("#footer-a").text("显示更多");
	$("#footer-img").attr("src", "../icon/unfold.png");
	//alert(blogs);
});


$("document").ready(function(){
	$("#main").delegate(".praise a", "click", function(){
		//alert("asd");
		var element_id = "#"+this.id;
		var img_src = $(element_id).children("img").attr("src");
		var pattern = "praise.*(?=.png)";//"abc(?=y)";
		var img_name = img_src.match(pattern);

		var blog_id = this.id.split("-")[1];
		//alert(blog_id);
		var submit_praise_url = "praiseSubmit.php?blog_id="+blog_id;

		if( img_name == "praise")
		{
			$(element_id).children().attr("src","../icon/praise_fill.png");
			
			/* 点赞记录提交到数据库 */
			submit_praise_url = submit_praise_url+"&flag=1";
			responseHtml=$.ajax({
				async:false,
				method:"GET",
				url:submit_praise_url
			});
			var praise_flag = responseHtml.responseText;
			//alert(praise_flag);
			if(praise_flag == 1)
			{
				$(element_id+" .icon").children().attr("src","../icon/praise_fill.png");
				var praise_count = $(element_id+" .praise-count").text().match(/\d+/);
				praise_count = Number(praise_count)+1;
				//alert(praise_count);
				$(element_id+" .praise-count").text("点赞("+praise_count+")");
			}

		}
		else if(img_name == "praise_fill")
		{
			submit_praise_url = submit_praise_url+"&flag=0";
			responseHtml=$.ajax({
				async:false,
				method:"GET",
				url:submit_praise_url
			});
			var praise_flag = responseHtml.responseText;
			//alert(praise_flag);
			if(praise_flag == 1)
			{
				$(element_id).children().attr("src","../icon/praise.png");
				var praise_count = $(element_id+" .praise-count").text().match(/\d+/);
				praise_count = Number(praise_count)-1;
				//alert(praise_count);
				$(element_id+" .praise-count").text("点赞("+praise_count+")");
			}
				
		}

	});
});
