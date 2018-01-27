<?php
	/*******************************************
	*作者：.
	*创建日期：2017.08.12
	*描述：声明并定义了一些通用函数
	*修改日期：2017.08.12
	*******************************************/


	/**
	 * 读取指定文件的内容
	 *
	 * @param string arget_file_path 要读取的目标文件
	 *
	 * @return 
	 *	读取失败	FALSE
	 *	读取成功	存有文件内容的数组
	 */
	function getFileInner ($target_file_path)
	{

		//检查文件是否存在或可读，如果否，返回FALSE
		if (!file_exists($target_file_path) OR !is_readable($target_file_path) )
		{
			return FALSE;
		}

		$fp=fopen($target_file_path,"r");
		if (!$fp)
			return FALSE;

		$file_inner_array=array(); //数组变量，存放文件内容
		$i=0;

		//逐行读取文件内容，并存入数组
		//数组的每个元素是文件的一行内容
		while (!feof($fp))
		{
			$line=fgets($fp);
			$file_inner_array[$i]=$line;
			$i++;
		}
		return $file_inner_array;
	}
?>