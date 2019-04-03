<?php
  //  导入工具
  require_once "admin/api/tools/doSql.php";

  //文章阅读
  $id = $_GET['id'];
  $sql = "select c.name,p.title,p.feature,p.content,u.nickname,p.created,p.views from posts p inner join
                       categories c on p.category_id = c.id
                       inner join users u on p.user_id = u.id
                       where p.id =$id";
  $postsData = my_select($sql)[0];

  //评论数
  $sql = "select *from comments where post_id=$id and status='approved'";
  $plData =count(my_select($sql));

    //阅读数
  $views = $postsData['views']+1;
  $sql = "update posts set views='$views' where id =$id";
  my_zsg($sql);
  
  
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <div class="topnav">
      <ul>
        <?php
         $sql = "select *from categories";
         $cate = my_select($sql);
         $arr = array('fa-glass','fa-phone','fa-fire','fa-gift','fa-phone','fa-fire');
         foreach($cate as $key => $value):
       ?>
         <li>
           <a href="list.php?id=<?php echo $value['id']?>&name=<?php echo $value['name']?>"><i class="fa <?php echo $arr[$key]?>"></i><?php echo $value['name']?></a>
         </li>
       <?php endforeach?>
      </ul>
    </div>
    <div class="header">
      <h1 class="logo"><a href="index.php"><img src="assets/img/logo.png" alt=""></a></h1>
      <ul class="nav">
      <?php 
        foreach($cate as $key => $value):
      ?>  
        <li>
          <a href="list.php?id=<?php echo $value['id']?>&name=<?php echo $value['name']?>"><i class="fa <?php echo $arr[$key]?>"></i><?php echo $value['name']?></a>
        </li>
        <?php endforeach?>
      </ul>
      <div class="search">
        <form>
          <input type="text" class="keys" placeholder="输入关键字">
          <input type="submit" class="btn" value="搜索">
        </form>
      </div>
      <div class="slink">
        <a href="javascript:;">链接01</a> | <a href="javascript:;">链接02</a>
      </div>
    </div>
    <div class="aside">
      <div class="widgets">
        <h4>搜索</h4>
        <div class="body search">
          <form>
            <input type="text" class="keys" placeholder="输入关键字">
            <input type="submit" class="btn" value="搜索">
          </form>
        </div>
      </div>
      <div class="widgets">
        <h4>随机推荐</h4>
        <ul class="body random">
        <?php 
             $sql = "select id,title,feature,views from posts order by rand() limit 5";

             $randData = my_select($sql);
           
          ?>
          <?php foreach($randData as $value ):?>
          <li>
            <a href="./detail.php?id=<?php echo $value['id']?>">
              <p class="title"><?php echo $value['title']?></p>
              <p class="reading">阅读(<?php echo $value['views']?>)</p>
              <div class="pic">
                <img src="<?php echo $value['feature']?>" alt="">
              </div>
            </a>
          </li>
          <?php endforeach ;?>
        </ul>
      </div>
      <div class="widgets">
        <h4>最新评论</h4>
        <ul class="body discuz">
        <?php 
          //评论模块
          $sql = "select c.id,c.content,c.created,u.avatar,u.nickname from comments c
                  inner join users u on c.email=u.email
                  where  c.status='approved' order by id desc limit 5";
          $comment = my_select($sql);
          foreach($comment as $value):
        ?>
          <li style='max-height: 100px;'>
            <a href="javascript:;">
              <div class="avatar">
                <img src="<?php echo $value['avatar']?>" alt="">
              </div>
              <div class="txt">
                <p>
                  <span><?php echo $value['nickname']?></span><?php echo $value['created']?>说:
                </p>
                <p><?php echo $value['content']?></p>
              </div>
            </a>
          </li>
        <?php endforeach?>
        </ul>
      </div>
    </div>
    <div class="content">
      <div class="article">
        <div class="breadcrumb">
          <dl>
            <dt>当前位置：</dt>
            <dd><a href="javascript:;"><?php echo $postsData['name']?></a></dd>
            <dd><?php echo $postsData['title']?></dd>
          </dl>
        </div>
        <h2 class="title">
          <a href="javascript:;"><?php echo $postsData['title']?></a>
        </h2>
        <div class="meta">
          <div><h3><?php echo $postsData['content']?></h3></div>
          <img src="<?php echo $postsData['feature']?>" alt="" style = "width:600px;height:300px; margin:50px;">
          <span><?php echo $postsData['nickname']?> 发布于 <?php echo $postsData['created']?></span>
          <span>分类: <a href="javascript:;"><?php echo $postsData['name']?></a></span>
          <span>阅读: (<?php echo $views?>)</span>
          <span>评论: (<?php echo $plData?>)</span>
        </div>
      </div>
      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul>
        <?php
          //热门推荐
          $sql  = "select id,title,feature,views,likes from posts where status='published' order by views desc limit 5";
          $hotData = my_select($sql);
        ?>
          <?php for($i=0 ; $i<4 ; $i++):?>
          <li>
            <a href="./detail.php?id=<?php echo $hotData[$i]['id']?>">
              <img src="<?php echo $hotData[$i]['feature']?>" alt="">
              <span><?php echo $hotData[$i]['title']?></span>
            </a>
          </li>
          <?php endfor?>
        </ul>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
