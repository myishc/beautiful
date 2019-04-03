<?php
    //关于查询轮播图数据的逻辑代码

    require_once './tools/doSql.php';

    $sql= "select *from sliders order by Id desc";

    $data = my_select($sql);

    echo json_encode($data);