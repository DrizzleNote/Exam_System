<?php
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\commonFuc;
$com = new commonFuc();
$m_know = new \app\models\question\Knowledgepoint();
?>

<?php $this->beginBlock('header');  ?>
    <!-- <head></head>中代码块 -->
    <link rel="stylesheet" href="<?=Url::base()?>/plugins/codeEditor/lib/codemirror.css">
    <script src="<?=Url::base()?>/plugins/codeEditor/lib/codemirror.js"></script>
    <script src="<?=Url::base()?>/plugins/codeEditor/code/clike.js"></script>

    <!--括号匹配-->
    <script src="<?=Url::base()?>/plugins/codeEditor/addon/edit/matchbrackets.js"></script>
    <!--引入css文件，用以支持主题-->
    <link rel="stylesheet" href="<?=Url::base()?>/plugins/codeEditor/theme/pastel-on-dark.css">
    <link rel="stylesheet" href="<?=Url::base()?>/plugins/codeEditor/theme/night.css">
    <link rel="stylesheet" href="<?=Url::base()?>/plugins/codeEditor/theme/the-matrix.css">
    <link rel="stylesheet" href="<?=Url::base()?>/plugins/codeEditor/theme/xq-dark.css">
    <link rel="stylesheet" href="<?=Url::base()?>/plugins/codeEditor/theme/panda-syntax.css">
    <link rel="stylesheet" href="<?=Url::base()?>/plugins/codeEditor/theme/monokai.css">
    <link rel="stylesheet" href="<?=Url::base()?>/plugins/codeEditor/theme/colorforth.css">
    <link rel="stylesheet" href="<?=Url::base()?>/plugins/codeEditor/theme/eclipse.css">

    <link rel="stylesheet" href="<?=Url::base()?>/plugins/codeEditor/theme/duotone-light.css">
<?php $this->endBlock(); ?>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <div class="box-header">
                        <h3 class="box-title">编程题列表</h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <button id="create_btn" type="button" class="btn btn-xs btn-primary">添&nbsp;&emsp;加</button>
                                |
                                <button id="delete_btn" type="button" class="btn btn-xs btn-danger">批量删除</button>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                            <!-- row start search-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <select class="form-control" id="stage-choice">
                                        <?php if(isset($stageChoice['stage'])){?>
                                            <?php foreach ($stage as $model){?>
                                                <?php if($model->CuitMoon_DictionaryCode == $stageChoice['stage']){?>
                                                    <option value="<?=$model->CuitMoon_DictionaryCode?>" selected="selected"><?=$model->CuitMoon_DictionaryName?></option>
                                                <?php }else{?>
                                                    <option value="<?=$model->CuitMoon_DictionaryCode?>" ><?=$model->CuitMoon_DictionaryName?></option>
                                                <?php }?>
                                            <?php }?>
                                        <?php }else{?>
                                            <option>全部阶段</option>
                                            <?php foreach ($stage as $model){?>
                                                <option value="<?=$model->CuitMoon_DictionaryCode?>" ><?=$model->CuitMoon_DictionaryName?></option>
                                            <?php }}?>
                                        >
                                    </select>
                                    <div class="input-group">
                                       <span class="input-group-addon">搜索：</span>
                                       <input type="text" id="search" placeholder="支持题编号，名字"/>
                                    </div>
                                </div>
                            </div>
                            <!-- row end search -->

                            <!-- row start -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="data_table" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
                                        <thead>
                                        <tr role="row">

                                            <?php
                                            echo '<th><input id="data_table_check" type="checkbox"></th>';
                                            echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >自定义题号</th>';
                                            echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >题目名称</th>';
                                            echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >知识点</th>';
                                            echo '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >所属阶段</th>';
                                            ?>

                                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
                                        </tr>
                                        </thead>
                                        <tbody id="program_info">
                                        <?php
                                        foreach ($list as $model) {
                                            echo '<tr id="rowid_' . $model->QuestionBh. '">';
                                            echo '  <td><label><input type="checkbox" value="' . $model->QuestionBh . '"></label></td>';
                                            echo '  <td>' . $model->CustomBh . '</td>';
                                            echo '  <td>' . $model->name . '</td>';
                                            echo '  <td>' . $m_know->idTranName($model->KnowledgeBh). '</td>';
                                            echo '  <td>' . $com->codeTranName($model->Stage) . '</td>';
                                            echo '  <td class="center">';
                                            echo '      <button id="view_btn" onclick="viewAction(\''. $model->QuestionBh . '\')" class="btn btn-primary btn-sm" > <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</button>';
                                            echo '      <a id="edit_btn" onclick="editAction(\'' . $model->QuestionBh . '\')" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>';
                                            echo $model->Score ? '      <a onclick="IsSee(\'' . $model->QuestionBh. '\',this)" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-ok-circle icon-white"></i>已公开</a>' : '      <a onclick="IsSee(\'' . $model->QuestionBh. '\',this)" class="btn btn-danger btn-sm" > <i class="glyphicon glyphicon glyphicon-ban-circle icon-white"></i>公开</a>';
                                            echo $model->Checked=='100001' ? '      <a onclick="Checked(\'' . $model->QuestionBh. '\',this)" class="btn btn-primary btn-sm" > <i class="glyphicon glyphicon-ok-circle icon-white"></i>已审核</a>' : '      <a onclick="Checked(\'' . $model->QuestionBh. '\',this)" class="btn btn-danger btn-sm" > <i class="glyphicon glyphicon glyphicon-ban-circle icon-white"></i>审核</a>';
                                            echo '      <a onclick="updateTestAll(\'' . $model->QuestionBh. '\')" class="btn btn-primary btn-sm">更新测试用例</a>';
                                            echo '      <a onclick="deleteAction(\'' . $model->QuestionBh. '\')" class="btn btn-danger btn-sm"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a>';

                                            echo '  </td>';
                                            echo '</tr>';
                                        }
                                        ?>



                                        </tbody>
                                        <!-- <tfoot></tfoot> -->
                                    </table>
                                </div>
                            </div>
                            <!-- row start -->
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="dataTables_info" id="data_table_info" role="status" aria-live="polite">
                                        <div class="infos">
                                            从<?= $pages->getPage() * $pages->getPageSize() + 1 ?>            		到 <?= ($pageCount = ($pages->getPage() + 1) * $pages->getPageSize()) < $pages->totalCount ?  $pageCount : $pages->totalCount?>            		 共 <?= $pages->totalCount?> 条记录</div>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="data_table_paginate">
                                        <?= LinkPager::widget([
                                            'pagination' => $pages,
                                            'nextPageLabel' => '»',
                                            'prevPageLabel' => '«',
                                            'firstPageLabel' => '首页',
                                            'lastPageLabel' => '尾页',
                                        ]); ?>

                                    </div>
                                </div>
                            </div>
                            <!-- row end -->
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
<!-- 查看编程题-->
<div class="modal fade" id="option_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="box-title" id="option_title"></h3>
            </div>
            <div class="modal-body ">


                <div class="input-group" >
                    <input type="hidden" class="form-control option_input " id="QuestionBh" name="Questions[QuestionBh]"/>
                </div>
                <div class="input-group" >
                    <span class="input-group-addon">自定义题号</span>
                    <input type="text" class="form-control option_input" id="CustomBh" name="Questions[CustomBh]">
                </div>
                <br>
                <div class="input-group" >
                    <span class="input-group-addon">&nbsp;所&nbsp;属&nbsp;阶&nbsp;段&nbsp;</span>
                    <input type="text" class="form-control option_input" id="Stage" name="Questions[Stage]">
                </div>
                <br>
                <div class="input-group" >
                    <span class="input-group-addon">&nbsp;&nbsp;知&nbsp;&nbsp;&nbsp;识&nbsp;&nbsp;&nbsp;点&nbsp;&nbsp;</span>
                    <input type="text" class="form-control option_input" id="KnowledgeBh" name="Questions[KnowledgeBh]">
                </div>
                <br>
                <div class="input-group" >
                    <span class="input-group-addon">&nbsp;题&nbsp;目&nbsp;难&nbsp;度&nbsp;</span>
                    <input type="text" class="form-control option_input" id="Difficulty" name="Questions[Difficulty]"  >
                </div>
                <br>
                <div class="input-group" >
                    <span class="input-group-addon">文件操作方式</span>
                    <input type="text" class="form-control option_input" id="Way" name="Questions[Way]"  >
                </div>
                <br>

                <span class="input-group-addon">题目描述</span>
                <div class="input-group " >

                    <script type="text/plain" id="Description" name="Questions[Description]" style="width:100%"></script>
                </div>
                <br>
                <div class="input-group " >
                    <span class="input-group-addon">文件路径</span>
                    <input type="text" class="form-control option_input" id="url" name="url">
                </div>
                <br>

                <span class="input-group-addon">测试用例</span>
                <div class="input-group col-sm-12" >
                    <table id="test_case_tb" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
                        <thead>
                        <tr role="row">

                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >输入</th>
                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >输出</th>
                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >分数百分比</th>
                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >错误描述</th>
                        </tr>
                        </thead>
                        <!-- 点到信息列表 -->
                        <tbody id="test_case_info">


                        </tbody>
                    </table>
                </div>
                <br>
                <div class="input-group " >
                    <span class="input-group-addon">备注</span>
                    <input type="text" class="form-control option_input" id="Memo" name="Memo"  >
                </div>
                <br>

            </div>
        </div>
    </div>
</div>

<!-- 修改编程题 -->
<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="box-title" id="update_title">修改编程题信息</h3>
            </div>
            <div class="modal-body ">

                <form id="update_form" action="<?=Url::toRoute('program/update-program')?>" method="post">
                <div class="input-group " >
                    <input type="hidden" class="form-control" id="update_QuestionBh" name="QuestionBh"/>
                </div>
                <div class="input-group  col-sm-5" style="float: left;" >
                    <span class="input-group-addon">自定义题号</span>
                        <input type="text" class="form-control" id="update_CustomBh" name="CustomBh">
                </div>
                <div class="input-group  col-sm-2" style="float: left;" ><br></div>
                <!-- <br> -->
                <div class="input-group  col-sm-5" style="float: left;" >
                    <span class="input-group-addon">&nbsp;所&nbsp;属&nbsp;阶&nbsp;段&nbsp;</span>
                    <select class="form-control" id="update_StageCode" value="0" name="Stage">

                        <?php foreach ($stage as $model){?>
                            <option value="<?=$model->CuitMoon_DictionaryCode?>" ><?=$model->CuitMoon_DictionaryName?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="input-group col-sm-5" style="float: left;"  >
                    <span class="input-group-addon">&nbsp;&nbsp;知&nbsp;&nbsp;&nbsp;识&nbsp;&nbsp;&nbsp;点&nbsp;&nbsp;</span>
                    <select class="form-control" id="update_KnowledgeBhCode" value="0" name="KnowledgeBh">

                    </select>
                </div>
                <div class="input-group  col-sm-2" style="float: left;" ><br></div>
                <!-- <br> -->
                <div class="input-group col-sm-5" style="float: left;"  >
                    <span class="input-group-addon">&nbsp;是&nbsp;否&nbsp;公&nbsp;开&nbsp;</span>
                    <select class="form-control" id="update_IsSee" value="0" name="Score">
                    <!-- name="IsSee" -->
                        <option value="1">是</option>
                        <option value="0">否</option>
                    </select>
                </div>
                <div class="clearfix"></div>
                <br>

                <div class="input-group col-sm-5" style="float: left;" >
                    <span class="input-group-addon">是否是文件题</span>
                    <!-- name="IsFile" -->
                    <select class="form-control" id="update_IsFile" value="0" >
                        <option value="0">否</option>
                        <option value="1">是</option>

                    </select>
                </div>
                <div class="input-group  col-sm-2" style="float: left;" ><br></div>
                <!-- <br> -->
                <div class="input-group  col-sm-5" style="float: left;">
                    <span class="input-group-addon">是否程序填空题</span>
                    <select class="form-control" id="update_IsProgramBlank" value="0" name="IsProgramBlank">
                        <option value="0">否</option>
                        <option value="1">是</option>

                    </select>
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="input-group col-sm-5" style="float: left;" >
                    <span class="input-group-addon">&nbsp;题&nbsp;目&nbsp;难&nbsp;度&nbsp;</span>
                    <select class="form-control" id="update_DifficultyCode" value="0" name="Difficulty">
                    </select>
                </div>
                <!-- <br> -->
                <div class="input-group  col-sm-2" style="float: left;" ><br></div>
                <div class="input-group col-sm-5" style="float: left;">
                    <span class="input-group-addon">&nbsp;题&nbsp;目&nbsp;名&nbsp;称&nbsp;</span>
                    <textarea class="form-control" id="update_name" name="name"></textarea>
                </div>
                <div class="clearfix"></div>
                <br>

                <div class="input-group  col-sm-5" style="float: left;" id="StartDiv">

                </div>
                <div class="input-group  col-sm-2" style="float: left;" ><br></div>
                <!-- <br> -->
                <div class="input-group  col-sm-5" style="float: left;" id="EndDiv">

                </div>
                <div class="clearfix"></div>
                <br>


                <span class="input-group-addon">题目描述</span>
                <div class="input-group " >

                    <script type="text/plain" id="update_Description" name="Description" style="width:100%"></script>
                </div>
                <br>
                <div class="input-group " >
                    <span class="input-group-addon">代码</span>
                    <textarea class="form-control" id="update_SourceCode" rows="15" name="SourceCode"></textarea>
                </div>
                <br>
                <span class="input-group-addon">测试用例添加</span>
                <div class="input-group col-sm-5" style="float: left;">
                    <span class="input-group-addon">输入</span>
                    <textarea class="form-control" id="update_Input" rows="7"></textarea>
                </div>
                <!-- <br>  -->
                <div class="input-group col-sm-2" style="float: left;height: 20px;">
                <br><br><br>
                    <p style="text-align: center;"><button type="button" class="btn btn-info" id="getOutput">获取输出</button></p>
                </div>
                <!-- <br>  -->
                <div class="input-group col-sm-5" style="float: left;">
                    <span class="input-group-addon">输出</span>
                    <textarea class="form-control" id="update_Output" rows="7" placeholder="当手动添加输出数据时，换行\r\n请以代替" ></textarea>
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="input-group col-sm-5" style="float: left;">
                    <span class="input-group-addon">分值</span>
                    <input type="text" class="form-control" id="update_ScoreWeight" >
                </div>
                <div class="input-group col-sm-2" style="float: left;">
                    <!-- <span class="input-group-addon">分值</span> -->
                    <p style="text-align: center;"><button type="button" class="btn btn-info" id="addTest">加入测试用例</button></p>
                </div>
                <div class="clearfix"></div>
                <br>

                <span class="input-group-addon">测试用例</span>
                <div class="input-group col-sm-12" >
                    <table id="update_test_case_tb" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
                        <thead>
                        <tr role="row">

                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >输入</th>
                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >输出</th>
                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >分数百分比</th>
                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >错误描述</th>
                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
                        </tr>
                        </thead>
                        <!-- 点到信息列表 -->
                        <tbody id="update_test_case_info">


                        </tbody>
                    </table>
                </div>
                <br>
                <div class="input-group " >
                    <span class="input-group-addon">备注</span>
                    <textarea class="form-control" id="update_Memo" name="Memo"  rows="7"></textarea>
                </div>
                <br>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="save_update">保存</button>
            </div>
        </div>
    </div>
</div>



<!-- 新增编程题 -->
<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:60%;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="box-title" id="add_title">新增编程题信息</h3>
            </div>
            <div class="modal-body ">

                <form id="add_form" action="<?=Url::toRoute('program/add')?>" method="post">
                <div class="input-group " >
                    <input type="hidden" class="form-control" id="add_QuestionBh" name="QuestionBh"/>
                </div>
                <div class="input-group  col-sm-5" style="float: left;" >
                    <span class="input-group-addon">自定义题号</span>
                        <input type="text" class="form-control" id="add_CustomBh" name="CustomBh">
                </div>
                <div class="input-group  col-sm-2" style="float: left;" ><br></div>
                <!-- <br> -->
                <div class="input-group  col-sm-5" style="float: left;" >
                    <span class="input-group-addon">&nbsp;所&nbsp;属&nbsp;阶&nbsp;段&nbsp;</span>
                    <select class="form-control" id="add_StageCode" value="0" name="Stage">

                        <?php foreach ($stage as $model){?>
                            <option value="<?=$model->CuitMoon_DictionaryCode?>" ><?=$model->CuitMoon_DictionaryName?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="input-group col-sm-5" style="float: left;"  >
                    <span class="input-group-addon">&nbsp;&nbsp;知&nbsp;&nbsp;&nbsp;识&nbsp;&nbsp;&nbsp;点&nbsp;&nbsp;</span>
                    <select class="form-control" id="add_KnowledgeBhCode" value="0" name="KnowledgeBh">

                    </select>
                </div>
                <div class="input-group  col-sm-2" style="float: left;" ><br></div>
                <!-- <br> -->
                <div class="input-group col-sm-5" style="float: left;"  >
                    <span class="input-group-addon">&nbsp;是&nbsp;否&nbsp;公&nbsp;开&nbsp;</span>
                    <select class="form-control" id="add_IsSee" value="0" name="Score" >
                    <!-- name="IsSee" -->
                        <option value="1">是</option>
                        <option value="0">否</option>
                    </select>
                </div>
                <div class="clearfix"></div>
                <br>

                <div class="input-group col-sm-5" style="float: left;" >
                    <span class="input-group-addon">是否是文件题</span>
                    <!-- name="IsFile" -->
                    <select class="form-control" id="add_IsFile" value="0" >
                        <option value="0">否</option>
                        <option value="1">是</option>

                    </select>
                </div>
                <div class="input-group  col-sm-2" style="float: left;" ><br></div>
                <!-- <br> -->
                <div class="input-group  col-sm-5" style="float: left;">
                    <span class="input-group-addon">是否程序填空题</span>
                    <select class="form-control" id="add_IsProgramBlank" value="0" name="IsProgramBlank">
                        <option value="0">否</option>
                        <option value="1">是</option>

                    </select>
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="input-group col-sm-5" style="float: left;" >
                    <span class="input-group-addon">&nbsp;题&nbsp;目&nbsp;难&nbsp;度&nbsp;</span>
                    <select class="form-control" id="add_DifficultyCode" value="0" name="Difficulty">
                    </select>
                </div>
                <!-- <br> -->
                <div class="input-group  col-sm-2" style="float: left;" ><br></div>
                <div class="input-group col-sm-5" style="float: left;">
                    <span class="input-group-addon">&nbsp;题&nbsp;目&nbsp;名&nbsp;称&nbsp;</span>
                    <textarea class="form-control" id="add_name" name="name"></textarea>
                </div>
                <div class="clearfix"></div>
                <br>

                <div class="input-group  col-sm-5" style="float: left;" id="add_StartDiv">

                </div>
                <div class="input-group  col-sm-2" style="float: left;" ><br></div>
                <!-- <br> -->
                <div class="input-group  col-sm-5" style="float: left;" id="add_EndDiv">

                </div>
                <div class="clearfix"></div>
                <br>


                <span class="input-group-addon">题目描述</span>
                <div class="input-group " >

                    <script type="text/plain" id="add_Description" name="Description" style="width:100%"></script>
                </div>
                <br>
                <div class="input-group " >
                    <span class="input-group-addon">代码</span>
                    <textarea class="form-control" id="add_SourceCode" rows="15" name="SourceCode"></textarea>
                </div>
                <br>
                <span class="input-group-addon">测试用例添加</span>
                <div class="input-group col-sm-5" style="float: left;">
                    <span class="input-group-addon">输入</span>
                    <textarea class="form-control" id="add_Input" rows="7"></textarea>
                </div>
                <!-- <br>  -->
                <div class="input-group col-sm-2" style="float: left;height: 20px;">
                <br><br><br>
                    <p style="text-align: center;"><button type="button" class="btn btn-info" id="add_Get_Output">获取输出</button></p>
                </div>
                <!-- <br>  -->
                <div class="input-group col-sm-5" style="float: left;">
                    <span class="input-group-addon">输出</span>
                    <textarea class="form-control" id="add_Output" rows="7" placeholder="当手动添加输出数据时，换行\r\n请以代替" ></textarea>
                </div>
                <div class="clearfix"></div>
                <br>
                <div class="input-group col-sm-5" style="float: left;">
                    <span class="input-group-addon">分值</span>
                    <input type="text" class="form-control" id="add_ScoreWeight" >
                </div>
                <div class="input-group col-sm-2" style="float: left;">
                    <!-- <span class="input-group-addon">分值</span> -->
                    <p style="text-align: center;"><button type="button" class="btn btn-info" id="add_Test">加入测试用例</button></p>
                </div>
                <div class="clearfix"></div>
                <br>

                <span class="input-group-addon">测试用例</span>
                <div class="input-group col-sm-12" >
                    <table id="add_test_case_tb" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="data_table_info">
                        <thead>
                        <tr role="row">

                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >输入</th>
                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >输出</th>
                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >分数百分比</th>
                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >错误描述</th>
                            <th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >操作</th>
                        </tr>
                        </thead>
                        <!-- 点到信息列表 -->
                        <tbody id="add_test_case_info">


                        </tbody>
                    </table>
                </div>
                <br>
                <div class="input-group " >
                    <span class="input-group-addon">备注</span>
                    <textarea class="form-control" id="add_Memo" name="Memo"  rows="7"></textarea>
                </div>
                <br>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="add_save_update">添加</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?=Url::base()?>/component/editor/ueditor.config.js"></script>
<script type="text/javascript" src="<?=Url::base()?>/component/editor/ueditor.all.min.js"></script>
<script type="text/javascript">
    //ueditor编辑器
    var editor=CodeMirror.fromTextArea(document.getElementById("update_SourceCode"),{
        indentUnit:4,
        smartIndent:true,
    	  // fullScreen:true,
        mode:"text/x-c",
        // lineNumbers:true,
        theme:"pastel-on-dark",
        matchBrackets:true,
        extraKeys:{
        "Ctrl-B":function(){run();},
        "Ctrl-S":function () {

                  }

    }

    });
    var global_ue_add = UE.getEditor('add_Description');
    var global_ue_update = UE.getEditor('update_Description');
    UE.getEditor('Description');
    var global_i = 0;
    // UE.getEditor('update_Description').execCommand('source');
</script>
<?php $this->beginBlock('footer');  ?>
    <!-- <body></body>后代码块 -->



    <script>
    $("#search").on("input propertychange",function(){
        var key = $(this).val();
        $('#data_table_info').parent().parent().empty();
        $.post(
            "<?=Url::toRoute('program/search-program')?>",
            {
                key:key,
            },
            function(res)
            {
                var html = '';
                for(var key in res)
                {
                    html += '<tr id="rowid_'+res[key].QuestionBh+'">'+
                    '<td><label><input type="checkbox" value="'+res[key].QuestionBh+'"></label></td>'+
                    '<td>'+res[key].CustomBh+'</td>'+
                    '<td>'+res[key].name+'</td>'+
                    '<td>'+res[key].KnowledgeBh+'</td>'+
                    '<td>'+res[key].Stage+'</td>'+
                    '<td class="center"><button id="view_btn" onclick="viewAction(\''+res[key].QuestionBh+'\')" class="btn btn-primary btn-sm" > <i class="glyphicon glyphicon-zoom-in icon-white"></i>查看</button>'+
                    '<a id="edit_btn" onclick="editAction(\''+res[key].QuestionBh+'\')" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-edit icon-white"></i>修改</a>';
                    html += res[key].Score=='1' ? '<a onclick="IsSee(\''+res[key].QuestionBh+'\',this)" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-ok-circle icon-white"></i>已公开</a>' : '<a onclick="IsSee(\''+res[key].QuestionBh+'\',this)" class="btn btn-danger btn-sm" > <i class="glyphicon glyphicon glyphicon-ban-circle icon-white"></i>公开</a>';
                    html += res[key].Checked=='100001' ? '<a onclick="Checked(\''+res[key].QuestionBh+'\',this)" class="btn btn-primary btn-sm" > <i class="glyphicon glyphicon-ok-circle icon-white"></i>已审核</a>' : '<a onclick="Checked(\''+res[key].QuestionBh+'\',this)" class="btn btn-danger btn-sm" > <i class="glyphicon glyphicon glyphicon-ban-circle icon-white"></i>审核</a>';
                    html += '<a onclick="deleteAction(\''+res[key].QuestionBh+'\')" class="btn btn-danger btn-sm"> <i class="glyphicon glyphicon-trash icon-white"></i>删除</a></td></tr>';
                }
                $('#program_info').html(html);
            },
            'json'
            )
    })


        function updateTestAll(ID)

        {
            $.post(
                "<?=Url::toRoute('program/update-test')?>",
                {
                    QuestionBh:ID
                },
                function(res){
                    alert(res);
                }
                )
        }
        //根据阶段获取知识点，并且更新编辑编程题的数据
        function getKnowledge(stageId)
        {
            $.ajax({
                type:'GET',
                url:'<?=Url::toRoute('knowledge/knowledge-list')?>',
                data:{stageId:stageId},
                catch:false,
                async : false,
                dataType:'json',
                success:function (value) {
                    var html = '';
                    for(var Tmp in value){
                        html += '<option value="'+ value[Tmp]['KnowledgeBh'] + '">'+ value[Tmp]['KnowledgeName']+'</option>';
                    }
                    $('#update_KnowledgeBhCode').html(html);
                    $('#add_KnowledgeBhCode').html(html);

                }
            });
        }
        //获取困难等级
        function getDiff()
        {
            $.post(
                "<?=Url::toRoute('program/get-diff')?>",
                {},
                function(res){
                    var html = '';
                    for(var key in res)
                        html += '<option value="'+ res[key].CuitMoon_DictionaryCode + '">'+ res[key].CuitMoon_DictionaryName+'</option>';
                    $('#update_DifficultyCode').html(html);
                    $('#add_DifficultyCode').html(html);
                },
                "json"
                );
        }
        //更新test_case
        function updateTest(QuestionBh)
        {
            $.post(
                "<?=Url::toRoute('program/get-test-case')?>",
                {
                    QuestionBh:QuestionBh,
                },
                function(res){
                    var html = '';
                    $('#update_test_case_info').empty();
                    for(var key in res)
                    {
                        html += '<tr role="row">'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><textarea>'+res[key].TestCaseInput+'</textarea></th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><textarea>'+res[key].TestCaseOutput+'</textarea></th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'+res[key].ScoreWeight+'</th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'+res[key].Memo+'</th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><button type="button" class="btn btn-danger delete_one_test"  value="'+res[key].TestCaseBh+'">删除</button></th>'+
                        '</tr>';
                    }
                    $('#update_test_case_info').html(html);
                },
                'json'
                );
        }
        //根据输入获取代码输出结果（新增编程题）
        $('#add_Get_Output').click(function () {
            $.ajax({
                type:'POST',
                url:'<?=Url::toRoute("program/get-case")?>',
                dataTpe:'json',
                data:{input_text:$('#add_Input').val(),code:$('#add_SourceCode').val()},
                success:function (value) {
                    $('#add_Output').val(value);
                }
            })
        })
        //添加测试用例
        $('#add_Test').click(function(){
            // var QuestionBh = $('#add_QuestionBh').val();
            var ScoreWeight = $('#add_ScoreWeight').val();
            var Input = $('#add_Input').val();
            var Output = $('#add_Output').val();
            if(ScoreWeight== '' || (ScoreWeight*1 != ScoreWeight))
                alert('分数不能为空,且必须为数字');
            else
            {
                global_i++;
                var html =  '<tr role="row">'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><input type="text" class="form-control" name="test[test'+global_i+'][Input]" value="'+Input+'"/></th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><input type="text" class="form-control" name="test[test'+global_i+'][Output]" value="'+Output+'"/></th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><input type="text" class="form-control" name="test[test'+global_i+'][ScoreWeight]" value="'+ScoreWeight+'"/></th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><input type="text" class="form-control" name="test[test'+global_i+'][Memo]" value=""/></th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><button type="button" class="btn btn-danger delete_add_one_test">删除</button></th>'+
                        '</tr>';
                $("#add_test_case_info").append(html);
            }
        })
        //添加编程题更新test_case（修改编程题）
        function addUpdateTest(QuestionBh)
        {
            $.post(
                "<?=Url::toRoute('program/get-test-case')?>",
                {
                    QuestionBh:QuestionBh,
                },
                function(res){
                    var html = '';
                    $('#update_test_case_info').empty();
                    for(var key in res)
                    {
                        html += '<tr role="row">'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><textarea>'+res[key].TestCaseInput+'</textarea></th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><textarea>'+res[key].TestCaseOutput+'</textarea></th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'+res[key].ScoreWeight+'</th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'+res[key].Memo+'</th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><button type="button" class="btn btn-danger delete_one_test"  value="'+res[key].TestCaseBh+'">删除</button></th>'+
                        '</tr>';
                    }
                    $('#update_test_case_info').html(html);
                },
                'json'
                );
        }
        function IsSee(id,me)
        {
            // var me = $(this);
            // alert($(me).html());
            $.post(
                "<?=Url::toRoute('program/change-see')?>",
                {
                    QuestionBh:id,
                },
                function(res){
                    if(res == '1')
                    {
                        $(me).attr('class','btn btn-primary  btn-sm');

                        $(me).html('<i class="glyphicon glyphicon-ok-circle icon-white"></i>已公开');
                    }
                    else
                    {
                        $(me).attr('class','btn btn-danger btn-sm');
                        $(me).html('<i class="glyphicon glyphicon glyphicon-ban-circle icon-white"></i>公开');
                    }
                },'text')
        }
        function Checked(id,me)
        {
            $.post(
                "<?=Url::toRoute('program/change-checked')?>",
                {
                    QuestionBh:id,
                },
                function(res){
                    if(res == '100001')
                    {
                        $(me).attr('class','btn btn-primary  btn-sm');

                        $(me).html('<i class="glyphicon glyphicon-ok-circle icon-white"></i>已审核');
                    }
                    else
                    {
                        $(me).attr('class','btn btn-danger btn-sm');
                        $(me).html('<i class="glyphicon glyphicon glyphicon-ban-circle icon-white"></i>审核');
                    }
                },'text')
        }
        $(document).on('click','.delete_add_one_test',function(){
            global_i--;
            $(this).parent().parent().empty();
        })
        //阶段选择
        $('#stage-choice').change(function () {
            var Tmp = $(this).val();
            window.location.href = '<?=Url::toRoute('program/index')?>'+'&stage='+Tmp;
        })
        //修改保存
        $("#save_update").click(function(){
            $("#update_form").ajaxSubmit(function(res){
                window.location.reload();
                alert(res);
            })
        })
        //信息保存
        $('#add_save_update').click(function(){
            $("#add_form").ajaxSubmit(function(res){
                // window.location.reload();
                alert(res);
            })
        })
        //异步请求阶段知识点
        $('#stageChoice').change(function () {
            var stageId = $(this).val();
            $.ajax({
                type:'GET',
                url:'<?=Url::toRoute('knowledge/knowledge-list')?>',
                data:{stageId:stageId},
                catch:false,
                dataType:'json',
                success:function (value) {
                    $('#knowledgeChoice').empty();
                    for(var Tmp in value){
                        $('#knowledgeChoice').append("<option value='"+ value[Tmp]['KnowledgeBh'] +"'>"+ value[Tmp]['KnowledgeName'] +"</option>");
                    }

                }
            })
        })



        //查看编程题
        function viewAction(id){
            $("#option_modal").modal('show');
            UE.getEditor('Description').setDisabled();
            $('.option_input').attr('disabled','ture');
            $.post(
                "<?=Url::toRoute('program/get-program')?>",
                {
                    QuestionBh:id,
                },
                function(res){

                    $('#option_modal').children('.modal-dialog').attr('style','width:50%;');
                    for(var key in res)
                    {
                        $('#'+key).val(res[key]);
                    }
                    $('#test_case_info').empty();

                    var html = '';
                    for(var key in res.TestCase)
                    {
                        html += '<tr role="row">'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'+res.TestCase[key].TestCaseInput+'</th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'+res.TestCase[key].TestCaseOutput+'</th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'+res.TestCase[key].ScoreWeight+'</th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'+res.TestCase[key].Memo+'</th></tr>';

                    }
                    $('#test_case_info').html(html);
                    UE.getEditor('Description').setContent(res.Description);

                },
                'json'
                );
        }




        //添加测试用例
        $('#addTest').click(function(){
            var QuestionBh = $('#update_QuestionBh').val();
            var ScoreWeight = $('#update_ScoreWeight').val();
            var Input = $('#update_Input').val();
            var Output = $('#update_Output').val();
            $.post(
                "<?=Url::toRoute('program/add-test-case')?>",
                {
                    QuestionId : QuestionBh,
                    ScoreWeight : ScoreWeight,
                    TestCaseInput : Input,
                    TestCaseOutput : Output,
                },
                function(res){
                    alert(res);
                    updateTest(QuestionBh);
                }
                )
        })
        //根据输入获取代码输出结果(修改)
        $('#getOutput').click(function () {
            $.ajax({
                type:'POST',
                url:'<?=Url::toRoute("program/get-case")?>',
                dataTpe:'json',
                // $('#update_SourceCode').val()
                data:{input_text:$('#update_Input').val(),code:editor.getValue(),ID:$('#update_QuestionBh').val()},
                success:function (value) {
                    $('#update_Output').val(value);
                }
            })
        })
        //编辑编程题
        function editAction(id){
            $("#update_modal").modal('show');
            getDiff();
            $('#update_Input').val('');
            $('#update_Output').val('');
            // UE.getEditor('update_SourceCode').execCommand('insertcode','C/C++');

            $.post(
                "<?=Url::toRoute('program/get-program')?>",
                {
                    QuestionBh:id,
                },
                function(res){
                    getKnowledge(res.StageCode);
                    $('#update_StageCode').val(res.StageCode);
                    $('#update_QuestionBh').val(res.QuestionBh);
                    $('#update_IsSee').val(res.Score);
                    $('#update_CustomBh').val(res.CustomBh);
                    $('#update_DifficultyCode').val(res.DifficultyCode);
                    $('#update_IsProgramBlank').val(res.IsProgramBlank=='100001' ? '1' : '0');
                    if($('#update_IsProgramBlank').val() == '1')
                    {
                        var start = '<span class="input-group-addon">&nbsp;开&nbsp;始&nbsp;标&nbsp;记&nbsp;</span><input type="text" class="form-control" id="update_StartTag" name="StartTag" value="/******start******/">';
                        var end = '<span class="input-group-addon">&nbsp;结&nbsp;束&nbsp;标&nbsp;记&nbsp;</span><input type="text" class="form-control" id="update_EndTag" name="EndTag" value="/******end******/">';
                        $("#StartDiv").html(start);
                        $("#EndDiv").html(end);
                    }
                    else
                    {
                        $('#StartDiv').empty();
                        $("#EndDiv").empty();
                    }
                    $('#update_name').val(res.name);
                    $('#update_Memo').val(res.Memo);
                    editor.setValue(res.SourceCode);
                    // $('#update_SourceCode').val(res.SourceCode);
                    global_ue_update.setContent(res.Description);
                    var html = '';
                    for(var key in res.TestCase)
                    {
                        html += '<tr role="row">'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><textarea>'+res.TestCase[key].TestCaseInput+'</textarea></th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><textarea>'+res.TestCase[key].TestCaseOutput+'</textarea></th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'+res.TestCase[key].ScoreWeight+'</th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" >'+res.TestCase[key].Memo+'</th>'+
                        '<th tabindex="0" aria-controls="data_table" rowspan="1" colspan="1" aria-sort="ascending" ><button type="button" class="btn btn-danger delete_one_test"  value="'+res.TestCase[key].TestCaseBh+'">删除</button></th>'+
                        '</tr>';

                    }

                    $('#update_test_case_info').html(html);
                    $('#update_KnowledgeBhCode').val(res.KnowledgeBhCode);


                },
                'json'

                );

        }
        //阶段改变时，更新知识点
        $('#update_StageCode').change(function(){

            getKnowledge($('#update_StageCode').val());
        })
        $('#add_StageCode').change(function(){

            getKnowledge($('#add_StageCode').val());
        })
        //删除测试用例点击事件
        $(document).on('click','.delete_one_test',function(){
            var QuestionBh = $('#update_QuestionBh').val();
            var TestCaseBh = $(this).val();
            $.post(
                "<?=Url::toRoute('program/delete-test-case')?>",
                {
                    TestCaseBh:TestCaseBh,
                },
                function(res)
                {
                    updateTest(QuestionBh);
                }
                )
        })
        //删除编程题
        function deleteOne(id){
            admin_tool.confirm('请确认是否删除', function(){
                $.post(
                    "<?=Url::toRoute('program/delete')?>",
                    {
                        QuestionBh:id,
                    },
                    function(res){
                        window.location.reload();
                    }
                    )
            });
        }
        //删除操作
        function deleteAction(id){
            var ids = [];
            if(!!id == true){
                ids[0] = id;
            }
            else{
                var checkboxs = $('#data_table :checked');
                if(checkboxs.size() > 0){
                    var c = 0;
                    for(i = 0; i < checkboxs.size(); i++){
                        var id = checkboxs.eq(i).val();
                        if(id != ""){
                            ids[c++] = id;
                        }
                    }
                }
            }
            if(ids.length > 0){
                admin_tool.confirm('请确认是否删除', function(){
                    $.ajax({
                        type: "GET",
                        url: "<?=Url::toRoute('program/delete')?>",
                        data: {"ids":ids},
                        cache: false,
                        dataType:"json",
                        error: function (xmlHttpRequest, textStatus, errorThrown) {
                            alert("出错了，" + textStatus);
                        },
                        success: function(data){
                            for(i = 0; i < ids.length; i++){
                                $('#rowid_' + ids[i]).remove();
                            }
                            admin_tool.alert('msg_info', '删除成功', 'success');
                            window.location.reload();
                        }
                    });
                });
            }
            else{
                admin_tool.alert('msg_info', '请先选择要删除的数据', 'warning');
            }

        }

        //新增编程题
        $('#create_btn').click(function (e) {
            $("#add_modal").modal('show');
            getKnowledge($('#add_StageCode').val());
            getDiff();

            // e.preventDefault();
            // window.location.href = "<?=Url::toRoute('program/add')?>"

        });
        //批量删除
        $('#delete_btn').click(function (e) {
            e.preventDefault();
            deleteAction('');
        });

        $("#update_IsProgramBlank").change(function(){
            var is_fill = $(this).val();
            if(is_fill == '1')
            {

                var start = '<span class="input-group-addon">&nbsp;开&nbsp;始&nbsp;标&nbsp;记&nbsp;</span><input type="text" class="form-control" id="update_StartTag" name="StartTag" value="/******start******/">';
                var end = '<span class="input-group-addon">&nbsp;结&nbsp;束&nbsp;标&nbsp;记&nbsp;</span><input type="text" class="form-control" id="update_EndTag" name="EndTag" value="/******end******/">';
                $("#StartDiv").html(start);
                $("#EndDiv").html(end);
            }
            else
            {
                $('#StartDiv').empty();
                $("#EndDiv").empty();
            }
        })
        $("#add_IsProgramBlank").change(function(){
            var is_fill = $(this).val();
            if(is_fill == '1')
            {

                var start = '<span class="input-group-addon">&nbsp;开&nbsp;始&nbsp;标&nbsp;记&nbsp;</span><input type="text" class="form-control" id="add_StartTag" name="StartTag" value="/******start******/">';
                var end = '<span class="input-group-addon">&nbsp;结&nbsp;束&nbsp;标&nbsp;记&nbsp;</span><input type="text" class="form-control" id="add_EndTag" name="EndTag" value="/******end******/">';
                $("#add_StartDiv").html(start);
                $("#add_EndDiv").html(end);
            }
            else
            {
                $('#add_StartDiv').empty();
                $("#add_EndDiv").empty();
            }
        })

    </script>
<?php $this->endBlock(); ?>
