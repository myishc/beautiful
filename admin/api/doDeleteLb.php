<?php
    //关于删除,批量删除轮播图数据的逻辑代码
    $id =$_GET['id'];

    require_once './tools/doSql.php';

    $sql = "delete from sliders where Id in ($id)";

    $res = my_zsg($sql);

    if($res){
        echo '{ "code":100, "msg":"ok" }';
    }else{ 
        echo '{ "code":101, "msg":"fail" }';
    }