<?php
//关于筛选的逻辑代码
  require_once 'tools/doSql.php';

  $pageIndex = $_GET['pageIndex'];
  $pageSize = $_GET['pageSize'];
  $categories = $_GET['categories'];
  $status = $_GET['status'];
  //计算出起始索引
  $sta = ($pageIndex-1)*$pageSize;
  $sql = "select p.id,p.title,u.nickname,c.name,p.created,p.status from 
            posts p inner join users u
            on p.user_id = u.id
            inner join categories c
            on p.category_id = c.id
            where p.status != 'trashed'";
            //判断筛选
        if($categories!='所有分类'):
          $sql.="and c.name='$categories'";
        endif;
        if($status!='所有状态'):
          $sql.="and p.status='$status'";
        endif;

  $sql.="order by p.created desc ";
  $sql1 = $sql;
  $sql.="limit $sta,$pageSize";

  $data = my_select($sql);

  $count = count(my_select($sql1));
  $totalPage = ceil($count/$pageSize);

  $arr = array(
    "data"=>$data,
    "totalPage"=>$totalPage
  );

  echo json_encode($arr);

