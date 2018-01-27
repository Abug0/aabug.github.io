<?php
/**
 * 声明和定义IUserBlogAction的实现类
 *
 * 创建日期：2017.11.30
 * 修改日期：2017.11.30
 */


	$current_dir = dirname(__FILE__);
	require_once("{$current_dir}/../interface/IUserBlogAction.interface.php");
	require_once("{$current_dir}/../interface/IBlogObject.interface.php");

	//require_once("../php_functions/fileManager.php");
	require_once("DbManageImpl.class.php");


	/**
	 * 实现IUserBlogAction接口
	 * 实现与用户自己的博客相关的一组行为:发布、修改、删除
	 *
	 * @method Boolean publishBlog(IBlogObject $blog)
	 * @method Boolean deleteBlog(IBlogObject $blog)
	 * @method Boolean modifyBlog(IBlogObject $blog)
	 */
	class UserBlogActionImpl implements IUserBlogAction
	{
		private $mDb;


		public function __construct()//动作发生前必须首先确定行为主体
		{
			$this->mDb = new DbManageImpl();
		}


		/**
		 * 删除数据库关于指定博客的记录
		 *
		 * @param IBlogObject $blog 要删除的IBlogObject对象
		 *
		 * @return boolean 删除成功返回TRUE，否则FALSE
		 */
		public function deleteBlog(IBlogObject $blog)
		{
			$sql = "delete from blog where bTitle='{$blog->getID()}' ";

			try
			{
				$this->mDb->executeSql($sql);
			}
			catch (Exception $e)
			{
				return FALSE;
			}
			
			return TRUE;
		}


		/**
		 * 修改博客内容
		 *
		 * @param IBlogObject $blog 要修改的IBlogObject对象
		 *
		 * @return boolean 修改成功返回TRUE,修改失败返回FALSE
		 */
		public function modifyBlog(IBlogObject $blog)
		{
			//获取博客ID之前无法修改
			if( $blog->getID() == "" )
			{
				return FALSE;
			}

			$blog->setModifyDate(date("Y-m-d H:i:s"));

			$sql = "update blog set "
					."bTitle='{$blog->getTitle()}', "
					."bContent='{$blog->getContent()}', "
					."bCatalogue='{$blog->getCatalogue()}', "
					."bTags='{$blog->getTags()}', "
					."bModifyDate='{$blog->getModifyDate()}' "
					."where bID={$blog->getID()}";

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
		 * 发表博客,在数据库中添加关于该IBlogObject对象的记录
		 *
		 * @param IBlogObject 要发布的IBlogObject对象
		 *
		 * @return boolean 发布成功返回TRUE,发布失败返回FALSE
		 */
		public function publishBlog(IBlogObject $blog)
		{
			//首先要对博客信息进行验证
			if (!$this->validateBlog($blog))
				return FALSE;

			$sql = "insert into blog(bAuthor, bTitle, "
					."bContent, bTags, bCatelog, bCreateDate, bModifyDate)"
					."values('{$blog->getAuthor()}','{$blog->getTitle()}',"
					."'{$blog->getContent()}','{$blog->getTags()}',"
					."'{$blog->getCatelog()}','{$blog->getCreateDate()}',"
					."'{$blog->getModifyDate()}')";
					
			try
			{
				$this->mDb->executeSql($sql);
			}
			catch (Exception $e)
			{
				return FALSE;
			}
			
			return TRUE;
		}


		/**
		 * 对将要发表的博客进行验证
		 * 
		 */
		public function validateBlog(IBlogObject $blog)
		{
			$sql = "select bTitle from blog "
					."where bAuthor='{$blog->getAuthor()}' "
					."and bTitle='{$blog->getTitle()}' ";

			try
			{
				$blog_info = $this->mDb->query($sql);
				if(sizeof($blog_info)>0)
					return FALSE;
			}
			catch(Exception $e)
			{
				return FALSE;
			}

			return TRUE;
		}

	}
?>