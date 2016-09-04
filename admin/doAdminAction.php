<?php
//退出操作处理
require_once '../lib/common.func.php';
require_once '../lib/PDO.Class.php';
@$act = $_REQUEST ['act'];
$type="imooc_admin";
session_start ();
$pdo=new  PdoMySql();
if ($act == "logout") {
	logout ();
}elseif($act=="addAdmin"){
    //添加处理
 $add=$_POST;
    $add['password']=md5($_POST['password']);
    $mes=$pdo->insert($type,$add);
    if (!empty($mes)){
        echo "添加成功</br>";
        echo "<a href='addAdmin.php'>继续添加</a><span>|</span><a href='listAdmin.php'>查看管理员</a>";
    }else{
        alertbak("添加失败");
    }
}elseif($act=="updateAdmin"){
 @$add=$_POST;
 @$id=$_REQUEST['id'];
 switch ($add) {
 	case @$add['username']=="":
 	alertbak("用户名不许为空");
 	break;
 	case @$add['password']=="":
 		alertbak("密码尚未填写");
 		break;
 	case @$add['email']=="":
 		alertbak("邮箱不润许为空");
 		break;
 	default:
 		@$add['password']=md5($_POST['password']);
 		$res=$pdo->update($type,$add,"id={$id}");
 		if ($res){
 			alertloc("修改成功","listAdmin.php?act=list");
 		}else {
 			alertbak("修改失败!请重新修改");
 		}
 	break;
 }
}elseif ($act=="delete"){
	$id=$_REQUEST['id'];
	$res=$pdo->delete($type,"id={$id}");
	if ($res){
		alertloc("删除失败","listAdmin.php?act=list");
	}else {
		alertbak("删除失败");
	}
}