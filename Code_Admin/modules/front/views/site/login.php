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
#text{
    padding-left:50px;
    padding-top: 30px;
}
</style>
<header id="top">
    <div id="top_img">
  	<img src="<?=Url::base()?>/front/img/Systemlogo.jpg">
    <span></span>
    </div>
    <div id="top_name">
    <span class="bg_top">过程化考核平台学生考试中心</span>
    </div>
</header>

<div id="content" style="background:url(<?=Url::base()?>/front/img/login_bg.jpg); height:378px; width:100%; background-attachment:scroll; background-repeat:no-repeat; background-size:cover;  background-position:center center; overflow:hidden;">
<div id="box">
	<div id="text">
    	<h1 style="font-weight:bolder;">梦想起航</h1>
        <h2>自主学习，习而成长</h2>
    </div>
    <div id="Login">
    	<div id="h4">
        <h4>学生登录</h4>
        </div>
        <div id="student">
     		<table>
                        <tr>
                            <td style=" height:50px">
                                <label>学号：</label>
                                <input type="text" name="StuNumber" id="loginname" tabindex="1" placeholder="请输入学号" style="width: 160px;height: 25px; " />
                            </td>
                        </tr>
                        <tr>
                            <td style=" height:50px">
                            <label>密码：</label>
                                <input type="password" name="password" id="password" tabindex="2" placeholder="请输入密码" style="width: 160px;height: 25px;"/>
                               </td>
                        </tr>
                        <tr>  
                            <td align="right" colspan="2">
                            <img style=" position:relative; top: 6px; left: -30px;" id="imgLogin" 
                                    src="<?=Url::base()?>/front/img/login_botton.png" tabindex="3" alt="登录" 
                                    onmousemove="src='<?=Url::base()?>/front/img/login_botton_hover.png'" 
                                    onmouseout="src='<?=Url::base()?>/front/img/login_botton.png'"/>
                            </td>
                        </tr>
                        <tr><td style="text-align: center; padding-top: 4px;"><a style="color:#fff; font-size: 14px;" href="<?=Url::toRoute('/not/reset')?>">忘记密码</a></td></tr>
                 </table>
             </div>
             <p style="width:250px; margin:0 auto; margin-top:15px; font-size:14px; color:#0CF; text-align:center;"  >登录前请认真阅读以下登录须知，以免遇到异常情况</p>
    </div>
</div>
</div>   <!--content-->
<div id="introduce">
<h2 style="text-align:center; color:#F60;">考试登录前须知</h2>
<p style="text-align:center;">欢迎使用过程化考试系统，使用本系统前，请认真阅读以下说明，并按照要求进行考试，以免给您的考试带来不便：</p>
 <p>一、本系统支持C语言考试、C++考试、数据结构考试等大多数课程的考试。
    如果进行C语言、C++这两门课的编程考试需要进行VC编译环境测试方能正常进行编程题考试。</p>
    
    <p>二、考生第一次登录的用户名和密码默认都是学号，登录后可自行修改密码。第一次不能正常登录的用户请向老师确认系统是否拥有该考生。	</p>
    <p>三、编译环境的测试，请进入测试与配置页面，进行编译插件的安装于测试。</p>
    <p>四、编译插件安装前，请确认是否安装正确版本的VC 6.0,只要能保证VC 6.0能在本机正常运行即可。</p>
    <p>五、下载安装插件安装包，解压后，请一定要以管理员身份运行编译插件的安装程序。并保证浏览器拥有管理员权限，编译环境才能测试通过，才能进行编程题考试。</p>
	<p>六、在考试中出现页面显示不正常的情况。建议更换稳定版本的浏览器。</p>
</div>
 </div>

       <div id = "Waitting" class="loginDiv_over">   
            <img src="<?=Url::base()?>/front/img/loading.gif" alt="……" title="Loading..." width="300px"
                height="300px" />
       </div>
 </div>

 <footer>
    <div id="copyRight">
    Copyright&copy; 2016-2020 BY CUITLOOP工作室 All Rights Reserved
    </div>
</footer>

<script src="<?=Url::base()?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function () {
          $("#imgLogin").click(function(){
                var name = $("#loginname").val();
                var pwd = $("#password").val();
                if (name != "" && pwd != "") {
                    $.ajax({
                        type: "post",
                        dataType: "JSON",
                        url: '<?=Url::toRoute("site/login")?>',
                        data: { "StuNumber": $('#loginname').val(), "password": $('#password').val() },
                        success: function (data) {
                            if(data.error == 0){
                            	$(".loginDiv_over").css("display","block");
                                window.location.reload();
                            }else{
                            	alert("学号或密码输入错误！");
                            }
                        },
                        cache: false,
                    });
                }
                else {
                    alert("学号和密码都不能为空！");
                }
          });

            $(document).keydown(function(event){
                if(event.keyCode==13){
                    $("#imgLogin").click();
                }
            });
        });

		
    </script>