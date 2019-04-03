<?php
  require_once 'admin/api/tools/doSql.php';
  $id = $_GET['id'];
  $name = $_GET['name'];

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
        //分类
          require_once 'admin/api/tools/doSql.php';
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
             <!-- 随机推荐 -->
             <?php 
             $sql = "select id,title,feature,views from posts order by rand() limit 5";

             $postsData = my_select($sql);       
          ?>
          <?php foreach($postsData as $value ):?>
          <li>
            <a href="./detail.php?id=<?php echo $value['id']?>">
              <p class="title">
                <?php echo $value['title']?>
              </p>
              <p class="reading">阅读(
                <?php echo $value['views']?>)</p>
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
                  where  c.status='approved' order by id desc limit 10";
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
      <div class="panel new">
      
        <h3><?php echo $name?></h3>
        <?php
          $sql = "select p.id,p.title,p.feature,p.created,p.content,p.views,p.likes,u.nickname from posts p inner join users u on p.user_id=u.id
                                      where p.category_id=$id and p.status='published'
                                      order by p.id desc limit 5";
          $content = my_select($sql);
          foreach($content as $value):
            $wZid = $value['id'];
            $sql = "select * from comments where post_id=$wZid";
            $plNum = count(my_select($sql));
        ?>
        <div class="entry">
          <div class="head">
            <a href="./detail.php?id=<?php echo $value['id']?>"><?php echo $value['title']?></a>
          </div>
          <div class="main">
            <p class="info"><?php echo $value['nickname']?> 发表于 <?php echo $value['created']?></p>
            <p class="brief"><?php echo $value['content']?></p>
            <p class="extra">
              <span class="reading">阅读(<?php echo $value['views']?>)</span>
              <span class="comment">评论(<?php echo $plNum?>)</span>
              <a href="javascript:;" class="like" wzid=<?php echo $value['id']?>
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?php echo $value['likes']?>)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span><?php echo $name?></span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="<?php echo $value['feature']?>" alt="">
            </a>
          </div>
        </div>
        <?php endforeach?>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
<script src='assets/vendors/jquery/jquery.js'></script>  
<script>

   $('.like').click(function (e) {
        e.preventDefault();
        var wid =$(this).attr('wzid');
        var that = this;
        $.post({
          url: './admin/api/doZan.php',
          data: {
            id: wid
          },
          success: function (obj) {
            if (obj != 'fail') {
                $(that).html('<i class="fa fa-thumbs-up"></i><span>赞('+obj+')</span>');
            } else {
              alert('失败')
            }
          }
        })
      })

</script>