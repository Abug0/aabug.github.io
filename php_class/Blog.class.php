<?php
/**
 * 作者：
 * 描述：
 * 创建日期：2017.10.25
 * 修改日期：2017.11.30
 */


	$current_dir = dirname(__FILE__);
	require_once("{$current_dir}/../interface/IBlogObject.interface.php");
	require_once("{$current_dir}/../interface/IUserManage.interface.php");


	class Blog implements IBlogObject
	{
		/** var string 博客作者 */
		private $mAuthor;
		
		/** var string 博客分类 */
		private $mCatalogue;
		
		/** var string 博客内容 */
		private $mContent;
		
		/** var string 创建日期 */
		private $mCreateDate;
	
		/** var int bID 博客的唯一标识*/
		private $mID;
		
		/** var string 修改日期 */
		private $mModifyDate;
		
		/** var string 博客标签 */
		private $mTags;

		/** var string 博客标题 */
		private $mTitle;


		public function __construct($author, $title, $content="", $tags="", $catelog="")
		{
			$this->mAuthor = $author;
			$this->mTitle = trim($title);//移除两侧的空白字符
			//$this->mID = $mID;
			$this->mContent = $content;
			$this->mTags = $tags;
			$this->mCatelog = $catelog;
		}


		/** setter方法 */
		public function setAuthor($author)
		{
			$this->mAuthor = $author;
		}

		public function setCatalogue($catalogue)
		{
			$this->mCatalogue = $catalogue;
		}

		public function setContent($content)
		{
			$this->mContent = $content;
		}

		public function setCreateDate($createDate)
		{
			 $this->mCreateDate = $createDate;
		}

		public function setID($id)
		{
			$this->mID = $id;
		}

		public function setModifyDate($modifyDate)
		{
			$this->mModifyDate = $modifyDate;
		}

		public function setTags($tags)
		{
			$this->mTags = $tags;
		}

		public function setTitle($title)
		{
			$this->mTitle = $title;
		}


		/** getter方法 */
		public function getAuthor()
		{
			return $this->mAuthor;
		}

		public function getCatalogue()
		{
			return $this->mCatalogue;
		}

		public function getContent()
		{
			return $this->mContent;
		}

		public function getCreateDate()
		{
			return $this->mCreateDate;
		}

		public function getID()
		{
			return $this->mID;
		}

		public function getModifyDate()
		{
			return $this->mModifyDate;
		}

		public function getTags()
		{
			return $this->mTags;
		}

		public function getTitle()
		{
			return $this->mTitle;
		}

	}
?>