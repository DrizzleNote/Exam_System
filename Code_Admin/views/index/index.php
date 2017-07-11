<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\commonFuc;
$com = new commonFuc();
$i = 1;
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="author" content="Jophy" />
 
    <!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style type="text/css">
.NewName li{
    background-image: url(<?=Url::base()?>/front/img/newsriqi.png);
}
</style>
</head>
<div id="container-fluid">
<header class="head">
    <div id="font"> 
        <span class="name">过&nbsp;&nbsp;程&nbsp;&nbsp;化&nbsp;&nbsp;考&nbsp;&nbsp;核&nbsp;&nbsp;平&nbsp;&nbsp;台</span>
    </div>
</header>
</div>  <!--container-->

<div id="wrap">
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    <li data-target="#carousel-example-generic" data-slide-to="3"></li>    <!--小圆点-->
  </ol>
  
  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
  
    <div class="item active"> <img src="<?=Url::base()?>/front/img/cuit2.jpg" alt="...">
      <!-- <div class="carousel-caption"> 此处可以添加文本</div> -->
    </div>
    
    <div class="item"> <img src="<?=Url::base()?>/front/img/cuit1.jpg" alt="...">
    </div>
    
    <div class="item"> <img src="<?=Url::base()?>/front/img/cuit4.jpg" alt="...">
        
    </div>
    
    <div class="item"> <img src="<?=Url::base()?>/front/img/cuit5.jpg" alt="...">
        
    </div>
  </div>
<!-- Controls --> 
<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span> <span class="sr-only">Previous</span> </a> <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span> <span class="sr-only">Next</span> </a>
</div>   <!--灰色背景和左右箭头和可左右翻动-->
<div id="content1">
<div class="news">
    <div class="news1">
            <div class="news_head">
                <div class="news_title"><span id="new1" class="NewStyle">课程通知</span></div>
                <div class="news_title"><span id="new2">课程公告</span></div>
                <div class="news_more">
                    <a href="<?=Url::toRoute('/index/news-list')?>">更多&gt;&gt;</a>
                 </div>
             </div>
             <ul class="NewName tab1">
                 <?php foreach($info as $key=>$model) { $id = $model['newsBh']; if($key ==4 || $model['State']==0){continue;}?>
                     <li><a id="TheNew" href="<?=Url::toRoute('index/news')?>&&id=<?=$model['newsBh']?>"><?=$model['newstitle']?></a><span class="date"><?=$model['releasetime']?></span></li>
                 <?php }?>
              </ul>
             <ul class="NewName tab2" style="display:none;">
                 <?php foreach($info as $key=>$model) { $id = $model['newsBh']; if($key <4 || $model['State']==0){continue;}?>
                     <li><a id="TheNew" href="<?=Url::toRoute('index/news')?>&&id=<?=$model['newsBh']?>"><?=$model['newstitle']?></a><span class="date"><?=$model['releasetime']?></span></li>
                 <?php }?>
             </ul>
    </div>
      <div class="news1">
          <div class="news_head">
              <div class="news_title"><span id="new5" class="NewStyle">刷题排行榜</span></div>
              <div class="news_title"><span id="new3">排行榜(二)</span></div>
              <div class="news_title"><span id="new4">Loop成果</span></div>
                <div class="news_more">
                  <a href="<?=Url::toRoute('/index/news-list')?>">更多&gt;&gt;</a>
                 </div>
             </div> 
             <ul class="NewName tab3">
                 <?php foreach($info as $key=>$model) { $id = $model['newsBh']; if($key <8 || $model['State']==0){continue;}?>
                     <li><a id="TheNew" href="<?=Url::toRoute('index/news')?>&&id=<?=$model['newsBh']?>"><?=$model['newstitle']?></a><span class="date"><?=$model['releasetime']?></span></li>
                 <?php }?>

             </ul> 
             <ul class="NewName tab4">
                 <?php foreach($info as $key=>$model) { $id = $model['newsBh']; if($key <12 || $model['State']==0){continue;}?>
                     <li><a id="TheNew" href="<?=Url::toRoute('index/news')?>&&id=<?=$model['newsBh']?>"><?=$model['newstitle']?></a><span class="date"><?=$model['releasetime']?></span></li>
                <?php }?>
             </ul> 
             <ul class="NewName tab5">           
                    
                   <?php foreach($stuTest as $key=>$item) {if($key >=5){continue;}?>
                     <li class="TheName"><span style="color:#de1d1d; margin-right: 10px;">Top<?=($key+1)?>.</span><?=$item['StuName']?><span class="Tnum"><?=$item['sum']?>题</span></li>
                <?php }?>
             </ul>   
              <ul class="NewName tab3">               
                   <?php foreach($stuTest as $key=>$item) {if($key < 5){continue;}?>
                     <li class="TheName"><span style="color:#de1d1d; margin-right: 10px;">Top<?=($key+1)?>.</span><?=$item['StuName']?><span class="Tnum"><?=$item['sum']?>题</span></li>
                <?php }?>
             </ul>   

                
    </div>  
</div>  <!--news-->

<div class="login">
  <h4 style="color:orange; border-bottom: 3px solid orange;">办公登录</h4>

    <div class="user"><img src="<?=Url::base()?>/front/img/user1.jpg" style="float:left; width:40%; height:99%;"><a href="<?=Url::toRoute('/front/site/index')?>">学生登录中心
  </a><br></div>
    <div class="user"><img src="<?=Url::base()?>/front/img/user2.jpg" style="float:left; width:40%; height:99%;"><a href="<?=Url::toRoute('/site/index')?>">教学管理中心
</a>
    </div>
</div>
</div>  

<div class="About" id="About">
<div class="aboutBg" style="background-image:url(<?=Url::base()?>/front/img/About.png); "><h3><a href="<?=Url::toRoute('/index/about-us')?>">关于我们</a></h3></div>
<p class="teamIfo"><a href="<?=Url::toRoute('/index/about-us')?>">我们是一个划时代的优秀团队，我们每个人都是团队的不可或缺的一部分，我们专注于Web网站开发， 从事ASP.NET、PHP、HTML5/CSS等混合开发。我们的很多非常优秀的作品，它们都是属于我们团队中的每一个人......
</a></p>

    <!-- 注意：group里面的人数可以不确定，但是最后必须重复前五个人；并且后面_index的定义也要改为人数！ -->
    <div id="Team">
        <?php foreach($deve as $model){?>
        <div class="group">
        <div class="pic"><img src="upload/tmp_file/<?=$model['Src']?>"></div>
            <div class="Oname">
                <a class="look_more" href="<?=Url::toRoute('/index/developer')?>"><?=$model['DeveloperName']?></a>
            </div>
        </div>
        <?php }?>
         <?php foreach($deve as $model){?>
        <div class="group">
        <div class="pic"><img src="upload/tmp_file/<?=$model['Src']?>"></div>
            <div class="Oname">
                <a class="look_more" href="<?=Url::toRoute('/index/developer')?>"><?=$model['DeveloperName']?></a>
            </div>
        </div>
        <?php }?>
    </div><!--Team-->
</div><!--About-->

</div><!--wrap-->
<footer id="foot">
  <div id="friend-a">
    <a href="http://www.cuit.edu.cn/">学校官网</a>
     <a href="http://xsc.cuit.edu.cn/WebSite/Web/Default.html">学工网</a>
      <a href="http://jwc.cuit.edu.cn/">教务处</a>
       <a href="http://bysj.cuit.edu.cn/">毕业设计系统</a>
       <a href="http://cxcygl.cuit.edu.cn/">创新创业系统</a>
        <a href="http://www.scedu.net/">四川教育网</a>
  </div>
    <div id="copyRight">
    Copyright&copy; 2016-2020 BY CUITLOOP工作室 All Rights Reserved
    </div>
</footer>

<script type="text/javascript">
    $("#new1").mouseenter(function(){
        $("#new2").removeClass("NewStyle");
        $("#new1").addClass("NewStyle");
        $(".tab2").hide();
        $(".tab1").show();
    });
    $("#new2").mouseenter(function(){
        $("#new2").addClass("NewStyle");
        $("#new1").removeClass("NewStyle");
        $(".tab1").hide();
        $(".tab2").show();
    });
    $("#new3").mouseenter(function(){
        $("#new4").removeClass("NewStyle");
        $("#new5").removeClass("NewStyle");
        $("#new3").addClass("NewStyle");
        $(".tab4").hide();
        $(".tab5").hide();
        $(".tab3").show();
    });
    $("#new4").mouseenter(function(){
        $("#new5").removeClass("NewStyle");
        $("#new4").addClass("NewStyle");
        $("#new3").removeClass("NewStyle");
        $(".tab3").hide();
        $(".tab5").hide();
        $(".tab4").show();
    });
     $("#new5").mouseenter(function(){
        $("#new4").removeClass("NewStyle");
        $("#new3").removeClass("NewStyle");
        $("#new5").addClass("NewStyle");
        $(".tab4").hide();
        $(".tab3").hide();
        $(".tab5").show();
    });


    var _index = $(".group").length-5;
    window.onload = function(){
      var people = document.getElementById("Team");
      var box = document.getElementById("About");
      var smallBox = document.getElementsByClassName("group");
      var maxWidth = box.offsetWidth;

      // var TheWidth = (maxWidth-60-10)/5;
      var TheWidth = (maxWidth-60)/5;
      var cgeWidth = TheWidth+12;
      var TeamWidth = cgeWidth*(_index+5);
      var picHeight = TheWidth*0.94;

      var autoHeight = function(){
          var people = document.getElementById("Team");
      var box = document.getElementById("About");
      var smallBox = document.getElementsByClassName("group");
      var maxWidth = box.offsetWidth;

      // var TheWidth = (maxWidth-60-10)/5;
      var TheWidth = (maxWidth-60)/5;
      var cgeWidth = TheWidth+12;
      var TeamWidth = cgeWidth*(_index+5);
      var picHeight = TheWidth*0.94;
      $(".pic").height(picHeight);
      $("#Team").width(TeamWidth);
      $(".group").width(TheWidth);
      var h = $(".group").width();
      var outH = $("#Team").height()+100;
      $(".About").height(outH);
     };
      setInterval(autoHeight,500);

      var oldLeft = 0;
       setInterval(function(){
         if(oldLeft<-cgeWidth*(_index+5)/2){    
          oldLeft=0;
        }
        people.style.left = oldLeft+'px';
        oldLeft -=TheWidth+10;
       },2000);
    }
</script>


<script src="js/bootstrap.min.js"></script>
<script>
    function newsAction(){
        $.ajax({
            type: "GET",
            url: "<?=Url::toRoute('index/news')?>",
            data: {"id":$id},
            cache: false,
            dataType:"json",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert( xmlHttpRequest.readyState+ textStatus);
                window.location.reload();
            },
            success: function(data){
                window.location.reload();
            }
        });
    }

    function getNews($id){
        $.ajax({
            type:"GET",
            url:"<?=Url::toRoute('index/news')?>",
            data:{"id":$id},
            cache:false,
            async:false,
            dataType:"json",
            success: function(data){
                alert(data[0].newstitle),
                    window.location.reload();
                window.location.href = '<?=Url::toRoute("index/developer")?>';
            },

        });

    }
</script>
