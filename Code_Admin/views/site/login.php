<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\captcha\Captcha;


?>
<style type="text/css">
html,body{
  width:100%;
  height:100%;
}
.bg{
  border:0px solid #F6F6F6;
  position: fixed;
  margin:0;
  padding:0;
  width:100%;
  height: 100%;
  background:url(<?=Url::base()?>/front/img/teacherBg11.jpg);
  background-repeat: no-repeat;
  background-position: center;
  background-attachment: fixed;
  background-size: cover;
}
.Loading
{
    display:none;
    background-color:#fcfcfc;
    position: fixed;
    width: 450px;
    height: 380px;
    left: 50%;
    top: 40%;
    margin-left: -225px;
    margin-top: -160px;
    text-align: center;
    color: #078de4;
    z-index: 999;  
    -moz-opacity: 0.75;
    opacity:0.75;
    filter: alpha(opacity=75); 
    filter: opacity(75);
}
.login-box-body{
  border:2px solid #e1e1e1;
  padding:20px 10px;
}
.Loading img{
	width:100%;
	height: 100%;
}
</style>
<div class="bg">
<div class="login-box">
  <div class="login-logo">
    <a href="<?=Url::toRoute('site/login')?>">过程化考核平台</br><b>教务管理中心</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <h4 class="login-box-msg"><b>管理员登陆</b></h4>
	<?php $form = ActiveForm::begin(['id' => 'login-form', 'action'=>Url::toRoute('site/login')]); ?>
    <!-- <form action="../../index2.html" method="post">   -->
      <div class="form-group has-feedback">
        <input name="username" id="username" type="text" class="form-control" placeholder="用户名" />
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" id="password" type="password" class="form-control" placeholder="密码">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
   
      <?= $form->field($verify,'verifyCode')->widget(yii\captcha\Captcha::className(),['id'=>'change'])?>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input name="remember" id="remember" value="y" type="checkbox" /> &nbsp;记住我的登录
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button id="login_btn" type="button" class="btn btn-primary btn-block btn-flat">登录</button>
        </div>
        <!-- /.col -->
      </div>
    <!-- </form>  -->
    <?php ActiveForm::end(); ?>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

 <div id = "Waitting" class="Loading">    
            <img src="<?=Url::base()?>/front/img/Loading1.gif" alt="……" title="Loading..." width="300px"
                height="300px" />
       </div>
</div><!-- /.bg -->
<script>
$('#login_btn').click(function (e) {
    e.preventDefault();
	$('#login-form').submit();
});
$('#login-form').bind('submit', function(e) {
	e.preventDefault();
    $(this).ajaxSubmit({
    	type: "post",
    	dataType:"json",
    	url: "<?=Url::toRoute('site/login')?>",
    	success: function(value) 
    	{
        	if(value.error == 0){
        		$(".Loading").css('display','block');
        		window.location.reload();
        	}
        	else if(value.error == 2){
            	$('#username').attr({'data-placement':'top', 'data-content':'<span class="text-danger">用户名或密码错误</span>', 'data-toggle':'popover'}).addClass('popover-show').popover({html : true }).popover('show');
        	}
          else{
              alert("验证码错误");
              window.location.reload();
          }

    	}
    });
});

$('#captcha-verifycode-image').click(function(){
  window.location.reload();
})
    $(document).keydown(function(event){
        if(event.keyCode==13){
           $('#login_btn').click();
        }
    });
</script>