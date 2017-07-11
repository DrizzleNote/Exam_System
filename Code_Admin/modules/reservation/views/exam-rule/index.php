<?php
/* @var $this yii\web\View */
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
?>

<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->


<?php $this->endBlock(); ?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
				<div class="box-header">
					<h3 class="box-title">制定考场规则</h3>
				</div>

				<div class="box-body">
				
                <!-- 添加按钮<br><br> -->
                <button id="add_exam_rule" type="button" class="btn btn-danger">添加</button>
                
                <!-- 已添加状态 -->
				 <div class="col-sm-12">
	                <table id="class_question_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
	                <h3 class="text-center" id="class_question_title">已配置规则信息</h3>
	                    <thead>
	                    <tr role="row">

	                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >规则名称</th>
				            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >开始时间</th>
				            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >结束时间</th>
				            
				            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
	                    </tr>
	                    </thead>
	                    <!-- 规则信息列表 -->
	                    <tbody id="class_question_info">
	                    	<?php
                                    $row = 0;                                
                                    foreach ($info as $model) {
                                        echo '<tr id="rowid_' . $model->TestCustomBh . '">';
                                        
                                        echo '  <td>' . $model->TestCustomName. '</td>';
                                        echo '  <td>' . $model->BeginTime . '</td>';
                                        echo '  <td>' . $model->EndTime . '</td>';
                                        echo '  <td class="center">';
                                        echo '      <a id="view_btn" onclick="viewAction(' ."'$model->TestCustomBh'" . ')" class="btn btn-primary btn-sm" > <i class="glyphicon glyphicon-zoom-in icon-white"></i>详情</a>';
                                        echo '      <a id="view_btn" onclick="editAction(' ."'$model->TestCustomBh'" . ')" class="btn btn-primary btn-sm" > <i class="glyphicon glyphicon-zoom-in icon-white"></i>修改</a>';
                                        
                                        echo '      <a id="delete_btn_" onclick="deleteAction(' . "'$model->TestCustomBh'" . ')" class="btn btn-danger btn-sm" > <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
                                        echo '  </td>';
                                        echo '<tr/>';
                                    }
                                    ?>	                    
	                    </tbody>
	                </table>
                </div>

				 </div>
				 <div class="box-footer">
				 <!-- footer -->
				 </div>
			</div>
		</div>
	</div>
</section>


<!-- 规则添加-->
<div class="modal fade" id="add_rule_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>添加新的规则</h3>
            </div>
            <div class="modal-body">
            
        	<form id="form1" role="form">
        	 <div class="row">		
               <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">规则名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="rule_name" name="TestCustomName" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>
			</div>
			 <div class="row">
				<div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">考试开始时间</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="begin_time" name="BeginTime" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
              	</div>
             </div>
              <div class="row">
              	<div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">考试结束时间</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="end_time" name="EndTime" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
              	</div>
             </div>
              <div class="row">
				<div class="form-group">
                     <label for="code" class="col-sm-2 control-label">备注</label>
                     <div class="col-xs-10">
                     <textarea class="form-control" rows="3" id="rule_Remarks" name="Memo"></textarea>
                     </div>
                     <div class="clearfix"></div>
                </div>
              </div>

			</form>			
            <div class="modal-footer">
            	<button id="rule-Submit" type="submit" class="btn btn-primary" data-dismiss="modal">提交</button>
             	<button  class="btn btn-default" data-dismiss="modal">关闭</button>
            </div>
		
        </div>
    </div>
</div>
</div>
<!-- 详细信息 -->
<div class="modal fade" id="view_modal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>规则详细信息</h3>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "admin-module-form", "class"=>"form-horizontal", "action"=>Url::toRoute("module/create")]); ?>
                <div id="code_div" class="form-group">
                <div class="input-group " >
                    <input type="hidden" class="form-control" id="TestCustomBh" name="Examplan[ExamPlanBh]"/>
                </div>
                </div>
               <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">规则名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="TestCustomName" name="Number" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">开始时间</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="BeginTime" name="Number" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">结束时间</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="EndTime" name="Number" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">备注</label>
                    <div class="col-xs-10">
                     <textarea class="form-control" rows="3" id="Memo" name="Memo"></textarea>
                     </div>
                    <div class="clearfix"></div>
                </div>
                
                 <?php ActiveForm::end(); ?>

            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-dismiss="modal">关闭</a> 
                <a id="edit_dialog_ok" class="btn btn-primary" data-dismiss="modal">确定</a>
            </div>
        </div>
    </div>
</div>

<?php $this->beginBlock('footer');  ?>

<script >
	$('#begin_time').timepicker();
	$('#end_time').timepicker();

    $('#BeginTime').timepicker();
    $('#EndTime').timepicker();

    $('#delete_btn').click(function (e) {
        e.preventDefault();
        deleteAction('');
    });

	function viewAction(id){

        initModel(id, 'view', 'fun');
    }
	
	
	


	$('#add_exam_rule').click(function(){
		$("#add_rule_modal").modal('show');		
	});

	function editAction(id){
        initModel(id, 'edit');
    }

    function initModel(id, type, fun){

        $.ajax({
            type: "GET",
            url: "<?=Url::toRoute('exam-rule/view')?>",
            data: {"id":id},
            cache: false,
            dataType:"json",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("出错了，" + textStatus);
            },
            success: function(data){
                initEditSystemModule(data, type);
            }
        });
    }

    function initEditSystemModule(data, type){
        if(type == 'edit'){
            $("#TestCustomBh").val(data['TestCustomBh']);
            $("#TestCustomName").val(data['TestCustomName']);
            $("#BeginTime").val(data['BeginTime']);
            $("#EndTime").val(data['EndTime']);
            $("#Memo").val(data['Memo']);
                      
        }
       else{
            $("#TestCustomBh").val(data['TestCustomBh']);
            $("#TestCustomName").val(data['TestCustomName']);
            $("#BeginTime").val(data['BeginTime']);
            $("#EndTime").val(data['EndTime']);
            $("#Memo").val(data['Memo']);
  
        
            $('#edit_dialog_ok').addClass('hidden');
        }
        if(type == "view"){
            
            $("#TestCustomName").attr({readonly:true,disabled:true});
            $("#BeginTime").attr({readonly:true,disabled:true});
            $("#EndTime").attr({readonly:true,disabled:true});
            $("#Memo").attr({readonly:true,disabled:true});
            
           
        }
        else{
            
            $("#TestCustomName").attr({readonly:false,disabled:false});
            $("#BeginTime").attr({readonly:false,disabled:false});
            $("#EndTime").attr({readonly:false,disabled:false});        
            $("#Memo").attr({readonly:false,disabled:false});
            
            $('#edit_dialog_ok').removeClass('hidden');
        }
        $('#view_modal').modal('show');
    }

    $('#rule-Submit').click(function () {
        var ruleName = $('#rule_name').val();
        var begin = $('#begin_time').val();
        var end =$('#end_time').val();
        var content = $('#rule_Remarks').val();
        //alert(ruleName);
        $(this).ajaxSubmit({
            type:'POST',
            url:'<?=Url::toRoute("exam-rule/add")?>',
            dataType:'JSON',
            data:{
            	'ruleName': ruleName,
            	'begin': begin,
            	'end': end,
            	'content': content
            },           
            success:function (value) {
                    alert("您已经添加成功！");
                    window.location.href = '<?=Url::toRoute("exam-rule/index")?>';
                }             
            });        
    	});

    $('#edit_dialog_ok').click(function () {
        var ruleBh = $('#TestCustomBh').val();
        var ruleName = $('#TestCustomName').val();
        var begin = $('#BeginTime').val();
        var end =$('#EndTime').val();
        var content = $('#Memo').val();
        //alert(ruleName);
        $(this).ajaxSubmit({
            type:'POST',
            url:'<?=Url::toRoute("exam-rule/edit")?>',
            dataType:'JSON',
            data:{
                'ruleBh': ruleBh,
                'ruleName': ruleName,
                'begin': begin,
                'end': end,
                'content': content
            },           
            success:function (value) {
                    alert("您已经修改成功！");
                    window.location.href = '<?=Url::toRoute("exam-rule/index")?>';
                }             
            });        
        });


     function deleteAction(id) 
    { 
      if(window.confirm("           亲(*^__^*)~~     你确定删除我吗？")) 
      {
           // function deleteAction(id){                           
                $.ajax({
                    type: "GET",
                    url: "<?=Url::toRoute('exam-rule/delete')?>",
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
    // }
      else 
            return false; 
    } 


	
	




</script>
<?php $this->endBlock(); ?>

