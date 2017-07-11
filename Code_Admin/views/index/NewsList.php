<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\commonFuc;
$com = new commonFuc();
$i = 1;
?>

<style type='text/css'>
*{
    font-family: "微软雅黑";
}
.head{
    margin:0px;
    width:100%;
    height: 50px;
    line-height: 50px;
    color:white;
    font-size: 24px;
    font-weight: bold;
    background-color:#56D4BD;;
    box-shadow:4px 1px 1px rgba(0,0,0,0.35),0px 0px 40px rgba(0,0,0,0.1) inset;
    text-align: center;
}
.content{
    width:80%;
    min-width:580px;
    min-height: 620px;
    height:auto;
    margin:20px auto;
    overflow: auto;
}
.leftUL{
    width:16%;
    min-width:130px;
    height:600px;
    margin-top: 10px;
    float:left;
    background-color: #636479;
    position: absolute;
}
.leftUL ul{
    position: relative;
    left:-35px;
}
.leftUL ul li{
    width:100%;
    list-style: none;
    line-height:30px;
    text-align: center;
    padding:10px 15px;
    border-bottom: 1px solid gray;
}
.leftUL ul li a{
    color:#fff;
    text-decoration: none;
    font-size: 16px;
    font-weight: bold;
}
.leftUL ul li a:hover{
    color:black;
}
.rightTitle{
    width:76%;
    min-width:438px;
    min-height:500px;
    height:auto;
    margin-top: 10px;
    float:right;
}
.newsTop{
    width:80%;
    height:50px;
    text-align: center;
    border-bottom: 1px solid gray;
}
.newsTitle{
    width:90%;
/*  border:1px solid pink;*/
    height:auto;
}
.newsTitle ul{
    margin-left: -30px;
}
.newsTitle ul li{
    width:88%;
    list-style: none;
    height:30px;
    border-bottom: 1px dashed #ccc;
}
.newsTitle ul li a{
    text-decoration: none;
    color:#2980b9;
    line-height: 30px;
}
.newsTitle ul li a:hover{
    color:#b1b1b1;
}
.date2{
    float:right;
    color:gray;
    line-height: 30px;
}
footer{
    width:100%;
    height:50px;
    background-color:#66C5B4;
    box-shadow:4px 1px 1px rgba(0,0,0,0.5),0px 0px 40px rgba(0,0,0,0.1) inset;
    margin: 0px;
    padding:0px;
}
#copyRight{
    float: left;
    height:50px;
    line-height:50px;
    color:white;
    width:500px;
    margin-left:5%;
}
.friend-a{
    width:500px;
    float:right;
    margin-right: 5%;
    padding-top: 0px;
}
.friend-a ul{
    margin-top:15px;
    float:right;
}
.friend-a ul li{
    float:left;
    list-style: none;
    margin-right: 15px;
    font-size: 14px;
}
.friend-a ul li a{
    color:white;
    letter-spacing: 1px;
    text-decoration: none;
}
.friend-a ul li a:hover{
    color:#D45544;
}
body{
    margin:0px;
    padding: 0px;
}
</style>
</head>

<header class="head">
CUIT&nbsp;&nbsp;LOOP工作室
</header>

<section class="content">
<div class="leftUL">
    <ul>
        <?php foreach ($type as $model) {
            $id = $model['CuitMoon_DictionaryName'];
            echo '<li> <a id="NewsType" onclick="newsAction(' . "'$id'" . ')" href="#">'.$model['CuitMoon_DictionaryName'].'</a></li>';
        }?>
    </ul>
</div>

<article class="rightTitle">
    <div class="newsTop">
    <h2>新闻列表</h2>
    </div>
    <div class="newsTitle">
    <ul id="changeTitle">
        <?php foreach($m_news as $model) { if ($model['State']==0){continue;}?>
             <li><a id="TheNew" href="<?=Url::toRoute('index/news')?>&&id=<?=$model['newsBh']?>" ><?=$model['newstitle']?></a><span class="date"><?=$model['releasetime']?></span></li>
       <?php }?>
    </ul>
    </div>
</article>
</section>


<footer>
    <div id="copyRight">
    Copyright&copy; 2016-2020 BY CUITLOOP工作室 All Rights Reserved
    </div>
    <div class="friend-a">
        <ul>
            <li style="border-right:1px solid #fff; padding-right: 15px;"><a href="<?=Url::toRoute('/front/site/index')?>">学生登录中心</a></li>
            <li ><a href="<?=Url::toRoute('/site/index')?>">教学管理中心</a></li>
        </ul>
    </div>
</footer>

<script>
    function newsAction($id){
        $.ajax({
            type: "GET",
            url: "<?=Url::toRoute('index/news-type')?>",
            data: {"id":$id},
            cache: false,
            dataType:"json",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert( xmlHttpRequest.readyState+ textStatus);
                window.location.reload();
            },
            success: function(data){
                    var html = '';
                    for(key in data)
                    {
                        if(data[key].State==0){continue;}
                        html += '<li><a href="<?=Url::toRoute('index/news')?>&&id='+data[key].newsBh+'" id="'+data[key].newsBh+'" class="news_Type">'+data[key].newstitle+'</a><span class="date">'+data[key].releasetime+'</span></li>';
                    }
                    $('#changeTitle').html('');

                    $('#changeTitle').append(html);
            }
        });
    }
</script>