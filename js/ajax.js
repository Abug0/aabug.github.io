
/*******文档注释***********************************
 * 作者：.
 * 创建日期：2017.08.13
 * 描述：AJAX的相关函数和操作
 * 修改日期：2017.08.18
**************************************************/

/**
 * 创建并返回一个XMLHttpRequest对象
 *
 * @return xmlHttpRequest
 */
function createXHR() 
{
	var xmlHttp;
	if(window.ActiveXObject)	//IE浏览器
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	else if(window.XMLHttpRequest)	//其他浏览器
		xmlHttp=new XMLHttpRequest();
	return xmlHttp;
}

/**
 * 提交请求
 *
 * @param xmlHttpRequest	xmlHttp		ajax过程中使用的XMLHttpRequest对象
 * @param string			method  	提交数据的方式，POST或GET
 * @param string 			url			数据提交的地址
 * @param function 			callback	readyState改变时进行处理的函数
 * @param string 			data		POST方式提交的数据，默认为""
 * @param boolean			async		请求方式，TRUE为异步提交，FALSE为同步提交,默认为TRUE
 */
function AjaxRequest(xmlHttp,method,url,callback,data="",async=true,headerInfo="application/x-www-form-urlencoded")
{
	xmlHttp.open(method,url,async);
	xmlHttp.setRequestHeader('Content-Type',headerInfo);
	xmlHttp.onreadystatechange=callback;
	xmlHttp.send(data);	
}

function bell()
{
	alert("bell!");
}