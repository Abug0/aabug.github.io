<?php
/**
 *
 *
 * 创建日期：2017.11.29
 * 修改日期：2017.11.29
 */


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
?>