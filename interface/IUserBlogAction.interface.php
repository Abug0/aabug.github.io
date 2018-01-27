<?php
/**
 *
 * 定义IUserBlogAction接口
 * 创建日期：2017.11.30
 * 修改日期：2017.11.30
 */


	$current_dir = dirname(__FILE__);
	require_once("{$current_dir}/../interface/IBlogObject.interface.php");


	/**
	 * 用户行为
	 * 一组与用户自身的博客相关的行为
	 * Blog:发布、删除、修改
	 *
	 * 实现类为UserBlogActionImpl
	 */
	interface IUserBlogAction
	{
		function publishBlog(IBlogObject $blog);
		function modifyBlog(IBlogObject $blog);
		function deleteBlog(IBlogObject $blog);
	}

?>