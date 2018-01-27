<?php
/**
 * 定义IPraiseRetrieve接口
 *
 * 创建日期：2017.11.29
 * 修改日期：2017.12.04
 */


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
?>