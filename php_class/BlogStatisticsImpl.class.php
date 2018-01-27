<?php
/**
 * 声明并定义BlogStatisticsImpl类
 *
 * 创建日期：2017.11.20
 * 修改日期：2017.12.04
 */


	$current_dir = dirname(__FILE__);
	require_once("DbManageImpl.class.php");
	require_once("Blog.class.php");
	require_once("../php_functions/fileManager.php");
	require_once("BlogInfoRetrieve.class.php");
	require_once("{$current_dir}/../interface/IBlogStatistics.interface.php");


	/**
	 * IBlogStatistics接口的实现类,继承BlogInfoRetrieve类
	 *
	 * @method retrieveAuthors($isDistinct=1)
	 * @method retrieveCatalogues($isDistinct=1)
	 * @method countBlogs()
	 * @method retrieveCreateDates($isDistinct=1)
	 * @method retrieveModifyDates($isDistinct=1)
	 * @method retrieveTags($isDistinct=1)
	 * @method retrieveTitles($isDistinct=1)
	 */
	class BlogStatisticsImpl extends BlogInfoRetrieve 
		implements IBlogStatistics
	{

		public function __construct()
		{
			parent::__construct();
		}


		/**
		 * 检索符合条件的博客作者
		 *
		 * @param int $isDistinct 是否消除查询结果中的重复项
		 *
		 * @return array 
		 */
		public function retrieveAuthors($isDistinct=1)
		{
			if($isDistinct == 1)
				$sql = "select distinct bAuthor from blog";
			else
				$sql = "select bAuthor from blog";

			$sql = $sql.parent::checkConds();
			return $this->query($sql, "bAuthor");
		}


		/**
		 * 检索符合条件的博客标题
		 *
		 * @param int $isDistinct 是否消除查询结果中的重复项
		 *
		 * @return array 
		 */
		public function retrieveTitles($isDistinct=1)
		{
			if($isDistinct == 1)
				$sql = "select distinct bTitle from blog";
			else
				$sql = "select bTitle from blog";

			$sql = $sql.parent::checkConds();
			return $this->query($sql, "bTitle");
		}


		/**
		 * 检索符合条件的博客标签
		 *
		 * @param int $isDistinct 是否消除查询结果中的重复项
		 *
		 * @return array 
		 */
		public function retrieveTags($isDistinct=1)
		{
			if($isDistinct == 1)
				$sql = "select distinct bTags from blog";
			else
				$sql = "select bTags from blog";

			$sql = $sql.parent::checkConds();
			return $this->query($sql, "bTags");
		}


		/**
		 * 检索符合条件的博客目录
		 *
		 * @param int $isDistinct 是否消除查询结果中的重复项
		 *
		 * @return array 
		 */
		public function retrieveCatalogues($isDistinct=1)
		{
			if($isDistinct == 1)
				$sql = "select distinct bCatalogue from blog";
			else
				$sql = "select bCatalogue from blog";
			
			//echo parent::checkConds(),"qweqwe";
			$sql = $sql.parent::checkConds();
			//echo $sql;
			return $this->query($sql, "bCatalogue");
		}


		/**
		 * 检索符合条件的博客创建日期
		 *
		 * @param int $isDistinct 是否消除查询结果中的重复项
		 *
		 * @return array 
		 */
		public function retrieveCreateDates($isDistinct=1)
		{
			if($isDistinct == 1)
				$sql = "select distinct bCreateDate from blog";
			else
				$sql = "select bCreateDate from blog";

			$sql = $sql.parent::checkConds();
			return $this->query($sql, "bCreateDate");
		}


		/**
		 * 检索符合条件的博客修改日期
		 *
		 * @param int $isDistinct 是否消除查询结果中的重复项
		 *
		 * @return array 
		 */
		public function retrieveModifyDates($isDistinct=1)
		{
			if($isDistinct == 1)
				$sql = "select distinct bModifyDate from blog";
			else
				$sql = "select bModifyDate from blog";

			$sql = $sql.parent::checkConds();
			return $this->query($sql, "bModifyDate");
		}


		/**
		 * 查询blog数目
		 *
		 * @param int $isDistinct 是否消除查询结果中的重复项
		 *
		 * @return array 
		 */
		public function countBlogs($isDistinct=1)
		{
			if($isDistinct == 1)
				$sql = "select count(*) quantity from blog";
			else
				$sql = "select bTitle from blog";

			$sql = $sql.parent::checkConds();
			//echo $sql;
			
			$quantitys = $this->query($sql, "quantity");
			if(sizeof($quantitys) > 0 )
				return $quantitys[0];
			else 
				return 0;
		}


		/**
		 * 执行sql语句，进行查询
		 *
		 * @param string 要执行的sql语句
		 *
		 * @return array 返回结果数组
		 */
		public function query($sql, $colName)
		{
			try
			{
				$results = $this->mDb->query($sql);
				$query_results = array();
				if(sizeof($results) > 0)
				{
					for ($i = 0; $i<sizeof($results); $i++)
					{
						$query_results[$i] = $results[$i]->$colName;
					}
				}
				return $query_results;
			}
			catch(Exception $e)
			{
				echo $e->getMessage();
				return array();
			}
		}
	}
?>