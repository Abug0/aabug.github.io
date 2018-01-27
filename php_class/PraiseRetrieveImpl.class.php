<?php
/**
 * 定义UserPraiseAction类
 *
 * 创建日期：2017.11
 * 修改日期：2017.12.04
 */


	$current_dir = dirname(__FILE__);
	require_once("{$current_dir}/../interface/IPraiseRetrieve.interface.php");
	require_once("{$current_dir}/../interface/IUserObject.interface.php");
	require_once("{$current_dir}/./DbManageImpl.class.php");
	require_once("Praise.class.php");


	/**
	 * IPraiseRetrieve的实现类
	 *
	 *
	 */
	class PraiseRetrieveImpl implements IPraiseRetrieve
	{
		private $mDb;
		private $mConds = array(
			"praiser" => "",
			"blogID" => "",
			"praiseDate" => "",
			"limit" => array(-1,-1)
		);
		
		public function __construct()
		{
			$this->mDb = new DbManageImpl();
		}


		/**
		 * 设置查询条件
		 *
		 * @param string $condName 条件名
		 * @param string $condValue 条件值
		 *
		 * @return int 设置成功返回1，否则返回-1
		 */
		public function setCond ($condName, $condValue)
		{
			if(!isset($this->mConds[$condName]))
				return -1;
			
			$this->mConds[$condName] = $condValue;
			return 1;
		}


		/**
		 * 清除某项查询条件
		 *
		 * @param string $condName 条件名
		 *
		 * @return int 清除成功返回1，否则返回-1
		 */
		public function clearCond ($condName)
		{
			if(!isset($this->mConds[$condName]))
				return -1;
			
			if($condName == "limit")
			{
				$this->mConds["limit"][0] = -1;
				$this->mConds["limit"][1] = -1;
			}
			else
			{
				$this->mConds[$condName] = "";
			}
			
			return 1;
		}


		/**
		 * 清空查询条件
		 *
		 * @param string $condName 条件名
		 *
		 * @return int 清空成功返回1，否则返回-1
		 */
		public function clearConds ()
		{
			foreach ($this->mConds as $condName => $condValue)
			{
				if($condName == "limit")
				{
					$this->mConds["limit"][0] = -1;
					$this->mConds["limit"][1] = -1;
				}
				else
				{
					$this->mConds[$condName] = "";
				}
			}

			return 1;
		}


		/**
		 * 从数据库记录的第$startNo条开始查询，知道第$endNo条记录为止
		 * 如果
		 *
		 * @param int $startNo 必须大于等于0，小于0时无意义
		 * @param int $endNo	大于等于0
		 * 
		 * @return int -1 条件设置不合理
		 *				1 条件设置成功
		 */
		public function setLimit(int $startNo, int $endNo=-1)
		{
			if ($startNo <0 || $endNo<-1)
				return 0;
			
			$this->mConds["limit"][0] = $startNo;
			if ($endNo > -1)
				$this->mConds["limit"][1] = $endNo+1;
			
			return 1;
		}


		private function checkPraiser($cond)
		{
			
			
			if($this->mConds["praiser"] != "")
			{
				if (strlen($cond)>=10)
					$cond = $cond." and ";
				$cond = $cond." pPraiser='{$this->mConds["praiser"]}'";
			}
			else
				return $cond."";
			
			return $cond;
		}
		
		private function checkBlogID($cond)
		{	
			//echo $this->mConds["blogID"],"ad";
			if($this->mConds["blogID"] != "")
			{
				if (strlen($cond)>=10)
					$cond = $cond." and ";
				$cond = $cond." pBlogID='{$this->mConds["blogID"]}'";
			}
			else
				return $cond."";
			//echo $cond;
			return $cond;
		}

		private function checkPraiseDate($cond)
		{	
			if($this->mConds["praiseDate"] != "")
			{
				if (strlen($cond)>=10)
					$cond = $cond." and ";
				$cond = $cond." pPraiseDate='{$this->mConds["praiseDate"]}'";
			}
			else
				return $cond."";
			
			return $cond;
		}

		private function checkConds()
		{
			$cond = " where ";
			$cond = $this->checkPraiser($cond);
			$cond = $this->checkBlogID($cond);
			$cond = $this->checkPraiseDate($cond);
			//echo $cond;
			if(strlen($cond)>7)
				return $cond;
			else
				return "";
		}


		public function retrievePraises()
		{
			$sql = "select * from praise";
			$sql = $sql.$this->checkConds();
			//echo $sql;
			/* 执行查询语句 */
			try
			{
				$results = $this->mDb->query($sql);
				$praises = array();
				
				/* 对查询结果进行封装 */
				if(sizeof($results) > 0)
				{
					for ($i = 0; $i<sizeof($results); $i++)
					{
						$praise = new Praise($results[$i]->pPraiser, $results[$i]->pBlogID, 
									$results[$i]->pPraiseDate, $results[$i]->pPraiseIp);
						$praises[$i] = $praise;
					}
				}
				
				return $praises;
			}
			catch(Exception $e)
			{
				//echo $e->getMessage();
				return array();
			}
		}
		
		
		public function countPraises()
		{
			$sql = "select count(*) quantity from praise";
			$sql = $sql.$this->checkConds();
			//echo $sql;
			try
			{
				$results = $this->mDb->query($sql);
				if(count($results)>0)
					return $results[0]->quantity;
				else
					return 0;
			}
			catch(Exception $e)
			{
				return 0;
			}
		}
	}
	
	/*
	$praiseRetriever = new PraiseRetriever();
	$praiseRetriever->setCond("praiser", "coder");
	$praiseRetriever->setCond("blogID", "1");
	//$praiseRetriever->setCond("praiseDate", "2017");
	$praises = $praiseRetriever->retrievePraise();
	//print_r($praises);
	for($i=0; $i<count($praises); $i++)
	{
		echo $praises[$i]->getPraiser();
		echo $praises[$i]->getBlogID();
	}
	*/
?>