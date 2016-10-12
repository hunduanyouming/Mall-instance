 <?php
 require_once '../lib/PDO.Class.php';

 function getAdminByPage($pagesize=2)
 {
 	$pdo=new PdoMySql();
	 $sql = "select id,username,email from imooc_admin";
	 $con =$pdo->fetchAll($sql);
	 global $totalpage;
	 $totalRows = count($con);
	 $totalpage = ceil($totalRows / $pagesize);
	 global $page;
	 @$page= $_REQUEST['page']?(int)$_REQUEST['page']:1;
	 if (empty($page) || !is_numeric($page)) {
		 $page = 1;
	 }
	 if ($page >= $totalpage) $page = $totalpage;

	 $offset = ($page - 1) * $pagesize;
	 $sql = "select * from imooc_admin limit {$offset},{$pagesize}";
	 $rows = $pdo->fetchAll($sql);
	 return $rows;
 }
function showpage($page,$totalpage,$sep='&nbsp;'){
//得到当前脚本的路径
$url=$_SERVER['PHP_SELF'];
//首页
$index=($page==1)?"[首页]":"<a href='{$url}?page=1'>[首页]</a>";
//尾页
$last=($page==$totalpage)?"[尾页]":"<a href='{$url}?page={$totalpage}'>[尾页]</a>";
//上一页
$prev=($page==1)?"[上一页]":"<a href='$url?page=".($page-1)."'>[上一页]</a>";
//下一页
$next=($page==$totalpage)?"[下一页]":"<a href='$url?page=".($page+1)."'>[下一页]</a>";
$text="第{$page}页/共{$totalpage}页";

for ($i=1;$i<=$totalpage;$i++){
	if ($page==$i){
		@$p.="<a>[{$i}]</a>";
	}else {
		@$p.="<a href='{$url}?page={$i}'>[{$i}]</a>";
	}
}
$str=$index.$sep.$prev.$sep.$p.$sep.$next.$sep.$last.$sep.$sep.$text;
return $str;
}

?>
