<?php
/**
 * 描述：声明和定义ICommentObject接口
 *
 * 创建日期：2017.12.06
 * 修改日期：2017.12.06
 */


	/**
	 * Comment对象
	 */
	interface ICommentObject
	{
		/* getter */
		function getCommentID();
		function getCommenter();
		function getContent();
		function getCommentDate();
		function getCommentIp();
		function getBlogID();

		/* setter */
		function setCommenter($commenter);
		function setContent($content);
		function setCommentDate($commentDate);
		function setCommentIp($commenIp);
		function setBlogID($blogID);
	}
?>