<?php
/**
 * 声明和定义IUserAccountAction的实现类
 *
 * 创建日期：2017.11.30
 * 修改日期：2017.11.30
 */


	$current_dir = dirname(__FILE__);
	require_once("{$current_dir}/../interface/IUserObject.interface.php");
	require_once("{$current_dir}/../interface/IUserAccountAction.interface.php");

	require_once("User.class.php");
	require_once("UserManageImpl.class.php");


	date_default_timezone_set("PRC");//设置时区为北京时间


	/**
	 * 实现IUserAccountAction接口
	 * 实现与用户账号相关的一组行为:注册、登录、注销
	 *
	 * @method boolean 	login()
	 * @method boolean 	logout()
	 * @method boolean 	register()
	 *
	 * @property User		$mUser
	 */
	class UserAccountActionImpl implements IUserAccountAction
	{
		/** @var User */
		private $mUser;

		public function __construct(IUserObject $user)//行为发生之前必须首先确定行为主体
		{
			$this->mUser = $user;
			//$this->mDb = new DbManageImpl();
		}


		public function login()
		{
			//验证用户的登录信息
			if (UserManageImpl::validateUser($this->mUser) != 1)
				return FALSE;

			//从数据库中取出与此用户相关的记录
			if( !UserManageImpl::getUser($this->mUser) )
				return FALSE;

			//更新最后一次登录时的时间和IP地址
			$this->mUser->setLastLoginIp($_SERVER["REMOTE_ADDR"]);
			$this->mUser->setLastLoginDate(date("Y-m-d H:i:s"));
			if ( !UserManageImpl::UpdateUser($this->mUser) )
				return FALSE;

			return TRUE;
		}
		
		public function logout()
		{
			
		}


		public function register()
		{
			//如果用户名已经被注册
			if (UserManageImpl::validateUser($this->mUser) != -1)
				return FALSE;

			$this->mUser->setRegisterDate(date("Y-m-d H:i:s"));

			if ( UserManageImpl::addUser($this->mUser) )
				return TRUE;
			else
				return FALSE;
		}
	}
?>