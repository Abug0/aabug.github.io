<?php
/**
 *
 *
 * 创建日期：2017.11.29
 * 修改日期：2017.11.29
 */


	/**
	 * User业务对象
	 */
	interface IUserObject
	{
		/** setter方法 */
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
		function setRegisterDate($registerDate);
	}
?>