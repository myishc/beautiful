<?php
    //关于上传轮播图数据的逻辑代码
    $text = $_POST['text'];
    $link = $_POST['link'];
    $image = $_FILES['image'];

    //文件
    $name = $image['name'];
    $tmp = $image['tmp_name'];
    $newName = iconv('utf-8','gbk',$name);
    $path= "../../uploads/$newName";
    move_uploaded_file($tmp,$path);
    $path = "uploads/$name";
    require_once './tools/doSql.php';

    $sql = "insert into sliders(image,text,link) values('$path','$text','$link')";

    $res = my_zsg($sql);

    if($res){
        echo '{ "code":100, "msg":"ok" }';
    }else{ 
        echo '{ "code":101, "msg":"fail" }';
    }