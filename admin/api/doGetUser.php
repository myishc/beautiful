<?php
    //关于加载用户列表的逻辑
    require_once 'tools/doSql.php';

    $sql = "select *from users order by id desc";

    $data = my_select($sql);

    echo json_encode($data);
