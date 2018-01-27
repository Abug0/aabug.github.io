<?php
/**
 * 定义BlogInfoRetrieve类
 *
 * 创建日期：2017.11.20
 * 修改日期：2017.12.04
 */

	require_once("DbManageImpl.class.php");
	require_once("Blog.class.php");
	require_once("../php_functions/fileManager.php");


	/**
	 * 父类,声明为abstract
	 * 声明为abstract,不可实例化,不提供对外的接口
	 * 仅为实现代码复用提供继承
	 */
	abstract class BlogInfoRetrieve
	{
		protected $mDb;
		protected $mConds = array(
			"author" => array("",0),
			"title" => array("",0),
			"catalogue" => array("",0),
			"tags" => array("",0),
			"limit" => array(-1, -1),
			"createDate1" => "",
			"createDate2" => "",
			"modifyDate1" => "",
			"modifyDate2" => ""
		);


		protected function __construct()
		{
			$this->mDb = new DbManageImpl();
		}


		protected function checkAuthor($cond)
		{
			if(!empty($this->mConds["author"][0]))
			{
				if($this->mConds["author"][1] == 1)
					$cond = $cond." bAuthor like "."'%".$this->mConds["author"][0]."%' ";
				else
					$cond = $cond." bAuthor="."'".$this->mConds["author"][0]."' ";
			}
			return $cond;
		}

		protected function checkCatalogue($cond)
		{
			//echo $this->mConds["catalogue"][0];
			if(!empty($this->mConds["catalogue"][0]))
			{
				if( (strlen($cond)>7))
					$cond = $cond." and ";
				
				if($this->mConds["catalogue"][1] == 1)
					$cond = $cond." bCatalogue like "."'%".$this->mConds["catalogue"][0]."%' ";
				else
					$cond = $cond." bCatalogue="."'".$this->mConds["catalogue"][0]."' ";
			}
			//echo $cond;
			return $cond;
		}

		protected function checkCreateDate($cond)
		{
			if(!empty($this->mConds["createDate1"]))
			{
				if( (strlen($cond)>7))
					$cond = $cond." and ";
				if(!empty($this->mConds["createDate2"]))
					$cond = $cond." bCreateDate between '".$this->mConds["createDate1"]
							."' and '".$this->mConds["createDate2"]."'";
				else
					$cond = $cond." bCreateDate='".$this->mConds["createDate1"]."'";
			}

			return $cond;
		}

		protected function checkTags($cond)
		{
			if(!empty($this->mConds["tags"][0]))
			{
				if( (strlen($cond)>7))
					$cond = $cond." and ";
				if($this->mConds["tags"][1] == 1)
					$cond = $cond." bTags like "."'%".$this->mConds["tags"][0]."%' ";
				else
					$cond = $cond." bTags="."'".$this->mConds["tags"][0]."' ";
			}
			return $cond;
		}

		protected function checkModifyDate($cond)
		{
			if(!empty($this->mConds["modifyDate1"]))
			{
				if( (strlen($cond)>7))
					$cond = $cond." and ";
				if(!empty($this->mConds["modifyDate2"]))
					$cond = $cond." bModifyDate between '".$this->mConds["modifyDate1"]
							."' and '".$this->mConds["modifyDate2"]."'";
				else
					$cond = $cond." bModifyDate ='".$this->mConds["modifyDate1"]."'";
			}
			return $cond;
		}

		protected function checkTitle($cond)
		{
			if(!empty($this->mConds["title"][0]))
			{
				if( (strlen($cond)>7))
					$cond = $cond." and ";
				if($this->mConds["title"][1] == 1)
					$cond = $cond." bTitle like "."'%".$this->mConds["title"][0]."%' ";
				else
					$cond = $cond." btitle="."'".$this->mConds["title"][0]."' ";
			}
			return $cond;
		}

		protected function checkLimit($cond)
		{
			if($this->mConds["limit"][0] == -1)
				return $cond;
			else
			{
				if( (strlen($cond) <= 7))
					$cond = " ";
				
				$cond = $cond." LIMIT {$this->mConds["limit"][0]}";
				if($this->mConds["limit"][1] != -1)
					$cond = $cond." ,{$this->mConds["limit"][1]}";
			}
			
			return $cond;
		}

		/** 
		 * 对查询条件进行检查，拼接 
		 */
		protected function checkConds()
		{
			$cond = " where ";
			/* 逐列检查条件 */
			$cond = $this->checkAuthor($cond);
			$cond = $this->checkTitle($cond);
			$cond = $this->checkCatalogue($cond);
			$cond = $this->checkTags($cond);
			$cond = $this->checkCreateDate($cond);
			$cond = $this->checkModifyDate($cond);
			$cond = $this->checkLimit($cond);
			if(strlen($cond)>7)
				return $cond;
			else
				return "";
		}


		/**
		 * 设置多条件组合查询时的查询条件
		 *
		 * @param string $condName 条件名
		 * @param string $condValue 条件值
		 * @param int $isFuzzy 是否对该列使用模糊查询 
		 *
		 * @return 1 设置成功
		 *			-1 设置出错
		 */
		public function setCond($condName, $condValue, $isFuzzy=0)
		{
			if( !isset($this->mConds[$condName]) )
				return -1;
			if(gettype($this->mConds[$condName]) == "array")
			{
				$this->mConds[$condName][0] = $condValue;
				$this->mConds[$condName][1] = $isFuzzy;
			}
			else
				$this->mConds[$condName] = $condValue;
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

		/**
		 * 清空查询条件
		 */
		public function clearConds()
		{
			foreach ($this->mConds as $condName => $condValue)
			{
				if(gettype($this->mConds[$condName]) == "array")
				{
					$this->mConds[$condName][0] = "";
					$this->mConds[$condName][1] = 0;
				}
				else
					$this->mConds[$condName] = "";
			}
			$this->mConds["limit"][0] = -1;
			$this->mConds["limit"][1] = -1;
		}


		/**
		 * 清除某项查询条件
		 */
		public function clearCond($condName)
		{
			if( !isset($this->mConds[$condName]) )
				return -1;
			if ($condName == "limit")
			{
				$this->mConds["limit"][0] = -1;
				$this->mConds["limit"][1] = -1;
			}
			else
			{
				if(gettype($this->mConds[$condName]) == "array")
				{
					$this->mConds[$condName][0] = "";
					$this->mConds[$condName][1] = 0;
				}
				else
					$this->mConds[$condName] = "";
			}

			return 1;
		}

	}
?>