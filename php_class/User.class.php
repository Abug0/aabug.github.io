<?php
/**
 * 作者：.
 * 描述：声明和定义IUSerObject的实现类,User类
 *
 * 创建日期：2017.08.14
 * 修改日期：2017.11.29
 */


	$current_dir = dirname(__FILE__);
	include_once("{$current_dir}/../interface/IUserObject.interface.php");
	date_default_timezone_set("PRC");


	/**
	 * User类,存储用户信息
	 *
	 * @method 	__construct()
	 * @method 	__destruct()
	 * @method boolean 	login()
	 * @method boolean 	logout()
	 * @method boolean 	register()
	 * @method string 	getter
	 * @method string 	setter
	 *
	 * @var string		$mHeadImagePath
	 * @var datetime	$mLastLoginDate
	 * @var string		$mLastLoginIp
	 * @var string		$mName
	 * @var string		$mPassword
	 * @var datetime	$mRegisterDate
	 */
	class User implements IUserObject
	{
		/** @var string 用户头像的存储路径 */
		private $mHeadImagePath;

		/** @var datetime 用户上次登录时间 */
		private $mLastLoginDate;

		/** @var string 用户上次登录使用的IP */
		private $mLastLoginIp;

		/** @var string 用户名 */
		private $mName;

		/** @var string $mPassword 用户密码 */
		private $mPassword;

		/** @var datetime 用户的注册日期 */
		private $mRegisterDate;
		

		public function __construct($name="", $password="", $headImagePath="")
		{
			$this->mName = $name;
			$this->mPassword = $password;
			$this->mHeadImagePath = $headImagePath;
			//$this->mUserManager = new UserManager();
		}


		public function __destruct()
		{
			
		}


		/** getter方法 */
		public function getHeadImagePath()
		{
			return $this->mHeadImagePath;
		}
		
		public function getLastLoginDate()
		{
			return $this->mLastLoginDate;
		}
		
		public function getLastLoginIp()
		{
			return $this->mLastLoginIp;
		}
		
		public function getName()
		{
			return $this->mName;
		}
		
		public function getPassword()
		{
			return $this->mPassword;
		}
		
		public function getRegisterDate()
		{
			return $this->mRegisterDate;
		}
		
		
		/** setter方法 */
		public function setHeadImagePath($headImagePath)
		{
			$this->mHeadImagePath = $headImagePath;
		}
		
		public function setLastLoginDate($lastLoginDate)
		{
			$this->mLastLoginDate = $lastLoginDate;
		}
		
		public function setLastLoginIp($lastLoginIp)
		{
			$this->mLastLoginIp = $lastLoginIp;
		}
		
		public function setName($name)
		{
			$this->mName = $name;
		}
		
		public function setPassword($password)
		{
			$this->mPassword = $password;
		}
		
		public function setRegisterDate($registerDate)
		{
			$this->mRegisterDate = $registerDate;
		}
	}
?>