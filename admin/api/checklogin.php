<?php 

    //判断有没有session
    session_start();

    //判断有没有session
    if(isset( $_SESSION['userInfo'] )){

          //有登录
          echo '{ "code":100, "msg":"ok" }';

    }else{
    
            //账号或密码错误
            echo '{ "code":101, "msg":"fail" }';
    }