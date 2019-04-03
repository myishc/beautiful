<?php

    //关于查询个人中心的数据逻辑代码
    session_start();
    $userId = $_SESSION['userInfo']['id'];

    require_once './tools/doSql.php';
    $sql = "select *from users where id=$userId";

    $arr = my_select($sql);

    echo json_encode($arr[0]);

