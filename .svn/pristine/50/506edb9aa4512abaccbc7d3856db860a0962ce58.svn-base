<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>

<?php $this->beginBlock('header');  ?>
<link rel="stylesheet" href="<?=Url::base()?>/front/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=Url::base()?>/front/css/exam_style.css" type="text/css">
<!-- <head></head>中代码块 -->
<?php $this->endBlock(); ?>

<section class="content">
    <div class="Cont" >
        <h2>当前考试列表</h2>
        <?php foreach ($ExamList as $key=>$value) {?>
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
                            <th  class="color1" rowSpan="1" colSpan="1" scope="col">考试名称</th>
                            <th class="color2" rolSpan="1" colSpan="1" scope="col">开考时间</th>
                            <th class="color1" rowSpan="1" colSpan="1" scope="col">结束时间</th>
                            <th class="color2" rolSpan="1" colSpan="1" scope="col">考试状态</th>
                        </tr>
                        <!-- On cells (`td` or `th`) -->
                        <?php foreach ($value as $va) {?>
                            <tr>
                                <td class=""><?=$va->ExamPlanName?></td>
                                <td class=""><?=$va->StarTime?></td>
                                <td class=""><?=$va->EndTime?></td>
                                <td class=""><?php
                                    $m_exam_paper = new \app\models\exam\Exampaper();
                                    $SubmitStage = $m_exam_paper->
                                    find()->where([
                                        'ExamPlanBh' => $va->ExamPlanBh,
                                        'StudentID' => Yii::$app->session->get('StudentNum')
                                    ])->orderBy("ExamBeginTime DESC")->one();
                                    // findOne([
                                    //     'ExamPlanBh' => $va->ExamPlanBh,
                                    //     'StudentID' => Yii::$app->session->get('StudentNum'),
                                    // ]);
                                    isset($SubmitStage) ? $SubmitStage = $SubmitStage->SubmitStage : $SubmitStage = '0';

                                        if (date('Y-m-d H:i:s') <= $va->StarTime) {
                                            echo '等待考试';
                                           
                                        } else if (date('Y-m-d H:i:s') <= $va->EndTime && date('Y-m-d H:i:s') >= $va->StarTime) {
                                           if ($SubmitStage == '1') {
                                               echo '已交卷';
                                           } else {
                                               echo '<a style="color:red;" href=' . Url::toRoute('exam/enter-exam') . '&ExamPlanBh=' . $va->ExamPlanBh . '>进入考试</a>';
                                           }
                                        } else {
                                            echo '考试结束';
                                        }
                                    ?></td>
                            </tr>
                        <?php }?>
                        </tbody>
                    </table>
                    <!-- </div>  -->  <!--table1-->

                </tr>
                </tbody>
            </table>
        <?php }?>
</div><!--Cont1-->
</section>


<?php $this->beginBlock('footer');  ?>

<script type="text/javascript">
    $(document).ready(function(){

        $(document).on('click','.table_btn',function(){
            if($(this).val()=='展开︾'){
                $(this).val('收起︽');
            }else{
                $(this).val('展开︾');
            }

            $(this).parents().next(".slideTB").slideToggle(5);
        });

    });
</script>
<?php $this->endBlock(); ?>
