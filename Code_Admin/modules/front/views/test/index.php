<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>

<?php $this->beginBlock('header');  ?>
<link rel="stylesheet" href="<?=Url::base()?>/front/css/exam_style.css" type="text/css">
<script language = "JavaScript" src="<?=Url::base()?>/front/bootstrap/js/bottom"/></script>

<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>
<style type='text/css'>

</style>

    <div id="Bigbox">
        <iframe src="<?=Url::toRoute("test/left")?>" id="frame1" frameborder="0" scrolling="no"></iframe>
        <iframe src="" id="frame2" name="view_frame" frameborder="0" scrolling="no" style="width:85%; float:right;"></iframe>
    </div> <!--BigBOX-->




<?php $this->beginBlock('footer');  ?>

<script type="text/javascript">
    function tab(id) {
        var tmp = $('#'+id+'-a').css('display');
        if (tmp == 'none') {
            $('#'+id+'-a').slideDown(500);
        } else {
            $('#'+id+'-a').slideUp(500);
        }
    }
        $(".MyMouse").hover(
            function(){
                $(this).children(".Nmenu3").show();
            },
            function(){
                $(this).children(".Nmenu3").hide();
            });

            //下面是试卷的样式
    $(document).ready(function(){
        $(".toggle").click(function(){
            var _index = $(this).index();

            if($(this).html()=="展开")
            {
                $(this).html("收起");
            }else
            {
                $(this).html("展开");
            }
         $(this).parent('.Tet').siblings('.Mid_Text').slideToggle();
            
        });
        $(".T-name").click(function(){
            $(this).next('.My_Text').slideToggle("fast");
        });
        $("#Head-top li").click(function(){
            var _rel = $(this).attr("name");
            var pos = $('#'+_rel).offset().top;
            $("html,body").animate({scrollTop:pos},300);
        });
    });
      

</script>

<script type="text/javascript">
    function reinitIframe1(){
    var iframe = document.getElementById("frame1");
    try{
    var bHeight = iframe.contentWindow.document.body.scrollHeight;
    var dHeight = iframe.contentWindow.document.documentElement.scrollHeight;

    var height = bHeight;
    iframe.height = height;
    }catch (ex){}
    };

    function reinitIframe2(){
    var iframe = document.getElementById("frame2");
    try{
    var bHeight = iframe.contentWindow.document.body.scrollHeight;
    var dHeight = iframe.contentWindow.document.documentElement.scrollHeight;

    var height = bHeight;
    iframe.height = height;
    }catch (ex){}
    };

    window.setInterval("reinitIframe1()", 20);
    window.setInterval("reinitIframe2()", 20);
</script>

<?php $this->endBlock(); ?>






