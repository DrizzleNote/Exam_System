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
					<h3 class="box-title">考生座位查询</h3>
					
				</div>
	                 
			

                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <!-- row start search-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">查询：</span>
	                     				<input type="text" id="search_date" placeholder="请选择查询日期"/>
                                    </div>
                                    <div class="input-group">
                                       <span class="input-group-addon">搜索：</span>
                                       <input type="text" id="search_stuNum" placeholder="请输入搜索学号"/>
                                    </div>
                                </div>
                            </div>
                            <!-- row end search -->
                
                <div class="row">
                            <div class="col-sm-12">
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
                                <h3 class="text-center" id="class_question_title">已预约考生信息</h3>
                                    <thead>
                                    <tr role="row">

                                        <?php
                                       
                                        
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'考生学号'.'</th>';
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'考场名称'.'</th>';
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'考试日期'.'</th>';
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'开考时间'.'</th>';
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'结束时间'.'</th>';
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'座位号'.'</th>';
                                       
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'操作'.'</th>';
                                        
                                        ?>                          
                                    </tr>
                                    </thead>
                                    <tbody id="stu_seat_info">
										
                                   
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

<?php $this->beginBlock('footer'); ?>
<script>

$('#search_date').datepicker();

$('#search_date').change("input propertychange",function(){
	var key = $('#search_date').val();	

	// window.location.href = '<?=Url::toRoute('stu-seat/index')?>'+'$'+$date='+key;
    $.get(
            "<?=Url::toRoute('stu-seat/get-student')?>",
            {
                key:key,
            },
            function(res)
            {
                var html = '';
                for(var key in res)
                {
                    html += '<tr id="rowid_'+res[key].AppointmentBh+'">'+                   
                    '<td>'+res[key].StuNumber+'</td>'+
                    '<td>'+res[key].TestRoomname+'</td>'+
                    '<td>'+res[key].TestDate+'</td>'+
                    '<td>'+res[key].beginTime+'</td>'+
                    '<td>'+res[key].EndTime+'</td>'+                   
                    '<td>'+res[key].StuNumber+'</td>'+
                    '<td tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><button type="button" class="btn btn-danger dropdown-toggle class_question_details" data-toggle="dropdown" value="'+res[key].AppointmentBh+'">删除</button></td>' 
                '</tr>';                   
                }

                $('#stu_seat_info').html(html);
            },
            'json'
            )                              
});

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
<?php $this->endBlock(); ?>



