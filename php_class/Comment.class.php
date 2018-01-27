<?php
/**
 * 作者：.
 * 描述：声明和定义ICommentObject的实现类,Comment类
 *
 * 创建日期：2017.12.06
 * 修改日期：2017.12.06
 */


	$current_dir = dirname(__FILE__);
	include_once("{$current_dir}/../interface/ICommentObject.interface.php");


	/**
	 * ICommentObject的实现类
	 */
	class Comment implements ICommentObject
	{
		private $mCommentID;
		private $mCommenter;
		private $mContent;
		private $mCommentDate;
		private $mCommentIp;
		private $mBlogID;


		/* getter */
		public function getCommentID()
		{
			return $this->mCommentID;
		}

		/* getter */
		public function getCommenter()
		{
			return $this->mCommenter;
		}

		/* getter */
		public function getContent()
		{
			return $this->mContent;
		}

		/* getter */
		public function getCommentDate()
		{
			return $this->mCommentDate;
		}

		/* getter */
		public function getCommentIp()
		{
			return $this->mCommentIp;
		}

		/* getter */
		public function getBlogID()
		{
			return $this->mBlogID;
		}


		/* setter */
		public function setCommenter($commenter)
		{
			$this->mCommenter = $commenter;
		}

		/* setter */
		public function setContent($content)
		{
			$this->mContent = $content;
		}

		/* setter */
		public function setCommentDate($commentDate)
		{
			$this->mCommentDate = $commentDate;
		}

		/* setter */
		public function setCommentIp($commenIp)
		{
			$this->mCommentIp = $commentIp;
		}

		/* setter */
		public function setBlogID($blogID)
		{
			$this->mBlogID = $blogID;
		}

	}
?>
