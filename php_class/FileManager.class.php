<?php
/**
 * 作者：
 * 描述：FileManager类的声明与定义
 * 创建日期：2017.10.2
 * 修改日期：2017.10.26
 */
	
	/**
	 * 对文件执行读写操作
	 */
	class FileManager
	{
		private $mFileName;
		private $mFilePath;
		private $mFileInner;
		private $mRootPath = "../files";
		
		public function __construct($fileName, $fileInner="")
		{
			$this->mFileName = $fileName;
			$this->mFileInner = $fileInner;
			$this->mFilePath = dirname($fileName);
		}
		
		public function __destruct()
		{
			//delete($this);
		}
		
		
		public function write($inner)
		{
			$dirs = explode("/", $this->mFilePath);
			
			/** 逐级检测目录是否存在，若不存在则创建 */
			$tmp_dir = $this->mRootPath;
			foreach ($dirs as $dir)
			{
				$dir = $tmp_dir."/".$dir;
				if (!is_dir($dir))
					mkdir($dir);
				$tmp_dir = $dir;
			}

			$path = $this->mRootPath."/".$this->mFileName;
			if(!$file = fopen($path, "w"))//文件打开失败
				return -1;

			if (!fwrite($file, $inner)) //写入失败
			{
				fclose($file);
				return 0;
			}
				
			fclose($file);//关闭文件
			return 1;
		}
		
		
		public function read($length=0)
		{	
			$path = $this->mRootPath."/".$this->mFileName;
			if (!is_file($path)) //是否合法文件
				return FALSE;

			if(!$file = fopen($path, "r"))//打开失败
				return -1;

			if($length == 0)
				$length = filesize($path);

			$inner = fread($file, $length);
			fclose($file);//关闭文件
			return $inner;
		}
		
		
		/** setter方法 */
		public function setFileName($fileName)
		{
			$this->mFileName = $fileName;
		}
		
		public function setFilePath($filePath)
		{
			$this->mFilePath = $filePath;
		}
		
		public function setRootPath($rootPath)
		{
			$this->mRootPath = $rootPath;
		}
		
		/** getter方法 */
		public function getFileName()
		{
			return $this->mFileName;
		}
		
		public function getFilePath()
		{
			return $this->mFilePath;
		}	
		
		public function getRootPath()
		{
			return $this->mRootPath;
		}
		
	}
?>