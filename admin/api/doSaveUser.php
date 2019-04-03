<?php
    //关于保存个人中心数据的逻辑方法

    require_once 'tools/doSql.php';
    session_start();

    $userId = $_SESSION['userInfo']['id'];
    $nickname= $_POST['nickname'];
    $slug= $_POST['slug'];
    $bio= $_POST['bio'];
    
    $sql = "update users set nickname='$nickname',slug='$slug',bio='$bio'";

    if(!empty($_FILES['avatar']['name'])){
        $avatar= $_FILES['avatar'];
        $nameO = $avatar['name'];
        $nameN = iconv('utf-8','gbk',$nameO);
        $pathO = $avatar['tmp_name'];
        $pathN = "../../uploads/$nameN";
        move_uploaded_file($pathO,$pathN);
        $pathN= "/uploads/$nameO";

        $sql.= ",avatar='$pathN'";
    }
    
    $sql .= "where id= $userId";

    $res = my_zsg($sql);

    if($res){

        $_SESSION['userInfo']['slug'] =$slug;
        $_SESSION['userInfo']['nickname'] =$nickname;
        $_SESSION['userInfo']['bio'] =$bio;
        
        if(!empty($_FILES['avatar']['name'])){
            $_SESSION['userInfo']['avatar']=$pathN;
        }
        
        echo '{ "code":100, "msg":"ok" }';

    }else{

        
        echo '{ "code":101, "msg":"fail" }';
    }
    
    