<?php
/**
 * 定义UserPraiseAction类
 *
 * 创建日期：2017.12.04
 * 修改日期：2017.12.04
 */


	$current_dir = dirname(__FILE__);
	require_once("{$current_dir}/../interface/IUserPraiseAction.interface.php");
	require_once("{$current_dir}/../interface/IUserObject.interface.php");
	require_once("{$current_dir}/./DbManageImpl.class.php");


	/**
	 *
	 */
	class UserPraiseActionImpl implements IUserPraiseAction
	{
		private $mUser;
		private $mDb;

		public function __construct(IUserObject $user)
		{
			$this->mUser = $user;
			$this->mDb = new DbManageImpl();
		}


		public function praiseBlog($blogId)
		{
			$praise_date = date("Y-m-d H:i:s");
			$praise_ip = $_SERVER["REMOTE_ADDR"];

			$sql = "insert into praise(pPraiser, pBlogID, pPraiseDate, pPraiseIp)"
					." values('{$this->mUser->getName()}', '{$blogId}', "
					." '{$praise_date}', '{$praise_ip}')";
			
			try
			{
				//echo $sql;
				$this->mDb->executeSql($sql);
			}
			catch(Exception $e)
			{
				//echo $e->getMessage();
				return FALSE;
			}
			
			return TRUE;
		}


		public function cancelPraise($blogId)
		{
			$sql = "delete from praise where "
					."  pPraiser='{$this->mUser->getName()}' "
					." and pBlogID={$blogId}";
			
			try
			{
				$this->mDb->executeSql($sql);
			}
			catch(Exception $e)
			{
				echo $e->getMessage();
				return FALSE;
			}
			
			return TRUE;
		}
	}
?>