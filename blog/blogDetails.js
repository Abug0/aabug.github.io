$("#ta-comment-content").click(function(){
	var height = $("#ta-comment-content").height();
	//alert(height);
	if(height<=30)
		$("#ta-comment-content").css("height","50px");
	else
		$("#ta-comment-content").css("height","30px");
});