<?php

	function fileRead($fileName, $length=0)
	{	
		$path = $fileName;
		if (!is_file($path) Or !is_Readable($path)) //是否合法文件，是否可读
			return -1;

		if(!$file = fopen($path, "r"))//打开失败
			return 0;

		if($length == 0)
			$length = filesize($path)+1;


		$inner = fread($file, $length);
		fclose($file);//关闭文件
		return $inner;
	}

?>