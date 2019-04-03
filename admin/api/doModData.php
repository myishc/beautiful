<?php
    //关于编辑文章保存的逻辑代码
    require_once './tools/doSql.php';
    $title = $_POST['title'];
    $content = $_POST['content'];
    $slug = $_POST['slug'];
    $category = $_POST['category'];
    $created = $_POST['created'];
    $status = $_POST['status'];
    $id = $_POST['id'];
    
    $sql = "update posts set title='$title',content='$content',
    slug='$slug', category_id='$category',created='$created',
    status ='$status'";
    
    //判断有没有修改图片图片文件
    if(!empty($_FILES['feature']['name'])){
        $feature=$_FILES['feature'];
        $iconName = $feature['name'];
        $icontmp = $feature['tmp_name'];
        $iconNew = iconv('utf-8','gbk',$iconName);
        $iconPath = "../../uploads/$iconNew";
        move_uploaded_file($icontmp,$iconPath);
        $iconPath="../uploads/$iconName";
        $sql.=",feature='$iconPath'";      
    }

    $sql.="where id=$id";
   
    $res = my_zsg($sql);
    
    if($res){
        echo '{ "code":100, "msg":"ok" }';
    }else{
        echo '{ "code":101, "msg":"fail" }';
    }