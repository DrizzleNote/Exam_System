<?PHP
use yii\helpers\Url;
?>

<style type="text/css">
html{
	background-color: #9ce3d1;
}
.well{
	background-color: #9ce3d1 !important;
	border:none;
}
</style>

<div class="well well-lg row">
<br><br><br>
	<div class="col-sm-4">
	</div>
	<div class="col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title text-center">
					初始化默认密码
				</h3>
			</div>
			<br>
			<br>
			<div class="panel-body">
				<form class="bs-example bs-example-form" role="form">
					<div class="input-group">
						<span class="input-group-addon">学&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：</span>
						<input type="text" class="form-control" placeholder="必填" id="StuNum">
					</div>
					<br><br><br>
					<div class="input-group">
						<span class="input-group-addon">身份证号：</span>
						<input type="text" class="form-control" placeholder="必填" id="IC">
					</div>
					<br><br><br>
					<div class="input-group" style="margin: auto;">
						<button type="button" id="save" class="btn btn-primary" data-toggle="button"> 
						重置
						</button>
					</div>
					<br>

				</form>
			</div>
		</div>
		<p>注：重置后密码初始化为学号！</p>
	</div>
	<div class="col-sm-4">
	</div>
</div>
<script src="<?=Url::base()?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script>
	$('#save').click(function(){
		var num = $('#IC').val().length;
		var id = $('#StuNum').val();
		if(!id){
			alert("请输入学号！");
		}else if(num!=18){
			alert("请确认身份证号是否填写正确，默认为18位");
		}else{
		$.post(
			"<?=Url::toRoute('not/resetpasswd')?>",
			{
				StuNum:$('#StuNum').val(),
				IC:$('#IC').val()
			},
			function(res){
				alert(res);
			}
			)
	}
	})
</script>
