<?php

    $oldPass = $_POST['oldPass'];
    session_start();
    if($oldPass!=$_SESSION['userInfo']['password']){
        echo '{"code":102 , "msg": "密码错误"}';
        return;
    }
    require_once "tools/doSql.php";
    $userId = $_SESSION['userInfo']['id'];
    $newPass = $_POST['newPass'];

    $sql = "update users set password='$newPass' where id= $userId";
    $res = my_zsg($sql);

    if($res){
        echo '{ "code":100, "msg":"修改成功" }';
    }else{ 
        echo '{ "code":101, "msg":"修改失败" }';
    }
    

