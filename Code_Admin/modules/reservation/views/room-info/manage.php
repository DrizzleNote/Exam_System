<?php
/* @var $this yii\web\View */
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

?>
<?php
    print_r($data);
?>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">座位管理</h3>                    
                </div>                 
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <!-- row start search-->
                        <button id="add_seat"  onclick="addSeat()" type="button" class="btn btn-danger">添加座位</button>
                        <button id="add_exam_room" type="button" class="btn btn-danger">Excel导入</button>
                        <button id="return_page" type="button" class="btn btn-primary">返回上一页</button>
                        
                
                <div class="row">
                            <div class="col-sm-12">
                                <table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
                                <h3 class="text-center" id="class_question_title">座位列表</h3>
                                    <thead>
                                    <tr role="row">

                                        <?php
                                       
                                        echo '<th><input id="data_table_check" type="checkbox"></th>';
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'座位别名'.'</th>';
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'座位IP'.'</th>';
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'座位MAC'.'</th>';
                                        
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'备注'.'</th>';
                                       
                                        echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'.'操作'.'</th>';
                                        
                                        ?>                          
                                    </tr>
                                    </thead>
                                    <tbody id="reservation_info">
                                    <?php
                                    $row = 0;                                
                                    foreach ($data as $model) {
                                        echo '<tr id="rowid_' . $model['SeatBh'] . '" class="option_sum">';
                                        echo '  <td><label><input name="checkbox" type="checkbox" value="' . $model['SeatBh'] . '"></label></td>'; 
                                         echo '  <td>' . $model['SeatAlias'] . '</td>';                                                            
                                        echo '  <td>' . $model['SeatIP']. '</td>';
                                        echo '  <td>' . $model['SeatMAC'] . '</td>';
                                        echo '  <td>' . $model['Memo'] . '</td>';                                              
                                        echo '  <td class="center">';
                                        echo '      <a id="edit_btn" onclick="editAction(\'' .$model['SeatBh'] . '\')" class="btn btn-primary btn-sm" > <i class="glyphicon glyphicon-zoom-in icon-white"></i>编辑</a>';    
                                        
                                        echo '      <a id="delete_btn_" onclick="deleteAction(\'' .$model['SeatBh'] . '\')"  class="btn btn-danger btn-sm" href="#"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';
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

<!-- 详细信息 -->
<div class="modal fade" id="view_modal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>编辑座位信息</h3>
            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin(["id" => "admin-module-form", "class"=>"form-horizontal", "action"=>Url::toRoute("module/create")]); ?>
                <div id="code_div" class="form-group">
                <div class="input-group " >
                    <input type="hidden" class="form-control" id="SeatBh" name="Examplan[ExamPlanBh]"/>
                </div>
                </div>
               <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">座位名</label>
                    <div class="col-sm-10">
                        <input type="text" title="座位名不允许修改" class="form-control" id="SeatAlias" name="Number" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">IP地址</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="SeatIP" name="Number" placeholder="必填" />
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div id="code_div" class="form-group">
                    <label for="code" class="col-sm-2 control-label">MAC地址</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="SeatMAC" name="Number" placeholder="必填" />
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
                <a id="add_seat_ok" class="btn btn-primary" data-dismiss="modal">确定</a>
                <a id="edit_seat_ok" class="btn btn-primary" data-dismiss="modal">确定</a>
            </div>
        </div>
    </div>

    </div>
</div>

<script>

    $('#return_page').click(function(){
        window.history.go(-1);
    });

    

    function deleteAction(id){  
        if(window.confirm("           亲(*^__^*)~~     你确定删除我吗？"))                          
            {
                 $.ajax({
                    type: "GET",
                    url: "<?=Url::toRoute('room-info/delete1')?>",
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


    function editAction(id){
        $.ajax({
            type: "GET",
            url: "<?=Url::toRoute('room-info/edit-seat')?>",
            data: {"id":id},
            cache: false,
            dataType:"json",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("出错了，" + textStatus);
            },
            success: function(data){
                initEditSystemModule(data, 'edit');             
            }
        });
    }

    // function addSeat(){
        
    //     $.ajax({
    //         type: "GET",
    //         url: "<?=Url::toRoute('room-info/add-seat')?>",
    //         data: {"id":data['TeatRoomBh']},
    //         cache: false,
    //         dataType:"json",
    //         error: function (xmlHttpRequest, textStatus, errorThrown) {
    //             alert("出错了，" + textStatus);
    //         },
    //         success: function(data){
    //             alert(data);
    //             initEditSystemModule(data, 'add');             
    //         }
    //     });
    // }

    function initEditSystemModule(data, type){
        if(type == 'edit'){
            $('#SeatBh').val(data['SeatBh']);
            $("#SeatAlias").val(data['SeatAlias']);
            $("#SeatIP").val(data['SeatIP']);
            $("#SeatMAC").val(data['SeatMAC']);           
            $("#Memo").val(data['Memo']);
            $('#add_seat_ok').addClass('hidden');          
        }
       else{
            
            $("#SeatAlias").val();
            $("#SeatIP").val();
            $("#SeatMAC").val();           
            $("#Memo").val();        
            $('#add_seat_ok').addClass('hidden');
        }
        if(type == "add"){
            
            $("#SeatAlias").attr({readonly:false,disabled:false});
            $("#SeatMAC").attr({readonly:false,disabled:false});
            $("#EndIP").attr({readonly:false,disabled:false});        
            $("#Memo").attr({readonly:false,disabled:false});            
            $('#add_seat_ok').removeClass('hidden');                   
        }
        else{           
            $('#SeatBh').val(data['SeatBh']);
            $("#SeatAlias").attr({readonly:true,disabled:true});
            $("#SeatMAC").attr({readonly:false,disabled:false});
            $("#EndIP").attr({readonly:false,disabled:false});        
            $("#Memo").attr({readonly:false,disabled:false});            
            $('#edit_seat_ok').removeClass('hidden');
        }
        $('#view_modal').modal('show');
    }

    $('#edit_seat_ok').click(function(){
        var SeatBh = $('#SeatBh').val();
        var SeatAlias = $('#SeatAlias').val();
        var SeatIP = $('#SeatIP').val();
        var SeatMAC = $('#SeatMAC').val();
        var Memo = $('#Memo').val();

        $(this).ajaxSubmit({
            type:'POST',
            url:'<?=Url::toRoute("room-info/edit-seat-info")?>',
            dataType:'JSON',
            data:{
                'SeatBh': SeatBh,
                'SeatAlias': SeatAlias,
                'SeatIP': SeatIP,
                'SeatMAC': SeatMAC,
                'Memo': Memo,
              
            },           
            success:function (value) {
                    alert("您已经修改成功！");
                    window.location.reload();
                }             
        });
    });


</script>





