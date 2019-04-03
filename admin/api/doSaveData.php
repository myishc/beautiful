<?php
    //关于新增文章的逻辑代码
    require_once './tools/doSql.php';
    $title = $_POST['title'];
    $content = $_POST['content'];
    $slug = $_POST['slug'];
    $category = $_POST['category'];
    $created = $_POST['created'];
    $status = $_POST['status'];
    //图片文件
    $feature=$_FILES['feature'];
    $iconName = $feature['name'];
    $icontmp = $feature['tmp_name'];
    $iconNew = iconv('utf-8','gbk',$iconName);
    $iconPath = "../../uploads/$iconNew";
    move_uploaded_file($icontmp,$iconPath);
    $iconPath="uploads/$iconName";
    //开启
    session_start();
    $id = $_SESSION['userInfo']['id'];




    $sql = "insert into posts(title,content,slug,category_id,created,status,user_id,feature) 
                    values('$title','$content','$slug','$category','$created','$status','$id','$iconPath')";

    $res = my_zsg($sql);

    if($res):
        echo '{ "code":100, "msg":"ok" }';
    else:
        echo '{ "code":101, "msg":"fail" }';
    endif;
  
   