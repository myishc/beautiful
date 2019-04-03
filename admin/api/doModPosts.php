<?php
//关于编辑文章的逻辑代码
    require_once './tools/doSql.php';

    $id = $_GET['id'];

    $sql = "select *from posts where id=$id";

    $arr = my_select($sql);

    echo json_encode($arr[0]);
