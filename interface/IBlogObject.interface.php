<?php
/**
 * 定义IBlogObject接口
 *
 * 创建日期：2017.11.29
 * 修改日期：2017.11.29
 */


	/**
	 * Blog对象
	 */
	interface IBlogObject
	{
		/* getter方法 */
		function getAuthor();
		function getCatalogue();
		function getContent();
		function getCreateDate();
		function getID();
		function getModifyDate();
		function getTags();
		function getTitle();

		/* setter方法 */
		function setAuthor($author);
		function setCatalogue($catalogue);
		function setContent($content);
		function setCreateDate($createDate);
		function setID($id);
		function setModifyDate($modifyDate);
		function setTags($tags);
		function setTitle($title);
	}

?>