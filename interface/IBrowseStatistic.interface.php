<?php
/**
 * 定义IBrowseStatistic接口
 *
 * 创建日期：2017.12.05
 * 修改日期：2017.12.05
 */


	/**
	 * 对数据库中符合条件的浏览记录进行检索、统计
	 *
	 * 实现类为PraiseRetrieveImpl
	 */
	interface IBrowseStatistic
	{
		//function setCond($condName, $condValue);
		//function clearCond($condName);
		//function clearConds();
		function statisticBrowser($blogId);
		function statisticBlogs($userName);
		function statisticPageview($blogId);
	}
?>