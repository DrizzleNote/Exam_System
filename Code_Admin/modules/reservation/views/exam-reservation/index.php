<?php
/* @var $this yii\web\View */
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
				<div class="box-header">
					<h3 class="box-title">考场预约管理</h3>
					
				</div>
				 
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <!-- row start search-->
                            
                
                <div class="row">
                            <div class="col-sm-12">
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
                                <h3 class="text-center" id="class_question_title">已开放考场列表</h3>
                                    <thead>
                                    <tr role="row">

                                        <?php
                                       
                                        echo '<th><input id="data_table_check" type="checkbox"></th>';
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'开放日期'.'</th>';
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'考场'.'</th>';
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'考试开始时间'.'</th>';
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'考试结束时间'.'</th>';
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'已选数量/座位总数'.'</th>';
                                       
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'操作'.'</th>';
                                        
                                        ?>                          
                                    </tr>
                                    </thead>
                                    <tbody id="reservation_info">

                                    <?php
                                    $row = 0;                                
                                    foreach ($info as $model) {
                                        echo '<tr id="rowid_' . $model['ConfigureBh'] . '" class="option_sum">';
                                        echo '  <td><label><input name="checkbox" type="checkbox" value="' . $model['ConfigureBh'] . '"></label></td>';                                                                          
                                        echo '  <td>' . $model['TestDate']. '</td>';
                                        echo '  <td>' . $model['TestRoomName'] . '</td>';
                                        echo '  <td>' . $model['testBeginTime'] . '</td>';
                                        echo '  <td>' . $model['testEndTime'] . '</td>';                                 
                                        echo '  <td>' . $model['SeatSelect'] ."/".$model['SeatTotal'] .'</td>';              
                                        echo '  <td class="center">';
                                        echo '      <a id="view_btn" onclick="viewAction(\'' .$model['ConfigureBh'] . '\')" class="btn btn-primary btn-sm" > <i class="glyphicon glyphicon-zoom-in icon-white"></i>预约详情</a>';    
                                        
                                        echo '      <a id="delete_btn_" onclick="deleteAction(\'' .$model['ConfigureBh'] . '\')"  class="btn btn-danger btn-sm" href="#"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
                                        echo '  </td>';
                                        echo '<tr/>';
                                    }

                                    ?>                      

                                    </tbody>
                                    <!-- <tfoot></tfoot> -->
                                </table>
                            </div>
                        </div>
                    <!-- row end -->

				 </div>
				 <div class="box-footer">
				 <!-- footer -->
				 </div>
			</div>
		</div>
	</div>
</section>

<script>
$('#view_btn').click(function(e){
        e.preventDefault();
        viewAction('');

    });

function viewAction(id)
{
     // alert(id);
    window.location.href = '<?=Url::toRoute("exam-reservation/view")?>'+'&ConfigureBh='+id;
    // $.ajax({
    //     type:'GET',
    //     url:'<?=Url::toRoute("exam-reservation/view")?>',
    //     data:{ConfigureBh:id},
    //     success:function(value){
             
    //     }

    // });
}

function deleteAction(id){  
    if(window.confirm("          亲(*^__^*)~~     你确定删除我吗？"))                          
            {
                 $.ajax({
                    type: "GET",
                    url: "<?=Url::toRoute('exam-reservation/delete1')?>",
                    data: {'id':id},
                    cache: false,
                    dataType:"json",
                    error: function (xmlHttpRequest, textStatus, errorThrown) {
                        alert("出错了，" + textStatus);
                    },
                    success: function(value){                        
                       
                       window.location.reload();
                    }
                });   
    }
    else 
            return false; 
    } 

</script>




