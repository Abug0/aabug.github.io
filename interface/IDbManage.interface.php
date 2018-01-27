<?php
/**
 *
 * 定义IDbManage接口
 * 创建日期：2017.11.30
 * 修改日期：2017.11.30
 */


	$current_dir = dirname(__FILE__);
	//require_once("{$current_dir}/../interface/IBlogObject.interface.php");


	/**
	 * 
	 *
	 * 实现类为DbManageImpl
	 */
	interface IDbManage
	{
		function executeSql(string $sql);
		function query(string $sql);
	}

?>