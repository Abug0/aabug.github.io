<?php
/**
 *
 * 声明和定义IDBManage的实现类DBManageImpl
 *
 * 创建日期：2017.08.11
 * 修改日期：2017.11.30
*/


	$current_dir = dirname(__FILE__);
	require_once("{$current_dir}/../interface/IDbManage.interface.php");
	require_once("SysConf.inc");


	/**
	 * IDbManage的实现类
	 * 对数据库进行管理，进行数据的增删改查等操作
	 *
	 * @method __get(string $property_name)
	 * @method __construct()
	 * @method __destruct()
	 * @method boolean executeSql(string $sql)	执行增删改的sql语句
	 * @method array query(string $sql)			执行查询的sql语句
	 *
	 * @property string $mCharSet		设置数据库连接的字符集
	 * @property string $mDbConn		数据库连接标识
	 * @property string $mDbName		要连接的数据库名
	 * @property int    $mError			上次操作的错误码，值为0表示执行成功
	 * @property string $mHost			目标数据库所在的物理主机
	 * @property string $mPassword		连接使用的用户密码
	 * @property string $mPort			连接使用的端口号
	 * @property string $mUserName		用户名
	 */
	class DbManageImpl implements IDbManage
	{
		
		/** var string 数据库字符集 */
		private $mCharSet;
		
		/** var int 数据库连接标识 */
		private $mDbConn;
		
		/** var string 要使用的数据库名 */
		private $mDbName;
		
		/** var string 数据库所在主机 */
		private $mHost;
		
		/** var string 连接数据库使用的用户密码 */
		private $mPassword;
		
		/** var string 连接数据库使用的端口号 */
		private $mPort;
		
		/** var string 连接数据库使用的用户名 */
		private $mUserName;	
		
		/** 执行sql语句时出错时的错误信息 */
		public $mErrno;
		
		/** 错误码 */
		public $mError;


		function _get($property_name)
		{
			return $this->property_name;
		}


		public function __construct()
		{
			
			/**
			 * 初始化参数
			 */
			$this->mHost=SysConf::$DBHOST;
			$this->mPort=SysConf::$DBPORT;
			$this->mUserName=SysConf::$DBUSER;
			$this->mPassword=SysConf::$DBPWD;
			$this->mDbName=SysConf::$DBNAME;
			$this->mCharSet="utf-8";//SysConf::$DBCHARSET;
			
			try //尝试创建与MySql的连接
			{
				$this->mDbConn=mysqli_connect($this->mHost,$this->mUserName,
					$this->mPassword,$this->mDbName,$this->mPort);
			} 
			catch(Exception $e) {
				echo "";
			}
		
			if (!$this->mDbConn) //创建不成功，抛出异常
			{
				throw new Exception("无法创建对象：创建数据库连接失败。（".mysqli_connect_error().")");
			}
				
			mysqli_set_charset($this->mDbConn,$this->mCharSet); //设置编码
		}


		public function __destruct()
		{
			//mysqli_close($this->mDbConn);
		}


		/**
		 * 执行insert/update/delete语句
		 *
		 * @param string $sql 要执行的sql语句
		 *
		 * @return boolean sql语句执行成功返回TRUE，出错抛出异常
		 */
		public function executeSql(string $sql)
		{
			$is_succeed=mysqli_query($this->mDbConn, $sql);
			
			if (!$is_succeed) //判断执行结果，如果未成功抛出异常
				throw new Exception(mysqli_error($this->mDbConn));	

			return TRUE;
		}


		/**
		 * 执行select语句
		 *
		 * @param string $sql 要执行的sql语句
		 *
		 * @return array 查询成功返回对象数组，每个元素都是由数据库里的一行记录构成的对象
		 * 				  查询失败返回FALSE				
		 */
		public function query(string $sql)
		{
			$qry_result=mysqli_query($this->mDbConn,$sql);
			if (!$qry_result) //查询失败抛出异常
				throw new Exception (mysqli_error($this->mDbConn));

			/**
			 * 查询成功，将查询结果的每一行作为对象放进数组
			 * 返回对象数组
			 */
			$result_array=array(); //数组，保存查询结果
			$i=0;
			while ($result_current_row=mysqli_fetch_object($qry_result))
			{
				$result_array[$i]=$result_current_row;
				$i++;
			}

			return $result_array;
		}
	
	}
?>