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
					<h3 class="box-title">考场基本信息</h3>
				</div>

				<div class="box-body">
				
                <!-- 添加按钮<br><br> -->
                <button id="add_exam_room" type="button" class="btn btn-danger">添加考场</button>

                <button id="create_room_btn" type="button" class="btn btn-primary">导&emsp;入</button>
                
                <!-- 已添加状态 -->
				 <div class="col-sm-12">
	                <table id="class_question_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
	                <h3 class="text-center" id="class_question_title">考场列表</h3>
	                    <thead>
	                    <tr role="row">

	                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >考场名称</th>
				            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >座位数</th>
				           
				            
				            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
	                    </tr>
	                    </thead>
	                    <!-- 规则信息列表 -->
	                    <tbody id="class_question_info">
	                    	<?php
                                    $row = 0;                                
                                    foreach ($info as $model) {
                                        echo '<tr id="rowid_' . $model->TestRoomBh . '">';
                                        
                                        echo '  <td>' . $model->TestRoomname. '</td>';
                                        echo '  <td>' . $model->SeatTotal . '</td>';
                                       
                                        echo '  <td class="center">';
                                        echo '      <a id="view_btn" onclick="viewAction(' ."'$model->TestRoomBh'" . ')" class="btn btn-primary btn-sm" > <i class="glyphicon glyphicon-zoom-in icon-white"></i>详情</a>';
                                        echo '      <a id="seat_btn" onclick="seatAction(' ."'$model->TestRoomBh'" . ')" class="btn btn-primary btn-sm" > <i class="glyphicon glyphicon-zoom-in icon-white"></i>座位管理</a>';
                                        echo '      <a id="view_btn" onclick="editAction(' ."'$model->TestRoomBh'" . ')" class="btn btn-primary btn-sm" > <i class="glyphicon glyphicon-zoom-in icon-white"></i>修改</a>';
                                        
                                        echo '      <a id="delete_btn_" onclick="deleteAction(' . "'$model->TestRoomBh'" . ')" class="btn btn-danger btn-sm" href="#"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
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
<div class="modal fade" id="add_room_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>添加新的考场</h3>
            </div>
            <div class="modal-body">
            
        	<form id="form1" role="form">
        	 <div class="row">		
               <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">考场名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="room_name" name="TestRoomname" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>
			</div>
			 <div class="row">
				<div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">起始IP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="begin_IP" name="BeginIP" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
              	</div>
             </div>
              <div class="row">
              	<div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">结束IP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="end_IP" name="EndIP" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
              	</div>
             </div>
             <div class="row">
              	<div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">座位总数</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="Seat_total" name="SeatTotal" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
              	</div>
             </div>
              <div class="row">
				<div class="form-group">
                     <label for="code" class="col-sm-2 control-label">备注</label>
                     <div class="col-xs-10">
                     <textarea class="form-control" rows="3" id="room_remarks" name="Memo"></textarea>
                     </div>
                     <div class="clearfix"></div>
                </div>
              </div>

			</form>			
            <div class="modal-footer">
            	<button id="room-Submit" type="submit" class="btn btn-primary" data-dismiss="modal">提交</button>
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
                <h3>考场详细信息</h3>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "admin-module-form", "class"=>"form-horizontal", "action"=>Url::toRoute("module/create")]); ?>
                <div id="code_div" class="form-group">
                <div class="input-group " >
                    <input type="hidden" class="form-control" id="TestRoomBh" name="Examplan[ExamPlanBh]"/>
                </div>
                </div>
               <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">考场名称</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="TestRoomname" name="Number" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>
				<div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">开始IP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="BeginIP" name="Number" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">结束IP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="EndIP" name="Number" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>               

                <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">座位总数</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="SeatTotal" name="Number" placeholder="必填" />
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
	

    $('#delete_btn').click(function (e) {
        e.preventDefault();
        deleteAction('');
    });

	function viewAction(id){

        initModel(id, 'view', 'fun');
    }
	
	
	function deleteAction(id){ 
        if(window.confirm("           亲(*^__^*)~~     你确定删除我吗？"))                         
            {                         
                $.ajax({
                    type: "GET",
                    url: "<?=Url::toRoute('room-info/delete')?>",
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


	$('#add_exam_room').click(function(){
		$("#add_room_modal").modal('show');		
	});

	function editAction(id){
        initModel(id, 'edit');
    }

    function initModel(id, type, fun){

        $.ajax({
            type: "GET",
            url: "<?=Url::toRoute('room-info/view')?>",
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
            $("#TestRoomBh").val(data['TestRoomBh']);
            $("#TestRoomname").val(data['TestRoomname']);
            $("#BeginIP").val(data['BeginIP']);
            $("#EndIP").val(data['EndIP']);
            $("#SeatTotal").val(data['SeatTotal']);
            $("#Memo").val(data['Memo']);
                      
        }
       else{
            $("#TestRoomBh").val(data['TestRoomBh']);
            $("#TestRoomname").val(data['TestRoomname']);
            $("#BeginIP").val(data['BeginIP']);
            $("#EndIP").val(data['EndIP']);
            $("#SeatTotal").val(data['SeatTotal']);
            $("#Memo").val(data['Memo']);
  
        
            $('#edit_dialog_ok').addClass('hidden');
        }
        if(type == "view"){
            
            $("#TestRoomname").attr({readonly:true,disabled:true});
            $("#BeginIP").attr({readonly:true,disabled:true});
            $("#EndIP").attr({readonly:true,disabled:true});
            $("#SeatTotal").attr({readonly:true,disabled:true});
            $("#Memo").attr({readonly:true,disabled:true});
            
           
        }
        else{
            
            $("#TestRoomname").attr({readonly:false,disabled:false});
            $("#BeginIP").attr({readonly:false,disabled:false});
            $("#EndIP").attr({readonly:false,disabled:false});        
            $("#Memo").attr({readonly:false,disabled:false});
            $("#SeatTotal").attr({readonly:false,disabled:false});
            $('#edit_dialog_ok').removeClass('hidden');
        }
        $('#view_modal').modal('show');
    }

    $('#room-Submit').click(function () {
        var roomName = $('#room_name').val();
        var begin = $('#begin_IP').val();
  
        var end =$('#end_IP').val();
        var SeatTotal =$('#Seat_total').val();
        var content = $('#room_remarks').val();
        //alert(roomName);
        $(this).ajaxSubmit({
            type:'POST',
            url:'<?=Url::toRoute("room-info/add")?>',
            dataType:'JSON',
            data:{
            	'roomName': roomName,
            	'SeatTotal': SeatTotal,
            	'begin': begin,
            	'end': end,
            	'SeatTotal': SeatTotal,
            	'content': content
            },           
            success:function (value) {
                    alert("您已经添加成功！");
                    window.location.href = '<?=Url::toRoute("room-info/index")?>';
                }             
            });        
    	});

    $('#edit_dialog_ok').click(function () {
        var roomBh = $('#TestRoomBh').val();
        var roomName = $('#TestRoomname').val();
        var begin = $('#BeginIP').val();
        var end =$('#EndIP').val();
        var SeatTotal =$('#SeatTotal').val();
        var content = $('#Memo').val();
        //alert(roomName);
        $(this).ajaxSubmit({
            type:'POST',
            url:'<?=Url::toRoute("room-info/edit")?>',
            dataType:'JSON',
            data:{
                'roomBh': roomBh,
                'roomName': roomName,
                'begin': begin,
                'end': end,
                'SeatTotal': SeatTotal,
                'content': content
            },           
            success:function (value) {
                    alert("您已经修改成功！");
                    window.location.href = '<?=Url::toRoute("room-info/index")?>';
                }             
            });        
        });

    function seatAction(id){

    	 window.location.href = '<?=Url::toRoute("room-info/manage")?>'+'&'+'$TestRoomBh='+id;

    }


</script>
<?php $this->endBlock(); ?>

