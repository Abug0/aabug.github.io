<?php
/**
 * 接口文件,关于接口的定义
 *
 * 创建日期:2017.11.29
 * 修改日期:2017.11.29
 */


	/**
	 * Blog对象
	 */
	interface IBlogObject
	{
		/* getter方法 */
		function getAuthor();
		function getCatalogue();
		function getContent();
		function getCreateDate();
		function getID();
		function getModifyDate();
		function getTags();
		function getTitle();

		/* setter方法 */
		function setAuthor($author);
		function setCatalogue($catalogue);
		function setContent($content);
		function setCreateDate($createDate);
		function setID($id);
		function setModifyDate($modifyDate);
		function setTags($tags);
		function setTitle();
	}



	/**
	 * praise对象的信息
	 */
	interface IPraiseObject{
		/* getter方法 */
		function getBlogID();
		function getPraiseDate();
		function getPraiseIp();
		function getPraiser();

		/* setter方法 */
		function setBlogID($blogID);
		function setPraiseDate($praiseDate);
		function setPraiseIp($praiseIp);
		function setPraiser($praiser);
	}



 	/**
	 * User业务对象
	 */
	interface IUserObject
	{
		/** setter方法 */
		function getName();
		function getPassword();
		function getHeadImagePath();
		function getLastLoginDate();
		function getLastLoginIp();
		function getName();
		function getPassword();
		function getRegisterDate();

		/** setter方法 */
		function setHeadImagePath($headImagePath);	
		function setLastLoginDate($lastLoginDate);
		function setLastLoginIp($lastLoginIp);
		function setName($name);
		function setPassword($password);
		function setRegisterDate();
	}


	/**
	 * 在数据库中查找符合条件的博客
	 *
	 * 实现类为BlogSearchImpl
	 */
	interface IBlogSearch
	{
		function searchBlog();
		function setCond($condName, $condValue, $isFuzzy=0);
		function clearCond($condName);
		function clearConds();
	}


	/**
	 * 对博客的相关信息进行统计
	 * 获取符合条件的博客目录、标题、日期等信息
	 *
	 * 实现类为BlogStatisticsImpl
	 */
	Interface IBlogStatistics
	{
		function retrieveAuthors();
		function retrieveCatalogues();
		function countBlogs();
		function retrieveCreateDates();
		function retrieveModifyDates();
		function retrieveTags();
		function retrieveTitles();
		function setCond($condName, $condValue, $isFuzzy=0);
		function clearCond($condName);
		function clearConds();
	}


	/**
	 * 用户行为
	 * User:登录、注册、退出
	 * Blog:发布、删除、修改
	 * Praise:点赞博客、取消赞
	 * Comment:
	 *
	 * 实现类为UserActionImpl
	 */
	interface IUserAction
	{
		function publishBlog(Blog $blog);
		function modifyBlog(Blog $blog);
		function deleteBlog(Blog $blog);
		
		function login();
		function logout();
		function register();
		
		function praiseBlog($blogID);
		function cancelPraise($blogID);
	}


	/**
	 * 对数据库中符合条件的praise记录进行检索、统计
	 *
	 * 实现类为PraiseRetrieveImpl
	 */
	interface IPraiseRetrieve
	{
		function setCond($condName, $condValue);
		function clearCond($condName);
		function clearConds();
		function retrievePraises();
		function countPraises();
	}

	
	/**
	 * User对象与数据库记录间的联系
	 */
	interface IUserManager
	{
		function getUserInfo(IUserObject $user);
		function addUser(IUserObject $user);
		function deleteUser(IUserObject $user);
		function validateUser(IUserObject $user);
		function updateUserInfo(IUserObject $user);
	}
?>