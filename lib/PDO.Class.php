<?php
require_once '../configs/config.php';
header ( 'content-type:text/html;charset=utf8' );
class PdoMySql {
	public static $config = array (); //存贮配置信息
	public static $link = NULL; // PDO连接符
	public static $pconnect = FALSE; // 是否开启长链接默认不开启
	public static $connected = false;
	public static $dbVersion = null;
	public function __construct($dbConfig = '') {
		if (! class_exists ( "PDO" )) {
			self::throw_exception ( 'pdo未开启' );
		}
		if (! is_array ( $dbConfig )) {
			$dbConfig = array (
					'hostname' => DB_HOST,
					'username' => DB_USER,
					'password' => DB_PWD,
					'database' => DB_NAME,
					'hostport' => DB_PORT,
					'dbms' => DB_TYPE,
					'dsn' => DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME 
			);
		}
		if (empty ( $dbConfig ['hostname'] ))
			self::throw_exception ( '未定义数据库配置' );
		self::$config = $dbConfig;
		if (empty ( self::$config ['params'] ))
			self::$config ['params'] = array ();
		if (! isset ( self::$link )) {
			$configs = self::$config;
			if (self::$pconnect) {
				// 是否开启长连接
				$configs ['params'] [constant ( "PDO::ATTR_PERSISTENT" )] = true;
			}
			try {
				self::$link = new PDO ( $configs ['dsn'], $configs ['username'], $configs ['password'], $configs ['params'] );
			} catch ( PDOException $e ) {
				self::throw_exception ( $e->getMessage () );
			}
			if (! self::$link) {
				self::throw_exception ( '数据库连接失败' );
				return false;
			}
			self::$link->exec ( 'SET NAMES ' . DB_CHARSET );
			self::$dbVersion = self::$link->getAttribute ( constant ( "PDO::ATTR_SERVER_VERSION" ) );
			self::$connected = true;
			unset ( $configs );
		}
	}
	/**
	 *
	 * @param unknown $errmsg
	 *        	错误处理
	 */
	public static function throw_exception($errmsg) {
		echo $errmsg;
	}
	/**
	 * 完成记录插入 ，并返回受影响的id
	 * @param unknown $table
	 * @param array $array
	 */
	public static function insert($table,$array){
		$keys=join(",", array_keys($array));
		$values="'".join("','", array_values($array))."'";
		$sql="insert {$table}($keys) values({$values})";
		self::$link->exec($sql);
		return self::$link->lastInsertId();
	}
	/**
	 * 更新表操作 返回受影响的行数
	 * @param string $table
	 * @param array $array
	 * @param string $where
	 */
	public static function update($table,$array,$where=null){
		$str=null;
		foreach ($array as $key=>$val){
			if ($str==null){
				$sep="";
			}else {
				$sep=",";
			}
			$str.=$sep.$key."='".$val."'";
		
		}
		$sql="update {$table} set {$str}".($where==null?null:"where ".$where);
		$count=self::$link->exec($sql);
		return $count;
	}
	/**
	 * 删除记录
	 * @param unknown $table
	 * @param unknown $where
	 * @return unknown
	 */
	public static function delete($table,$where=null){
		$where=$where==null?null:"where ".$where;
		$sql="delete from {$table} {$where}";
		$count=self::$link->exec($sql);
		 return $count;
	}
	public static function findreg($table,$username,$password ){
		$sql="select*from {$table} where username='{$username}' and password='{$password}'";
		$stmt=self::$link->query($sql);
		$con=$stmt->fetchAll();
		return $con;

	}
    public static function fetchAll($sql){
        $stmt=self::$link->query($sql);
        $con =$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $con;
    }
}