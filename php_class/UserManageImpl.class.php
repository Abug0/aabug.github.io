<?php
/**
 * 作者：.
 * 描述：声明和定义IUserManage的实现类,UserManageImpl类
 * 创建日期：2017.10.10
 * 修改日期：2017.11.30
 */


	$current_dir = dirname(__FILE__);
	require_once("{$current_dir}/../interface/IUserObject.interface.php");
	require_once("{$current_dir}/../interface/IUserManage.interface.php");

	require_once("DbManageImpl.class.php");

	date_default_timezone_set("PRC");//设置时区为北京时间


	/**
	 * UserManageImpl
	 * IUserManage的实现类
	 * 在数据库中添加、删除。修改、验证、查询User对象
	 *
	 * @method __construct()
	 * @method __destruct()
	 * @method 			getUser(IUserObject $user)
	 * @method boolean 	addUser(IUserObject $user)
	 * @method boolean 	deleteUser(IUserObject $user)
	 * @method int 		validateUser(IUserObject $user)
	 * @method boolean 	updateUser(IUserObject $user)
	 *
	 * @property DbManageImpl $mDb
	 */
	class UserManageImpl implements IUserManage
	{
		static private $mDb = null;
	
		function __construct ()
		{
			self::$mDb = new DbManageImpl();
		}
		
		
		/**
		 * 将User对象记录到数据库中
		 *
		 * @param IUserObject $user 要插入的新用户
		 *
		 * @return boolean true(false) 数据插入成功（失败）
		 *
		 */
		static public function addUser (IUserObject $user)
		{
			$sql="insert into user(uName,uPassword,uRegisterDate,uHeadImagePath) "
					."values "
					."('{$user->getName()}',"
					." '{$user->getPassword()}',"
					."'{$user->getRegisterDate()}',"
					."'{$user->getHeadImagePath()}')";

			try
			{
				self::$mDb = new DbManageImpl();
				self::$mDb->executeSql($sql);		
			}
			catch (Exception $e)
			{
				//echo $e->getMessage();
				return FALSE;
			}
			finally
			{
				self::$mDb = null;
			}

			return TRUE;
		}
		
		
		/**
		 * 删除一条用户记录
		 *
		 * @param IUserObject $user 要删除的用户
		 *
		 * @return boolean 删除成功返回TRUE,否则FALSE
		 */
		static public function deleteUser (IUserObject $user)
		{
			$sql = "delete from user where uName='{$user->getName()}' ";
			
			try
			{
				self::$mDb = new DbManageImpl();
				self::$mDb->executeSql($sql);
			}
			catch (Exception $e)
			{
				return FALSE;
			}
			finally
			{
				self::$mDb = null;
			}

			return TRUE;
		}


		/**
		 * 对User对象的身份信息进行验证
		 *
		 * @return -2 查询出错
		 *		-1 没有查询到相关记录
		 *		0 密码错误
		 *		1 密码正确
		 */
		static public function validateUser(IUserObject $user)
		{
			$sql = "select * from user where uName='{$user->getName()}'";
			try
			{
				self::$mDb = new DbManageImpl();
				$user_info = self::$mDb->query($sql);
			}
			catch(Exception $e)
			{
				return -2;
			}
			finally
			{
				self::$mDb = null;
			}

			if(sizeof($user_info)<=0)
				return -1;
			
			if($user_info[0]->uPassword != $user->getPassword())
				return 0;

			return 1;
		}


		/**
		 * 更新User对象在数据库中的信息
		 *
		 * @param IUserObject $user 要更新的用户对象
		 *
		 * @return boolean 更新失败返回FALSE,更新成功返回TRUE
		 */
		static public function updateUser (IUserObject  $user)
		{
			$sql = "update user set"
					." uHeadImagePath='{$user->getHeadImagePath()}',"
					." uLastLoginDate='{$user->getLastLoginDate()}',"
					." uLastLoginIp='{$user->getLastLoginIp()}',"
					." uRegisterDate='{$user->getRegisterDate()}'"
					." where uName='{$user->getName()}' ";

			//echo $sql;
			try
			{
				self::$mDb = new DbManageImpl();
				self::$mDb->executeSql($sql);
			}
			catch (Exception $e)
			{
				echo $e->getMessage();
				return false;
			}
			finally
			{
				self::$mDb = null;
			}

			return TRUE;
		}

		
		/** 
		 * 从数据库查找一个User对象并将信息封装进$user
		 *
		 * @param IUserObject $user 要查询的User对象
		 *
		 * @return boolean 查询到结果返回TRUE,出错或无结果返回FALSE
		 */
		static public function getUser (IUserObject $user)
		{
			$user_info = array();
			
			$sql = "select * from user where uName='{$user->getName()}' ";
			try
			{
				self::$mDb = new DbManageImpl();
				$results = self::$mDb->query($sql);
				if(count($results) > 0)
				{
					$user->setHeadImagePath($results[0]->uHeadImagePath);
					$user->setLastLoginDate($results[0]->uLastLoginDate);
					$user->setLastLoginIp($results[0]->uLastLoginIp);
					$user->setPassword($results[0]->uPassword);
					$user->setRegisterDate($results[0]->uRegisterDate);
				}
				
			}
			catch(Exception $e)
			{
				echo $e->getMessage();
				return FALSE;
			}
			finally
			{
				self::$mDb = new DbManageImpl();
			}

			return TRUE;
		}

	}
	
?>