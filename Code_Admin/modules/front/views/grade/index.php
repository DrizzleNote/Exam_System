<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\commonFuc;
$com = new commonFuc();
$i = 1;
?>
	<script src="<?=Url::base()?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/exam_style.css" type="text/css">
<style type="text/css">
*{
  margin:0; padding:0;
  font-family:"微软雅黑";
}
a{
  border:none;
  bblr:expression(this.onFocus=this.blur());/*IE使用*/
  outline-style:none;/*FF使用*/ 
}
a:link,a:hover,a:visited,a:active{
  outline-style:none;   
}
.Cont{
	padding:10px 20px;
}
.Cont h2{
	color:red;
}
.table{
	margin:0;
	border:0;
}
.table tr td,tr th{
	text-align:center;
	font-size:16px;
	font-family:Georgia, "Times New Roman", Times, serif;
	border:0px;
}
.table tr td{
	text-align:center;
	font-size:14px;
	border:2px solid #fff;
	font-family:"Times New Roman", Times, serif;
	font-weight:800;
}
.slideTB{
	border:0px;
	display:none;
}
#test{
	font-size:12px;
	color:black;
}
.myth{
	background-color:#0F9;
	border-right:1px solid white;
}
.info a,.warning a{
	font-family:"Times New Roman", Times, serif;
}
.info a:hover,.warning a:hover{
	color:red;
	text-decoration:none;
}
.th_head{
	text-align:left;
	border-left:none;
	border-style:none;
	background:white;
}
.table_btn{
	font-size:12px;
	padding:2px 8px;
	float:right;
}
.color1{
	background-color:#4EEEFE80;
}
	
.color2{
	background-color:#F5F87DB3;
}
.thColor1{
	background-color: #64CDD8;
}
.thColor2{
	background-color: #FBF599;
}
</style>

<div class="Cont">
          <h2>目前获得成绩</h2>
            <?php foreach ($info as $key=>$item) {?>
          <table class="table" border="1" rules="all" cellSpacing="1">
            <tbody>
              <!-- On rows -->
              <tr>
                <th  class="th_head" rolSpan="2" colSpan="2" scope="col"><?=$key?></th>
                <th class="th_head" rolSpan="2" colSpan="2" scope="col"><input type="button" class="table_btn" value="展开︾"  /></th>
              </tr>

              <tr > 
         <!--   <div class="table1">   -->
                <table class="table table-hover slideTB" id="Gide" border="1" rules="all"
                                                  cellSpacing="1">
                  <tbody>
                    <!-- On rows -->
                    <tr>
                      <th  class="thColor1" rowSpan="1" colSpan="1" scope="col">考试名称</th>
                      <th class="thColor2" rolSpan="1" colSpan="1" scope="col">第几次考试</th>
                      <th class="thColor1" rowSpan="1" colSpan="1" scope="col">开始时间</th>
                      <th class="thColor2" rolSpan="1" colSpan="1" scope="col">交卷时间</th>
                      <th class="thColor1" rolSpan="1" colSpan="1" scope="col">成绩</th>
                    </tr>
                    <?php foreach ($item as $va) {?>
                    <tr>
                      <td  class="color1" rowSpan="1" colSpan="1" scope="col"><?=\app\models\teachplan\Examplan::find()->where(['ExamPlanBh' => $va->ExamPlanBh])->asArray()->one()['ExamPlanName']?></td>
                      <td class="color2" rolSpan="1" colSpan="1" scope="col"><?=$va->NumOfExam?></td>
                      <td class="color1" rowSpan="1" colSpan="1" scope="col"><?=$va->StarTime?></td>
                      <td class="color2" rolSpan="1" colSpan="1" scope="col"><?=$va->EndTime?></td>
                      <td class="color1" rolSpan="1" colSpan="1" scope="col"><?=$va->ExamScore?></td>
                    </tr>
                    <!-- On cells (`td` or `th`) -->
                    <?php }?>

                  </tbody>
                </table>
                 <!-- </div>  -->  <!--table1-->
                               
              </tr>
            </tbody>
          </table>  <!--1大的总的table的结束-->
            <?php } ?>
        </div><!--Cont1--> 
        
<script type="text/javascript">
	$(document).ready(function(){
		$(".table_btn").click(function(){
			if($(this).val()=='展开︾')
			{
				$(this).val('收起︽');
			}
			else if($(this).val()=='收起︽')
			{
				$(this).val('展开︾');
			}
			$(this).parents().next(".slideTB").slideToggle(5);
		});
		
	});
</script> 