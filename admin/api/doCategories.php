<?php
  //查询分类的接口
  require_once './tools/doSql.php';

  $sql = "select *from categories";

  $arr = my_select($sql);

  echo json_encode($arr);