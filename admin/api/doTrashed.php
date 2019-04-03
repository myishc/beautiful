<?php
//属于删除文章的逻辑代码
require_once "tools/doSql.php";

$id =$_GET['id'];
$link = mysqli_connect('127.0.0.1','root','root','baixiu');
$sql= "update posts set status='trashed' where id in($id)";
$res = mysqli_query($link,$sql);
mysqli_close($link);

if($res){
    echo '{ "code":100, "msg":"ok" }';
}else{
    echo '{ "code":101, "msg":"fail" }';
}


