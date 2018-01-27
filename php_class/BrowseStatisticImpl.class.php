<?php
/**
 * 声明并定义IBrowseStatistic的实现类
 *
 * 创建日期：2017.12.05
 * 修改日期：2017.12.05
 */


	$current_dir = dirname(__FILE__);
	require_once("DbManageImpl.class.php");
	require_once("{$current_dir}/../interface/IBrowseStatistic.interface.php");

	class browseStatisticsImpl implements IBrowseStatistic
	{
		private $mDb;


		public function __construct()
		{
			$this->mDb = new DbManageImpl();
		}
		
		
		public function statisticBrowser($blogId)
		{
			$sql = "select bBrowser from browse "
					." where brBlogID='{$blogId}'";
			
			try
			{
				$results = $this->mDb->query($sql);
				return $results;
			}
			catch(Exception $e)
			{
				return array();
			}
		}
		
		
		/**
		 * @TODO:
		 */
		public function statisticblogs($userName)
		{
			
		}
		
		
		public function statisticPageview($blogId)
		{
			$sql = "select count(*) quantity from browse "
					." where brBlogID='{$blogId}'";
			
			try
			{
				$results = $this->mDb->query($sql);
				if( count($results)>0 )
					return $results[0]->quantity;
			}
			catch(Exception $e)
			{
				return 0;
			}
		}
	}
?>