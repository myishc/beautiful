<?php
    //关于删除用户列表的逻辑
    require_once './tools/doSql.php';

    $id = $_POST['id'];

    $sql = "delete from users where id in ($id)";

    $res = my_zsg($sql);

    if($res){
        echo '{ "code":100, "msg":"ok" }';
    }else{ 
        echo '{ "code":101, "msg":"fail" }';
    }