<?php
/**
 * 声明IPraiseObject接口
 *
 * 创建日期：2017.11.29
 * 修改日期：2017.12.04
 */


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
?>