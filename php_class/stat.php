<?php
/**
 * 描述：对php类进行测试
 * 创建日期：2017.10.26
 * 修改日期：2017.10.26
 */
	header("Content-Type:text/html; charset=gbk;");
	function __autoload($className)
	{
		$path = $className.".class.php";
		require_once($path);
	}

	$fileWriter = new FileManager("blogs/coder/H.txt");
	//$fileWriter->write("Helo!");
	echo $fileWriter->read(6);
?>