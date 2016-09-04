<?php
require_once '../lib/PDO.Class.php';
@$id=$_REQUEST['id'];
$sql="select id,username,email from imooc_admin where id='{$id}'";
$pdo=new PdoMySql();
$con=$pdo->fetchAll($sql);
@$cons=$con[0];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<center>
<form action="doAdminAction.php?act=updateAdmin&id=<?php echo $id; ?>" method="post">
    <h3>添加管理员</h3>
    <table width="70%" border="1" cellpadding="5" cellspacing="0" bgcolor="#cccccc">
        <tr>
            <td align="right">管理员名称</td>
            <td><input type="text" name="username" placeholder="<?php echo $cons['username'];?>"/></td>
        </tr>
        <tr>
            <td align="right">管理员密码</td>
            <td><input type="password" name="password" /></td>
        </tr>
        <tr>
            <td align="right">管理员邮箱</td>
            <td><input type="text" name="email" placeholder="<?php echo $cons['email']?>"/></td>
        </tr>
        <tr>
            <td colspan="2" align="right"><input type="submit"  value="添加管理员"/></td>
        </tr>

    </table>
</form>
    </center>
</body>
</html>