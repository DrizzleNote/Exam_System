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
					<h3 class="box-title">考场预约详情</h3>
					
				</div>
				 
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <!-- row start search-->
                            
                
                <div class="row">
                            <div class="col-sm-12">
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
                                <h3 class="text-center" id="class_question_title">该考场预约者信息</h3>
                                    <thead>
                                    <tr role="row">

                                        <?php
                                       
                                        echo '<th><input id="data_table_check" type="checkbox"></th>';
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'学生学号'.'</th>';
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'学生姓名'.'</th>';
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'班级'.'</th>';
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'预约提交时间'.'</th>';
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'当前状态'.'</th>';
                                       
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'操作'.'</th>';
                                        
                                        ?>                          
                                    </tr>
                                    </thead>
                                    <tbody id="reservation_info">
                                    
                                    <?php
                                    $row = 0;                                
                                    foreach ($info as $model) {
                                        echo '<tr id="rowid_' . $model['AppointmentBh'] . '" class="option_sum">';
                                        echo '  <td><label><input name="checkbox" type="checkbox" value="' . $model['AppointmentBh'] . '"></label></td>';                                                                          
                                        echo '  <td>' . $model['StuNumber']. '</td>';
                                        echo '  <td>' . $model['StuName'] . '</td>';
                                        echo '  <td>' . $model['ClassName'] . '</td>';
                                        echo '  <td>' . $model['SubmitTime'] . '</td>';                                 
                                        echo '  <td>' . $model['CurrentState'] .'</td>';              
                                        echo '  <td class="center">';
                                        echo '      <a id="Details_btn" onclick="DetailsAction(\'' .$model['AppointmentBh'] . '\')" class="btn btn-primary btn-sm" > <i class="glyphicon glyphicon-zoom-in icon-white"></i>预约详情</a>';    
                                        
                                        echo '      <a id="delete_btn_" onclick="deleteAction(\'' . $model['AppointmentBh'] . '\')" class="btn btn-danger btn-sm" href="#"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
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

<div class="modal fade" id="Details_dialog" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>预约详情</h3>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "admin-module-form", "class"=>"form-horizontal", "action"=>Url::toRoute("module/create")]); ?>

               <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">考试日期</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="TestTime" name="Number" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">考试开始时间</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="BeginTime" name="Number" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">考试结束时间</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="EndTime" name="Number" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">学生学号</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="StudentID" name="Number" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">考试考场</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="TestRoomName" name="Number" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">预约提交时间</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="SubmitTime" name="Number" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">当前状态</label>
                     <div class="col-sm-10">
                        <input type="text" style="height: 30px;" class="form-control" id="Status" name="Number" placeholder="无 " />
                    </div>
                    <div class="clearfix"></div>
                </div>

                 <?php ActiveForm::end(); ?>

            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">关闭</a> 
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
// $('#Details_btn').click(function(e){
//         e.preventDefault();

//         DetailsAction('');
//     });

function DetailsAction(id){

        initModel(id,'view','fun');
    }

function initModel(id, type, fun){
        $.ajax({
            type: "GET",
            url: "<?=Url::toRoute('exam-reservation/details')?>",
            data: {"id":id},
            dataType:"JSON",           
            success: function(data){                    
                initEditSystemModule(data, type);
                         
            },
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("出错了1，" + textStatus);
            }
        });
    }

function initEditSystemModule(data, type){
        if(type == 'create'){
            $("#StuName").val('');
            $("#StudentID").val('');
            $("#Memo").val('');
            $("#MachineIP").val('');
            $("#Except").val('');           
        }
       else{
            $("#TestTime").val(data['TestDate']);
            $("#BeginTime").val(data['beginTime']);
            $("#EndTime").val(data['EndTime']);
            $("#StudentID").val(data['StuNumber']);
            $("#TestRoomName").val(data['TestRoomName']);
            $("#SubmitTime").val(data['SubmitTime']);
            $("#Status").val(data['Memo']);
           
        
            $('#edit_dialog_ok').addClass('hidden');
        }
        if(type == "view"){
           $("#TestTime").attr({readonly:true,disabled:true});
            $("#BeginTime").attr({readonly:true,disabled:true});
            $("#EndTime").attr({readonly:true,disabled:true});
            $("#StudentID").attr({readonly:true,disabled:true});
            $("#TestRoomName").attr({readonly:true,disabled:true});
            $("#SubmitTime").attr({readonly:true,disabled:true});
            $("#Status").attr({readonly:true,disabled:true});
           
        }
        else{
            $("#TestTime").attr({readonly:true,disabled:true});
            $("#BeginTime").attr({readonly:true,disabled:true});
            $("#EndTime").attr({readonly:true,disabled:true});
            $("#StudentID").attr({readonly:true,disabled:true});
            $("#TestRoomName").attr({readonly:true,disabled:true});
            $("#SubmitTime").attr({readonly:true,disabled:true});
            $("#Status").attr({readonly:true,disabled:true});      
            $('#edit_dialog_ok').removeClass('hidden');
        }
        $('#Details_dialog').modal('show');
    }

    function deleteAction(id){   
            if(window.confirm("大佬~你确定删除我吗？")) 
            {
                $.ajax({
                    type: "GET",
                    url: "<?=Url::toRoute('exam-reservation/delete')?>",
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


