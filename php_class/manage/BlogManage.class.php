<?php
/**
 * 作者：
 * 描述：BlogManage类的声明与定义
 * 创建日期：2017.10.25
 * 修改日期：2017.10.25
 */

	$current_dir = dirname(__FILE__);
	require_once("{$current_dir}/../interface/IBlogObject.interface.php");
	require_once("DbManager.class.php");
	

	/**
	 * 负责Blog类与数据库间的通信
	 *
	 * @method Boolean addBlog(IBlogObject $blog)
	 * @method Boolean deleteBlog(IBlogObject $blog)
	 * @method Boolean getBlog(IBlogObject $blog)
	 * @method Boolean getID(IBlogObject $blog)
	 * @method Boolean validateBlog(IBlogObject $blog)
	 * @method Boolean updateBlog(IBlogObject $blog)
	 */
	class BlogManage
	{
		static private $mDb;
		
		
		/**
		 * 数据库中插入一条新的博客
		 * @param Blog $blog 要存入数据库的新博客
		 * @return Boolean 插入成功返回TRUE，否则FALSE
		 */
		static public function addBlog(Blog $blog)
		{
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
		 * 删除数据库关于指定博客的记录
		 * @param Blog $blog 要删除的博客
		 * @return Boolean 删除成功返回TRUE，否则FALSE
		 */
		static public function deleteBlog(Blog $blog)
		{
			$sql = "delete from blog where bTitle='{$blog->getTitle()}' ";
			
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
		 * 获取数据库中关于该博客的相关记录，并据此设置Blog对象的相关属性
		 * @param Blog $blog 要查询的博客
		 * @return Boolean 查询成功返回TRUE，失败返回FALSE
		 */
		static public function getBlog($blog)
		{
			$sql = "select * from blog where bAuthor='{$blog->getAuthor()}'"
					." and bTitle='{$blog->getTitle()}' ";
					
			try
			{
				$blog_infos = $this->mDb->query($sql);
				if (sizeof($blog_infos) > 0)
				{
					$blog->setAuthor($blog_infos[0]->bAuthor);
					$blog->setTitle($blog_infos[0]->bTitle);
					$blog->setTags($blog_infos[0]->bTags);
					$blog->setCatalogue($blog_infos[0]->bCatalogue);
					$content = fileRead($blog_infos[0]->bContent);
					$blog->setContent($content);
					$blog->setCreateDate($blog_infos[0]->bCreateDate);
					$blog->setID($blog_infos[0]->bID);
					$blog->setModifyDate($blog_infos[0]->bModifyDate);
					return TRUE;
				}
			}
			catch (Exception $e)
			{
				return FALSE;
			}
			return FALSE;
		}

		/**
		 * 获取$blog的ID
		 */
		static public function getID($blog)
		{
			$sql = "select bID from blog "
					."where bAuthor='{$blog->getAuthor()}' "
					."and bTitle='{$blog->getTitle()}'";

			try
			{
				$blog_infos = $this->mDb->query($sql);
				if(sizeof($blog_infos)>0)
				{
					$blog->setID($blog_infos[0]->bID);
					return TRUE;
				}
			}
			catch(Exception $e)
			{
				return FALSE;
			}

			return FALSE;
		}


		/**
		 * 对将要发表的的Blog进行验证
		 * 
		 */
		static public function validateBlog($blog)
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


		/**
		 * 更新数据库中关于$blog的记录
		 */
		static public function updateBlog($blog)
		{
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

	}
?>