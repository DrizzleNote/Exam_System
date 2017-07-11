<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\commonFuc;
$com = new commonFuc();
$i = 1;
?>

<style type="text/css">
body{
	background-color:#F6F6F6;
}
.top{
  height: 80px;
  width:100%;
  line-height: 80px;
  text-align: center;
  background-image: url(<?=Url::base()?>/front/img/top.PNG);
  background-repeat: no-repeat;
  background-size: cover;
  margin-bottom: 15px;
}
.topIfo{
  color:white;
  font-size: 30px;
  letter-spacing: 5px;
  font-style: italic;
}
.my_Nav{
	width:70%;
	min-width: 586px;
	border-radius:10px 10px 0 0;
	margin:0 auto;
	height:50px;
	line-height: 50px;
	border-bottom:1px solid #ccc;
	background:linear-gradient(to bottom,#FFAD5B,#fff,#FFAD5B);
}
.my_Nav ul{
	float:right;
	margin-right:55px;	
}
.my_Nav ul li{
	list-style:none;
	float:left;
	display:block;
	margin:0 20px;
		
}
.my_Nav ul li a{
	color:#C00;	
	font-size: 16px;
	font-weight:bold;
	text-decoration:none;	
}
.my_Nav ul li a:hover{
	color:#F90;
}
.content{
	background-color:white;
	padding:5px 30px;
	width:70%;
	min-width: 586px;
	height:auto;
	margin:10px auto;
	margin-bottom:40px;
	box-shadow:10px 10px 10px 10px #E2E2E2;
	box-shadow:0px 1px 4px rgba(0,0,0,0.3),0px 0px 40px rgba(0,0,0,0.1) inset;
}
.content h1{
	text-align:center;
}
.newsTop{
	text-align: center;
	width:96%;
	margin:0 auto;
	height:35px;
	line-height: 35px;
	border-bottom: 1px dashed #ccc;
}
.newsContent{
	width:98%;
	margin:20px auto;
	min-height: 280px;
	height:auto;
}
.newsContent p{
	font-size: 16px;
	line-height: 25px;
}
footer{
	clear:both;
	width:100%;
	height:50px;
	background-color:#66C5B4;
	box-shadow:4px 1px 1px rgba(0,0,0,0.5),0px 0px 40px rgba(0,0,0,0.1) inset;

}
#copyRight{
	height:50px;
	line-height:50px;
	color:white;
	width:1000px;
	margin:auto;
}
</style>

</head>

 <header class="top">
<span class="topIfo">过程考核平台新闻资讯</span>
</header> 
<nav class="my_Nav">
	<ul class="Goto">
    <li><a href="<?=Url::toRoute('NewsList')?>">新闻首页</a>
    <li><a href="<?=Url::toRoute('about-us')?>">关于我们</a>
    <li><a href="<?=Url::toRoute('/front/site/index')?>">学生登录中心</a>
    <li><a href="<?=Url::toRoute('/site/index')?>">考务管理中心</a>
    
    </ul>
</nav>
<section class="content">
    <?php foreach($m_news as $model) {?>
	<h1><?=$model['newstitle']?></h1>
        <div class="newsTop">
            发布者：<?=$model['releaseUser']?> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;发布时间：<?=$model['releasetime']?>
        </div>
    <?php }?>

	<article class="newsContent">
        <?php foreach($m_news as $model) {?>
        <p><?=$model['newscontent']?></p>
        <?php }?>
    </article>
</section>

<footer>
    <div id="copyRight">
    Copyright&copy; 2016-2020 BY CUITLOOP工作室 All Rights Reserved
    </div>
</footer>


