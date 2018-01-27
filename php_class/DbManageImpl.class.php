<?php
/**
 *
 * �����Ͷ���IDBManage��ʵ����DBManageImpl
 *
 * �������ڣ�2017.08.11
 * �޸����ڣ�2017.11.30
*/


	$current_dir = dirname(__FILE__);
	require_once("{$current_dir}/../interface/IDbManage.interface.php");
	require_once("SysConf.inc");


	/**
	 * IDbManage��ʵ����
	 * �����ݿ���й����������ݵ���ɾ�Ĳ�Ȳ���
	 *
	 * @method __get(string $property_name)
	 * @method __construct()
	 * @method __destruct()
	 * @method boolean executeSql(string $sql)	ִ����ɾ�ĵ�sql���
	 * @method array query(string $sql)			ִ�в�ѯ��sql���
	 *
	 * @property string $mCharSet		�������ݿ����ӵ��ַ���
	 * @property string $mDbConn		���ݿ����ӱ�ʶ
	 * @property string $mDbName		Ҫ���ӵ����ݿ���
	 * @property int    $mError			�ϴβ����Ĵ����룬ֵΪ0��ʾִ�гɹ�
	 * @property string $mHost			Ŀ�����ݿ����ڵ���������
	 * @property string $mPassword		����ʹ�õ��û�����
	 * @property string $mPort			����ʹ�õĶ˿ں�
	 * @property string $mUserName		�û���
	 */
	class DbManageImpl implements IDbManage
	{
		
		/** var string ���ݿ��ַ��� */
		private $mCharSet;
		
		/** var int ���ݿ����ӱ�ʶ */
		private $mDbConn;
		
		/** var string Ҫʹ�õ����ݿ��� */
		private $mDbName;
		
		/** var string ���ݿ��������� */
		private $mHost;
		
		/** var string �������ݿ�ʹ�õ��û����� */
		private $mPassword;
		
		/** var string �������ݿ�ʹ�õĶ˿ں� */
		private $mPort;
		
		/** var string �������ݿ�ʹ�õ��û��� */
		private $mUserName;	
		
		/** ִ��sql���ʱ����ʱ�Ĵ�����Ϣ */
		public $mErrno;
		
		/** ������ */
		public $mError;


		function _get($property_name)
		{
			return $this->property_name;
		}


		public function __construct()
		{
			
			/**
			 * ��ʼ������
			 */
			$this->mHost=SysConf::$DBHOST;
			$this->mPort=SysConf::$DBPORT;
			$this->mUserName=SysConf::$DBUSER;
			$this->mPassword=SysConf::$DBPWD;
			$this->mDbName=SysConf::$DBNAME;
			$this->mCharSet="utf-8";//SysConf::$DBCHARSET;
			
			try //���Դ�����MySql������
			{
				$this->mDbConn=mysqli_connect($this->mHost,$this->mUserName,
					$this->mPassword,$this->mDbName,$this->mPort);
			} 
			catch(Exception $e) {
				echo "";
			}
		
			if (!$this->mDbConn) //�������ɹ����׳��쳣
			{
				throw new Exception("�޷��������󣺴������ݿ�����ʧ�ܡ���".mysqli_connect_error().")");
			}
				
			mysqli_set_charset($this->mDbConn,$this->mCharSet); //���ñ���
		}


		public function __destruct()
		{
			//mysqli_close($this->mDbConn);
		}


		/**
		 * ִ��insert/update/delete���
		 *
		 * @param string $sql Ҫִ�е�sql���
		 *
		 * @return boolean sql���ִ�гɹ�����TRUE�������׳��쳣
		 */
		public function executeSql(string $sql)
		{
			$is_succeed=mysqli_query($this->mDbConn, $sql);
			
			if (!$is_succeed) //�ж�ִ�н�������δ�ɹ��׳��쳣
				throw new Exception(mysqli_error($this->mDbConn));	

			return TRUE;
		}


		/**
		 * ִ��select���
		 *
		 * @param string $sql Ҫִ�е�sql���
		 *
		 * @return array ��ѯ�ɹ����ض������飬ÿ��Ԫ�ض��������ݿ����һ�м�¼���ɵĶ���
		 * 				  ��ѯʧ�ܷ���FALSE				
		 */
		public function query(string $sql)
		{
			$qry_result=mysqli_query($this->mDbConn,$sql);
			if (!$qry_result) //��ѯʧ���׳��쳣
				throw new Exception (mysqli_error($this->mDbConn));

			/**
			 * ��ѯ�ɹ�������ѯ�����ÿһ����Ϊ����Ž�����
			 * ���ض�������
			 */
			$result_array=array(); //���飬�����ѯ���
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