<?php
header ( "charset=utf-8" );
require_once '../lib/PDO.Class.php';
require_once '../lib/common.func.php';
@$username = $_POST ['username']; // 用户名
@$password =md5($_POST ['password']); // 密码
@$autoFlag = $_POST ['autoFlag']; // 一周自动登陆
$table = "imooc_admin";
@$verify = strtolower ( $_POST ['verify'] ); // 验证码
session_start ();
@$imsession = strtolower ( $_SESSION ['autocode'] );
// 判断验证码是否输入正确
if ($imsession == $verify) {
	// 实例化pdo类
	$pdo = new PdoMySql ();
	
	// 调用查询函数
	$con = $pdo->findreg ( $table, $username, $password );
	// 判断用户名密码是否正确
	if (! empty ( $con )) {
		// 判断是否开启一周自动登陆
		if (! empty ( $autoFlag )) {
			setcookie ( "adminId", $con [0] ['id'], time () + 7 * 24 * 3600 );
			setcookie ( "adminName", $con [0] ['username'], time () + 7 * 24 * 3600 );
		}
		$_SESSION ['adminName'] = $con [0] ['username'];
		$_SESSION ['adminID'] = $con [0] ['id'];
		// 登录成功跳转到首页
		alertloc ( '登录成功', 'index.php' );
	} else {
		// 用户名密码错误 返回登录页
		alertbak ( "用户名或密码错误" );
	}
} else {
	// 验证码错误返回登录页
	alertbak ( "验证码错误" );
}
