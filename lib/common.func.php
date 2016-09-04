<?php
header("charset=utf-8");
require_once 'PDO.Class.php';
/**
 * 输出一句话并后退
 */
function alertbak($text){
echo "<script>alert('{$text}');window.history.back();</script>";
}
/**
 * 输出一句话并跳转
 */
function alertloc($str,$skip){
echo "<script>alert('$str');window.location.replace('{$skip}');</script>";
}
/**
 * 判断是否登录
 */
function sesem($str,$skip) {
	if (@$_SESSION['adminID']==""&&@$_COOKIE['adminId']==""){
		alertloc($str,$skip);
	}
}
/**
 * 退出操作，清空session会话，cookie会话，并跳转到后台登录页
 */
function logout(){
	$_SESSION=array();
	if (isset($_COOKIE[session_name()])){
		setcookie(session_name(),"",time()-1);
	}
	if (isset($_COOKIE['adminId'])){
		setcookie("adminId","",time()-1);
		
	}
	if (isset($_COOKIE['adminName'])){
		setcookie("adminName","",time()-1);
	}
	session_destroy();
	header("location:login.php");
}
