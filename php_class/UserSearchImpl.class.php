<?php
/**
 * 作者：
 * 描述：
 * 创建日期：2017.11.08
 * 修改日期：2017.11.08
 */

	require_once("DbManageImpl.class.php");
	require_once("User.class.php");

	class UserSearchImpl
	{
		private $mDb;
		
		public function __construct()
		{
			$this->mDb = new DbManageImpl();
		}


		/**
		 * 根据昵称查找用户
		 */
		public function searchByName($name, $isFuzzy=1)
		{
			$sql = "select * from user "
					."where uName ";

			if($isFuzzy == 1)
				$sql = $sql." like "."'%{$name}%'";
			else
				$sql = $sql." = "."'{$name}'";

			if( count($this->query($sql)) > 0 )
				return $this->query($sql)[0];
			else
				return null;
		}


		/**
		 * 根据注册日期查找用户
		 */
		public function searchByRegisterDate($date1, $date2="")
		{
			$sql = "select * from user "
					."where uRegisterDate ";

			if(empty($date2))
				$sql = $sql." = "."'{$date1}'";
			else
				$sql = $sql." between "."'{$date1}' and '{$date2}'";
			
			return $this->query($sql);
		}


		/**
		 * 执行sql语句，进行查询
		 */
		public function query($sql)
		{
			try
			{
				$results = $this->mDb->query($sql);
				if(sizeof($results) > 0)
				{
					$users = array();
					for ($i = 0; $i<sizeof($results); $i++)
					{
						$user = new User();
						$user->setName($results[$i]->uName);
						$user->setPassword($results[$i]->uPassword);
						$user->setHeadImagePath($results[$i]->uHeadImagePath);
						$user->setLastLoginDate($results[$i]->uLastLoginDate);
						$user->setLastLoginIp($results[$i]->uLastLoginIp);
						$user->setRegisterDate($results[$i]->uRegisterDate);
						$users[$i] = $user;
					}
					return $users;
				}
				return 0;
			}
			catch(Exception $e)
			{
				echo $e->getMessage();
				return -1;
			}
			
		}

	}
	
	/*$query = new UserSearcher();
	//$users = $query->searchByName("a",1);
	//$users = $query->searchByRegisterDate("2017-08-18");
	//print_r($users);
	for ($i = 0; $i<sizeof($users); $i++)
	{
		echo $users[$i]->getName()."<br>";
	}
*/	
?>