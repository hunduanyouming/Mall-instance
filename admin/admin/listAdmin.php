<?php
require_once '../lib/common.func.php';
require_once '../lib/page.func.php';
session_start();
sesem ( "请先登录", "login.php" );
$pagesize=5;
$rows=getAdminByPage($pagesize);
if (empty($rows)){
    alertloc("未添加管理员，请先添加管理员","addAdmin.php");

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Insert title here</title>
    <link rel="stylesheet" href="styles/backstage.css">
</head>
<body>
<div class="details">
    <div class="details_operation clearfix">
        <div class="bui_select">
            <input type="button" value="添&nbsp;&nbsp;加" class="add"  onclick="addAdnin()">
        </div>

    </div>
    <!--表格-->
    <table class="table" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th width="15%">编号</th>
            <th width="25%">管理员名称</th>
            <th width="30%">管理员邮箱</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>

            <tr>
                <?php
                for ($i=0;$i<count($rows);$i++):?>
                <!--这里的id和for里面的c1 需要循环出来-->
                <td><input type="checkbox" id="c1" class="check" value=""><label for="c1" class="label"><?php echo $rows[$i]['id']?></label></td>
                <td><?php echo $rows[$i]['username']?></td>
                <td><?php echo $rows[$i]['email']?></td>
                <td align="center"><input type="button" value="修改" class="btn" onclick="updateAdmin(<?php echo $rows[$i]['id'];?>)"><input type="button" value="删除" class="btn" onclick="deladmin(<?php echo $rows[$i]['id'];?>)" ></td>
            </tr>
            <?php endfor;  ?>
            <tr>
                <td colspan="4" >    <?php

                   echo showpage(@$page,$totalpage);
                    ?></td>
            </tr>
        </tbody>
    </table>
</div>
<script type="text/javascript">
    function addAdnin() {
        window.location="addAdmin.php?act=add";
    }
    function updateAdmin(id){
        window.location="updateAdmin.php?id="+id;
    }
    function deladmin(id){
	   if (window.confirm("您确定要删除吗？")) {
		   window.location="doAdminAction.php?act=delete&id="+id;
	}else{
	alert("删除失败!");
		}
        }
</script>
</body>
</html>