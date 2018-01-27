<?php
/**
 *
 *
 * 创建日期：2017.11.27
 * 修改日期：2017.11.27
 */


	$current_dir = dirname(__FILE__);
	include_once("{$current_dir}/../interface/IPraiseObject.interface.php");


	class Praise implements IPraiseObject
	{
		private $mBlogID;
		private $mDb;
		private $mPraiseDate;
		private $mPraiseIp;
		private $mPraiser;


		public function __construct($praiser, $blogID, $praiseDate="", $praiseIp="")
		{
			$this->mPraiser = $praiser;
			$this->mBlogID = $blogID;
			$this->mDb = new DbManageImpl();
			
			$this->mPraiseDate = $praiseDate;
			$this->mPraiseIp = $praiseIp;
		}


		/**
		 * 将Praise提交到数据库中
		 * 
		 * @return BOOLEAN 提交成功返回TRUE，否则FALSE
		 */
		public function submitPraise()
		{
			$sql = "insert into praise(pPraiser, pBlogID, pPraiseDate, pPraiseIp)"
					." values('{$this->mPraiser}', '{$this->mBlogID}', "
					." '{$this->mPraiseDate}', '{$this->mPraiseIp}')";

			try
			{
				$this->mDb->executeSql($sql);
			}
			catch(Exception $e)
			{
				return FALSE;
			}
			
			return TRUE;
		}



		/**
		 * 取消赞，删除数据库中对应的记录
		 * 
		 * @return BOOLEAN 取消成功返回TRUE，否则FALSE
		 */
		public function cancelPraise()
		{
			$sql = "delete from praise where pPraiser='{$this->mPraiser}'"
					." and pBlogID='{$this->mBlogID}'";

			//echo $sql;
			try
			{
				$this->mDb->executeSql($sql);
			}
			catch(Exception $e)
			{
				//echo $e->getMessage();
				return FALSE;
			}
			
			return TRUE;
		}


		/* getter方法 */
		public function getBlogID()
		{
			return $this->mBlogID;
		}

		/* getter方法 */
		public function getPraiseDate()
		{
			return $this->mPraiseDate;
		}

		/* getter方法 */
		public function getPraiseIp()
		{
			return $this->mPraiseIp;
		}

		/* getter方法 */
		public function getPraiser()
		{
			return $this->mPraiser;
		}


		/* setter方法 */
		public function setBlogID($blogID)
		{
			
		}

		/* setter方法 */
		public function setPraiseDate($praiseDate)
		{
			
		}

		/* setter方法 */
		public function setPraiseIp($praiseIp)
		{
			
		}

		/* setter方法 */
		public function setPraiser($praiser)
		{
			
		}
	}
?>