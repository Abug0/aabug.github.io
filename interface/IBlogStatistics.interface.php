<?php
/**
 *
 *
 * 创建日期：2017.11.29
 * 修改日期：2017.12.04
 */


	/**
	 * 对博客的相关信息进行统计
	 * 获取符合条件的博客目录、标题、日期等信息
	 *
	 * 实现类为BlogStatisticsImpl
	 */
	Interface IBlogStatistics
	{
		function retrieveAuthors($isDistinct=1);
		function retrieveCatalogues($isDistinct=1);
		function countBlogs();
		function retrieveCreateDates($isDistinct=1);
		function retrieveModifyDates($isDistinct=1);
		function retrieveTags($isDistinct=1);
		function retrieveTitles($isDistinct=1);
		function setCond($condName, $condValue, $isFuzzy=0);
		function clearCond($condName);
		function clearConds();
	}
?>