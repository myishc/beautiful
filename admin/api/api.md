## 判断登录账号和密码是否正确的接口
type: post
url: api/doLogin.php
data:
    email：邮箱
    password:密码

响应体：
    JSON

    { "code":100, "msg":"ok" }
    或者
    { "code":101, "msg":"fail" }


## 判断有没有登录的接口
type:get
url: api/checkLogin.php
data:没有
响应体：
    JSON

    { "code":100, "msg":"ok" }
    或者
    { "code":101, "msg":"fail" }


## 获取当前登录的用户信息接口
type:get
url:api/getUserInfo.php
data:没有
响应体：
    JSON
    { "id":1,"slug":"admin",...... }


## 获取网站统计数据的接口
type:get
url:api/getWebInfo.php
data:没有
响应体：
    JSON
    {wenzhang:700  caogao:210  fenlei:4  pinglun:400  daishenhe:83}

## 获取分页评论数据的接口
type:get
url:api/getComments.php
data:
    pageIndex: 页码
    pageSize: 页容量

响应体：
    JSON
   {
        data:[
            {},
            {},
            {}
        ],
        totalPages:43
    }


##获取分类的接口


type: get 
url: api/doCategories.php
data:无
响应体:
    JSON

    [{}{}{}]




## 修改评论状态的接口

type:post
url:api/editComments.php
data:
    status：告诉我要修改成什么状态
    ids： 告诉我要修改成哪些数据
            如果单行值传一个id，如果多行，就传多个id
            ids的取值要么是 “3" 这样的，要么就是 "3,9,10,11"这样的

响应体：
    JSON

    { "code":100, "msg":"ok" }
    或者
    { "code":101, "msg":"fail" }

## 获取文章数据的接口
type:get
url:api/doGetArt.php
data:
    pageIndex: 页码
    pageSize: 页容量
    categories:分类
    status:状态

响应体：
    JSON
   {
        data:[
            {},
            {},
            {}
        ],
        totalPages:43
    }

##关于删除文章的接口
type:get
url:api/doTrashed.php
data: 
    id: 需要删除的文章id
    (1,2)多个之间用,号隔开
响应体:
    Json
    { "code":100, "msg":"ok" }
    或者
    { "code":101, "msg":"fail" }


##关于新增保存文章的接口
type:post
url:api/doSaveData.php
data:
    title:标题
    content:内容
    slug:别名
    feature:图片
    category:分类
    created:时间
    status:状态
响应体:
    JSON
    { "code":100, "msg":"ok" }
    或者
    { "code":101, "msg":"fail" };


##关于编辑文章获取数据的接口
type:get
url: api/daModPosts.php
data:
    id:需要编辑的文章id
响应体:
    JSON
    { }
    

##关于编辑文章保存的接口
type:post
url:api/doModData.php
data:
    title:标题
    content:内容
    slug:别名
    feature:图片
    category:分类
    created:时间
    status:状态
    id:传入修改的文章id
响应体:
    JSON
    { "code":100, "msg":"ok" }
    或者
    { "code":101, "msg":"fail" };


##加载个人中心的页面数据接口

type: get
data: 无
url: api/doUserCentre.php

响应体:

    JSON
    {}

##保存个人中心数据接口
type:post
url: api/doSaveUser.php
data:
    nickname:昵称
    slug:别名
    avatar:头像
    bio:简介

响应体:

    JSON

    { "code":100, "msg":"ok" }
    或者
    { "code":101, "msg":"fail" };


##关于修改密码的接口
type:post
url: api/doModPass.php
data: 
    oldPass:旧密码
    newPass:新密码
响应体:   

    JSON
    { "code":100, "msg":"修改成功" }
    或者
    { "code":101, "msg":"修改失败" };

    { "code":102, "msg":"密码错误" };


##关于编辑分类和新增分类的接口
type:post
url: api/doAddCate.php
data:
    obj:{name:分类名,slug:别名}  新增
    obj:{name:分类名,slug:别名,id:需要修改的id}  编辑
响应体

    JSON
    { "code":100, "msg":"ok" }
    或者
    { "code":101, "msg":"fail" };


##关于删除和批量删除的接口
type:post
url : api/doDeleteCate.php
data :
    id:需要删除的id
        多个之间用逗号隔开

响应体:

    JSON
    { "code":100, "msg":"ok" }
    或者
    { "code":101, "msg":"fail" };


##获取轮播图数据的接口

type:get
url: api/doGetLb.php
data:无

响应体:

    JSON
    [{},{},{}]

##添加轮播图的接口

type:post
url: api/doAddLb.php
data:
    image: 图片
    text: 文本
    link : 地址

响应体:

 JSON
    { "code":100, "msg":"ok" }
    或者
    { "code":101, "msg":"fail" };

##关于删除轮播图的接口

type:get 
url: api/doDeleteLb.php
data:
    id:需要删除的数据id

响应体:

    JSON
    { "code":100, "msg":"ok" }
    或者
    { "code":101, "msg":"fail" };

##关于加载用户名列表的接口
type:get
url: api/doGetUser.php
data:无

响应体:

    [{},{}]

##关于删除用户列表的接口

type:post
url: api/doDeleteUser.php
data:
    id:需要删除的用户id

响应体:
    
    JSON
    { "code":100, "msg":"ok" }
    或者
    { "code":101, "msg":"fail" };

##关于新增/修改用户列表的接口

type:post
url: api/doAddUser.php
data:
    btn: '新增'/'修改'
    avatar: 头像
    slug: 别名
    email: 邮箱
    password: 密码
    status: 状态
    nickname:昵称

响应体:

    JSON
    { "code":100, "msg":"ok" }
    或者
    { "code":101, "msg":"fail" };


#点赞接口

type:post
url : 'admin/api/doZan.php'
data:
    id: 被点击的文章id

响应体:

    JSON
    { "code":100, "msg":"ok" }
    或者
    { "code":101, "msg":"fail" };

##