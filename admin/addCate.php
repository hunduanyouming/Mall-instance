<?php
require_once '../lib/common.func.php';
session_start ();
sesem ( "请先登录", "login.php" );
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<center>
<form action="doAdminAction.php?act=addCate" method="post">
    <h3>添加分类</h3>
    <table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
        <tr>
            <td align="right">分类名称</td>
            <td><input type="text" name="cName" placeholder="请输入分类名称"/></td>
        </tr>
        <tr>
            <td colspan="2" align="right"><input type="submit"  value="添加分类"/></td>
        </tr>

    </table>
</form>
    </center>
</body>
</html>