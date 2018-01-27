<?php
/**
 *
 * 定义IUserPraiseAction接口
 * 创建日期：2017.11.30
 * 修改日期：2017.11.30
 */


	/**
	 * 用户行为
	 * 一组与点赞相关的行为
	 * Praise:点赞(博客)、取消赞
	 *
	 * 实现类为UserPraiseActionImpl
	 */
	interface IUserPraiseAction
	{
		function praiseBlog($blogID);
		function cancelPraise($blogID);
	}

?>