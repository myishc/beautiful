<?php
    //关于新增用户,修改用户的逻辑代码

    
    $slug = $_POST['slug'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $status = 'activated';
    $avatar = $_FILES['avatar'];
    $nickname = $_POST['nickname'];

    $name = $avatar['name'];
    $tmp = $avatar['tmp_name'];
    $icon = iconv('utf-8','gbk',$name);
    $path = "../../uploads/$icon";
    move_uploaded_file($tmp,$path);
    $path = "uploads/$name";

    if($_POST['btn']=='xg'){
        $sql = "update users set 
                slug='$slug',password='$password',
                status='$status',nickname='$nickname'";
        if(!empty($avatar['name'])){
            $sql.= ",avatar='$path'";
        }     
        $sql.="where email ='$email'";
    }else{
        $sql = "insert into users(slug,email,password,status,avatar,nickname) 
                    values('$slug','$email','$password','$status','$path','$nickname')";
    }

    

    
    
    require_once "./tools/doSql.php";

    $res = my_zsg($sql);

    if($res){
        echo '{ "code":100, "msg":"ok" }';
    }else{ 
        echo '{ "code":101, "msg":"fail" }';
    }

