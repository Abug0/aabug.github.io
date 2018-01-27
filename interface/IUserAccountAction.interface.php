<?php
/**
 *
 * 定义IUserAccountAction接口
 * 创建日期：2017.11.30
 * 修改日期：2017.11.30
 */


	/**
	 * 用户行为
	 * 一组与用户账号相关的行为
	 * Account:登录、注册、退出
	 *
	 * 实现类为UserAccountActionImpl
	 */
	interface IUserAccountAction
	{
		function login();
		function logout();
		function register();
	}

?>