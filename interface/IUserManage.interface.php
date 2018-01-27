<?php
/**
 * 定义IUserManage接口
 *
 * 创建日期:2017.11.29
 * 修改日期:2017.11.29
 */


	/**
	 * User对象与数据库间的通信
	 */
	interface IUserManage
	{
		static function addUser(IUserObject $user);
		static function deleteUser(IUserObject $user);
		static function validateUser(IUserObject $user);
		static function updateUser(IUserObject $user);
		static function getUser(IUserObject $user);
	}
?>