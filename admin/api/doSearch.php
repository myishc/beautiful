<?php


    require_once 'tools/doSql.php';
    $text = $_GET['text'];
    $sql = "select *form categories where name='%$text%' order by id desc";

    $arr = my_select($sql);
   

    // echo json_encode($arr);




