<?php
    //关于新增分类和修改分类的逻辑代码
    $name = $_POST['name'];
    $slug = $_POST['slug'];

    if(empty($_POST['id'])){
        $sql = "insert into categories(name,slug) values('$name','$slug')";
    }else{
        $id = $_POST['id'];
        $sql = "update categories set name ='$name',slug= '$slug' where id=$id";
    }
    

    require_once 'tools/doSql.php';

    $res= my_zsg($sql);

    if($res){
        echo '{ "code":100, "msg":"ok" }';
    }else{ 
        echo '{ "code":101, "msg":"fail" }';
    }
    