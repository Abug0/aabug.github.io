<?php
/**
 * 作者：
 * 描述：声明并定义类FileUploader，对文件进行上传等操作
 * 创建日期：2017.10.24
 * 修改日期：2017.10.24
 */
 
	/**
	 * 对用户上传的文件进行合法性检查并保存到服务器
	 */
	class FileUploader 
	{
		/** 文件的保存路径 */
		private $mFilePath;
		
		/** vat int 文件的最大合法字节数 */
		private $mMaxSize;
		
		/** 新的文件名 */
		private $mNewFileName;
		//private $mFile;
		
		/** 临时文件名 */
		private $mTempName;
		
		/** 文件保存后的完整命名 */
		private $mFullFileName;
		
		public function __construct($file, $newFileName, $filePath="")
		{
			$this->mTempName = $file["tmp_name"];
			$this->mFilePath = $filePath;
			$this->mNewFileName = $newFileName;
		}
		
		public function upload()
		{
			/** 文件上传后的完整文件名 */
			$fullFileName = $this->mFilePath.$this->mNewFileName;
			
			if ( move_uploaded_file($this->mTempName, $fullFileName) )
			{
				$this->mFullFileName = $fullFileName;
				return TRUE;
			}
			else
				return FALSE;
		}
		
		public function getPropertyValue($propertyName)
		{
			return $this->$propertyName;
		}
	}
?>