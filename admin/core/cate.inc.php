<?php
header ( 'content-type:text/html;charset=UTF-8' );
/**
 * Created by PhpStorm.
 * User: xhk
 * Date: 2016/10/10
 * Time: 17:43
 */

/*
 * t添加分类信息
 * */
function addCate($pdo)
{
    $add=$_POST;
    if ($pdo->insert("imooc_cate", $add)) {
        $mes = "分类添加成功！<br/> <a href='addCate.php'>继续添加</a>|<a href='listCate.php'>查看分类</a>";
    } else {
        $mes = "分类添加失败！<br/> <a href='addCate.php'>重新添加</a>|<a href='listCate.php'>查看分类</a>";
    }
    return $mes;
}