<?php
    //关于删除和批量删除的逻辑代码
    $id = $_POST['id'];

    $sql = "delete from categories where id in ($id)";

    require_once './tools/doSql.php';

    $res = my_zsg($sql);

    if($res){
        echo '{ "code":100, "msg":"ok" }';
    }else{ 
        echo '{ "code":101, "msg":"fail" }';
    }
    