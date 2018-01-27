<?php
/**
 * 声明并定义IBlogSearch的实现类
 *
 * 创建日期：2017.11.08
 * 修改日期：2017.12.04
 */


	$current_dir = dirname(__FILE__);
	require_once("DbManageImpl.class.php");
	require_once("Blog.class.php");
	require_once("../php_functions/fileManager.php");
	require_once("BlogInfoRetrieve.class.php");
	require_once("{$current_dir}/../interface/IBlogSearch.interface.php");


	/**
	 * 实现IBlogSearch接口,父类是BlogInfoRetrieve
	 * 在数据库中查找符合条件的博客对象
	 *
	 * @method void __construct
	 * @method array searchBlog() 
	 */
	class BlogSearchImpl extends BlogInfoRetrieve implements IBlogSearch
	{

		public function __construct()
		{
			parent::__construct();
		}


		/**
		 * 查找符合条件的blog
		 *
		 * @return array 返回Blog对象数组
		 */	
		public function searchBlog()
		{
			$sql = "select * from blog";
			$sql = $sql.$this->checkConds();
			//echo $sql;
			/* 执行查询语句 */
			try
			{
				$results = $this->mDb->query($sql);
				$blogs = array();
				
				/* 对查询结果进行封装 */
				if(sizeof($results) > 0)
				{
					for ($i = 0; $i<sizeof($results); $i++)
					{
						$blog = new Blog($results[$i]->bAuthor, $results[$i]->bTitle);
						$blog->setTags($results[$i]->bTags);
						$blog->setCatalogue($results[$i]->bCatalogue);
						$content = fileRead($results[$i]->bContent);
						$blog->setContent($content);
						$blog->setCreateDate($results[$i]->bCreateDate);
						$blog->setID($results[$i]->bID);
						$blog->setModifyDate($results[$i]->bModifyDate);
						$blogs[$i] = $blog;
					}
				}
				
				return $blogs;
			}
			catch(Exception $e)
			{
				echo $e->getMessage();
				return array();
			}
			
		}

	}
	/*
	$query = new BlogSearcher();
	//$blogs = $query->searchByAuthor("coder");
	//$blogs = $query->searchByTitle("吕氏春秋");
	//$blogs = $query->searchByTags("吕氏春秋", 1);
	//$blogs = $query->searchByCreateDate("2017-10-01", "2017-11-01");
	//$blogs = $query->searchByModifyDate("2017-10-01", "2017-11-01");
	//print_r($users);
	$query->setCond("author", "coder", 1);
	$query->setCond("title", "Hello", 0);
	//$query->setCond("tags", "coder", 1);
	//$query->setCond("Catalogue", "coder", 0);
	//$query->setCond("createDate1", "2017-11-01");
	//$query->setCond("createDate2", "2017-11-01", 1);
	//$query->setCond("modifyDate1", "2017-11-01", 1);
	//$query->setCond("modifyDate2", "2017-11-01", 1);
	$blogs = $query->search();
	//print_r($blogs);
	//print count($blogs);
	for ($i = 0; $i<count($blogs); $i++)
	{
		echo $blogs[$i]->getTitle()."<br>";
	}	
	*/
?>