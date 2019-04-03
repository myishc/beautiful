<?php
  //  导入工具
  require_once "admin/api/tools/doSql.php";

  //查出轮播图

  $sql = "select *from sliders";

  $slideList = my_select($sql); 
  
  // var_dump($slideList)


  $sql = "select id,title,feature,views from posts order by rand() limit 5";

  $postsData = my_select($sql);

  // var_dump($postsData)
  

?>




<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
  <style>
    .swipe-wrapper li img {
      height:320px;
    }
  
  </style>
</head>

<body>
  <div class="wrapper">
    <div class="topnav">
      <ul>
        <?php
        //分类
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
      <div class="swipe">
        <ul class="swipe-wrapper">
          
          <?php foreach($slideList as $value): ?>
          <li>
            <a href="<?php echo $value['link']?>">
              <img src="<?php echo $value['image']?>">
              <span>
                <?php echo $value['text']?></span>
            </a>
          </li>
          <?php endforeach;?>
        </ul>
        <p class="cursor">
          <?php foreach($slideList as $key=>$value):?>
          <?php if($key==0):?>
          <span class="active"></span>
          <?php else:?>
          <span></span>
          <?php endif;?>
          </>
          <?php endforeach;?>
          <a href="javascript:;" class="arrow prev"><i class="fa fa-chevron-left"></i></a>
          <a href="javascript:;" class="arrow next"><i class="fa fa-chevron-right"></i></a>
      </div>
      <div class="panel focus">
        <h3>焦点关注</h3>
        <ul>
          <?php
          //最新焦点
            $sql  = "select id,title,feature from posts where status='published' order by id desc limit 5";

            $newData = my_select($sql);
            foreach ($newData as $key=> $value):
            if($key==0):
          ?>
          <li class="large">
            <?php else:?>
          <li>
            <?php endif?>
            <a href="./detail.php?id=<?php echo $value['id']?>">
              <img src="<?php echo $value['feature']?>" alt="">
              <span>
                <?php echo $value['title']?></span>
            </a>
          </li>
          <?php endforeach?>
        </ul>
      </div>
      <div class="panel top">

        <h3>一周热门排行</h3>
        <ol>
          <?php 
          //一周热门排行
          $sql  = "select id,title,feature,views,likes from posts 
                    where status='published' order by views desc limit 5";

          $hotData = my_select($sql);
          foreach ($hotData as $key=> $value):
        ?>
          <li>
            <i>
              <?php echo $key+1?></i>
            <a href="./detail.php?id=<?php echo $value['id']?>">
              <?php echo $value['title']?></a>
            <a href="#" wzid='<?php echo $value['id']?>' class="like">赞(
              <?php echo $value['likes']?>)</a>
            <span>阅读 (
              <?php echo $value['views']?>)</span>
          </li>
          <?php endforeach?>
        </ol>
      </div>
      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul>
          <!--热门推荐  -->
          <?php for($i=0 ; $i<4 ; $i++):?>
          <li>
            <a href="./detail.php?id=<?php echo $hotData[$i]['id']?>">
              <img src="<?php echo $hotData[$i]['feature']?>" alt="">
              <span>
                <?php echo $hotData[$i]['title']?></span>
            </a>
          </li>
          <?php endfor?>
        </ul>
      </div>
      <div class="panel new">
        <h3>最新发布</h3>
        <?php
          $sql = "select p.id,p.title,p.content,p.created,p.views,p.likes,p.feature,u.nickname,c.name
                         from posts p inner join categories c on p.category_id=c.id
                                      inner join users u on p.user_id = u.id where 
                                      p.status='published' order by p.id desc limit 3";
          $article = my_select($sql);
          // var_dump($article);
          foreach ($article as $value):
            $wZid = $value['id'];
            $sql = "select * from comments where post_id=$wZid";
            $plNum = count(my_select($sql));
        ?>
        <div class="entry">
          <div class="head">
            <span class="sort"><?php echo $value['name']?></span>
            <a href="./detail.php?id=<?php echo $value['id']?>"><?php echo $value['title']?></a>
          </div>
          <div class="main">
            <p class="info"><?php echo $value['nickname']?> 发表于 <?php echo $value['created']?></p>
            <p class="brief"><?php echo $value['content']?></p>
            <p class="extra">
              <span class="reading">阅读(<?php echo $value['views']?>)</span>
              <span class="comment">评论(<?php echo $plNum?>)</span>
              <a href="#" wzid=<?php echo $value['id']?> class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?php echo $value['likes']?>)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span><?php echo $value['name']?></span>
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
  <script src="assets/vendors/jquery/jquery.js"></script>
  <script src="assets/vendors/swipe/swipe.js"></script>
  <script>
    //
    var swiper = Swipe(document.querySelector('.swipe'), {
      auto: 3000,
      transitionEnd: function (index) {
        // index++;

        $('.cursor span').eq(index).addClass('active').siblings('.active').removeClass('active');
      }
    });


    // 上/下一张
    $('.swipe .arrow').on('click', function () {
      var _this = $(this);

      if (_this.is('.prev')) {
        swiper.prev();
      } else if (_this.is('.next')) {
        swiper.next();
      }
    })



    //点赞
   

      $('.like').click(function (e) {
        var length = $(this).children().length>0;
        e.preventDefault();
        var wid =$(this).attr('wzid');
        var that = this;
        $.post({
          url: 'admin/api/doZan.php',
          data: {
            id: wid
          },
          success: function (obj) {
            if (obj != 'fail') {
              if(length){
                $(that).html('<i class="fa fa-thumbs-up"></i><span>赞('+obj+')</span>')
              }else{
                $(that).html('赞(' + obj + ')');
              }
              
            } else {
              alert('失败')
            }
          }
        })
      })
   

      //搜素按钮
      // $('.btn').click(function(e){
      //   e.preventDefault();

      //   $.get({
      //     url: 'admin/api/doSearch.php',
      //     data: {text:$('.keys').val()},
      //     dataType:'json',
      //     success:function(obj){
      //       console.log(obj);
            
      //       if(obj.length>0){
      //         location = 'detail.php';
      //       }else{
      //         alert('没有这样的文章')
      //       }
      //     }
      //   })
      // })
  </script>
</body>

</html>