<?php
/* @var $this yii\web\View */
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\base\Object;
use yii\helpers\Html;
?>


<?php $this->beginBlock('header');  ?>
<!-- <head></head>中代码块 -->
<link rel="stylesheet" type="text/css" href="<?=Url::base()?>/component/time/jquery.datetimepicker.css"/> 
<?php $this->endBlock(); ?>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
				<div class="box-header">
					<h3 class="box-title">配置开放考场</h3>
				</div>

				<div class="box-body">
				
               
				<div class="panel-group" id="accordion">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" 
								   href="#collapseOne">
									第一步：请选择将要配置考试开放的场地
								</a>							
								
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in">
							<div class="panel-body">
								<?php
									foreach ($info as  $model) {
										 echo '<tr id="rowid_' . $model->TestRoomBh . '" class="option_sum">';
                                            echo '  <td><label><input name="checkbox1" type="checkbox" value="' . $model->TestRoomBh . '"></label></td>';
                                            echo '  <td>' . $model->TestRoomname . '</td>';
                                            echo '  </td>';
                                        echo "<br>";
									}
								?>
								<button type="button" id="submit_one"  class="btn btn-primary btn-lg btn-block">确定</button>
							</div>
						</div>
					</div>
					<div class="panel panel-success">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" 
								   href="#collapseTwo">
									第二步：请选择考试考场开放的日期
								</a>
							</h4>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse">
							<div class="panel-body">
							<br>
								<label for="code" class="col-sm-2 control-label">选择开放日期</label>
							
                        		<input type="text" class="form-control" id="open_date" name="BeginTime" placeholder="必填" />
         		
                        		<br>
                
                    			<button type="button" id="submit_two" class="btn btn-primary btn-lg btn-block">确定</button>
							</div>
						</div>
					</div>
					<div class="panel panel-success">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion" 
								   href="#collapseThree">
									第三步：请选择考场当天开放的时间段
								</a>
							</h4>
						</div>
						<div id="collapseThree" class="panel-collapse collapse">
							<div class="panel-body">
										 <div class="col-sm-12">
	                <table id="class_question_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
	                <h3 class="text-center" id="class_question_title">已配置规则信息</h3>
	                    <thead>
	                    <tr role="row">
							<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ></th>
	                        <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >规则名称</th>
				            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >开始时间</th>
				            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >结束时间</th>          				            
	                    </tr>
	                    </thead>
	                    <!-- 规则信息列表 -->
	                    <tbody id="class_question_info">
	                    	<?php
                                    $row = 0;                                
                                    foreach ($data as $model) {
                                        echo '<tr id="rowid_' . $model->TestCustomBh . '">';
                                       
                                        echo '  <td><label><input name="checkbox3" type="checkbox" value="' . $model->TestCustomBh . '"></label></td>';
                                        echo '  <td>' . $model->TestCustomName. '</td>';
                                        echo '  <td>' . $model->BeginTime . '</td>';
                                        echo '  <td>' . $model->EndTime . '</td>';
                                        echo '  <td class="center">';
                                        
                                    }
                                    ?>	                    
	                    		</tbody>
	                			</table>
                				</div>
                				<button type="button"  id="submit_three" class="btn btn-success btn-lg btn-block">提交开放考场信息</button>
							</div>
						</div>
						
					</div>
				
				</div>				        
	                  
                </div>

				 </div>
				 
			</div>
		</div>
	</div>
</section>



<?php $this->beginBlock('footer');  ?>
<script src="<?=Url::base()?>/component/time/jquery.datetimepicker.full.min.js"></script>
<script>

var gloab_Bh = 0;
	
	$('#open_date').datepicker();

	$(function () { $('#collapseFour').collapse({
        toggle: false
    })});
    $(function () { $('#collapseTwo').collapse('hide')});
    $(function () { $('#collapseThree').collapse('hide')});
    $(function () { $('#collapseOne').collapse('show')});

    $('#submit_one').click(function(){
    	$('#collapseOne').collapse('hide');
    	$('#collapseTwo').collapse('show');
    });

    $('#submit_two').click(function(){
    	$('#collapseOne').collapse('hide');
    	$('#collapseTwo').collapse('hide');
    	$('#collapseThree').collapse('show');
    });

  

   $("#submit_one").click(function(){//输出选中的值  
		var id_array=new Array();  
		$('input[name="checkbox1"]:checked').each(function(){  
	    	id_array.push($(this).val());//向数组中添加元素  
		});  
		var id=id_array.join(',');//将数组元素连接起来以构建一个字符串  
	// alert(idstr);  
		
			$.ajax({
            type: "POST",
            url: "<?=Url::toRoute('room-config/submit-one')?>",
            data: {"id":id},
            cache: false,
            dataType:"json",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("出错了1，" + textStatus);
            },
            success: function(data){      
               gloab_Bh = data;                            
              
            }          
        });
		
	});  

   $("#submit_two").click(function(){//输出选中的值  
		var open_date = $('#open_date').val();
	// alert(idstr);  
		
			$.ajax({
            type: "POST",
            url: "<?=Url::toRoute('room-config/submit-two')?>",
            data: {"id":open_date ,
            	   "gloab_Bh":gloab_Bh
        	},
            cache: false,
            dataType:"json",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("出错了1，" + textStatus);
            },
            success: function(data){      
                                          
              
            }          
        });
		
	});  


   $("#submit_three").click(function(){//输出选中的值  
		var id_array=new Array();  
		$('input[name="checkbox3"]:checked').each(function(){  
	    	id_array.push($(this).val());//向数组中添加元素  
		});  
		var id=id_array.join(',');//将数组元素连接起来以构建一个字符串  
	// alert(idstr);  
		
			$.ajax({
            type: "POST",
            url: "<?=Url::toRoute('room-config/submit-three')?>",
            data: {"id":id ,
            		"gloab_Bh":gloab_Bh
        		},
            cache: false,
            dataType:"json",
            error: function (xmlHttpRequest, textStatus, errorThrown) {
                alert("出错了1，" + textStatus);
            },
            success: function(data){      
               gloab_Bh = 0;                            
               alert("考场配置成功啦！");
                window.location.reload();
            }          
        });
		
	});  
 
 	

</script>  



<?php $this->endBlock(); ?>
