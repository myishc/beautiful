<?php

    require_once 'tools/doSql.php';

    $id = $_POST['id'];

    $sql = "select *from posts where id = $id";

    $data = my_select($sql)[0];

    $likes = $data['likes'];

    $likes++;

    $sql= "update posts set likes='$likes' where id = $id";

    $res = my_zsg($sql);

    if($res){
        echo "$likes";
    }else{
        echo 'fail';
    }
