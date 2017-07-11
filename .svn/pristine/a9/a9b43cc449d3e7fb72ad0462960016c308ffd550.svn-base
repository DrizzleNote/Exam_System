<?php
use yii\widgets\LinkPager;
use yii\base\Object;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\commonFuc;
$com = new commonFuc();
$i = 1;
?>
<style type="text/css">
body{
    background:#ECF0F5;
    margin-top: 30px;
}
.wrap{
    width:86%;
    height:500px;
    margin:0 auto;
    border:1px solid #ECF0F5;
    background-color: white;
}
.content{
    width:80%;
    height:400px;
    margin:0 auto;
    margin-top:50px;
    padding-top: 20px;
    background-color: #72C1F4;
    background:url(<?=Url::base()?>/front/img/changeBg.jpg); 
    background-repeat: no-repeat;
    background-size:cover;
    background-position:center;
    border-radius: 8px;
    text-align: center;
}
.content .IfoName{
    width: 80%;
    font-weight: bold;
    letter-spacing: 2px;
    margin:0 auto;
    margin-top: 20px;
    text-align: center;
    height: 35px;
    line-height: 35px;
    background-color:#fff;
}
.content .password{
    width:60%;
    margin:0 auto;
    margin-top: 30px;
    height:250px;
    border:1px solid gray;
}
#pass{
    width:80%;
    margin: 0 auto;
    line-height: 25px;
    margin-top: 5px;
    font-size: 14px;
    font-weight: bold;
}
input{
    height:25px;
    border:1px solid gray;
    background-color: #e9e9e9;
}

.fff{
    background-color: #fff;
}
#sub{
    height:30px;
    line-height: 30px;
    border-radius: 0px;
    width:50%;
    margin:0 auto;
    margin-top: 20px;
    background-color: orange;
    border:0px solid white;
    text-align: center;
    font-size: 16px;
    font-weight: bold;
    letter-spacing: 8px;
    color: white;
    cursor: pointer;
}
.left{
    width:110px;
    text-align: right;
    margin-right: 8px;
    font-weight: bold;
}
.right{
    width: 240px;
    text-align: left;
}
.password{
    min-width: 406px;
    min-height: 250px;
}
</style>
</head>

 <script src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
            $(document).ready(function() {

                var oldID = "1234";  //如果方便可以先保存起其原始身份证号，避免无修改提交;如果不保存此数据，则需要修改下面的ajax请求
                $("#sub").click(function(){
                    var oldID = $("#OldID").val();
                    var newID = $("#NewID").val();
                    if(!newID){
                        alert("请输入身份证号！");
                    }else if(newID==oldID){
                        alert("你未修改身份证号，不用再次提及！");
                    }else{
                        $.ajax({
                            type:"post",
                            dataType:'json',
                            url:"<?=Url::toRoute('site/change-info')?>",
                            data:{ "StuNumber":$('#user').html(),"oldID":oldID,"newID":$('#NewID').val() },
                            success:function(data){
                                // alert(date);
                                if(data.error == 0){
                                    alert('修改成功');
                                    window.location.reload();
                                }else{
                                    alert("修改失败，请稍后再试!");
                                }
                            },
                            cache:false,
                        });
                    }
                });
            });

</script>

<body>
<div class="wrap">
    <div class="content">
        <div class="IfoName"><span>个人信息</span>
        </div>
        <div class="password">
            <table id="pass">
                <tr><td class="left" >用户名：</td><td class="right" id="user" name="StuNumber"><?=Yii::$app->session->get('StudentNum')?></td></tr>

                <tr><td class="left"><label>姓名：</label></td><td class="right"><input id="uasrName" type="text" name="oldpassword" disabled="disabled" value="<?=$student_info['Name']?>"></td></tr>
                <tr><td class="left"><label>性别：</label></td><td class="right"><input type="text" name="newpassword" disabled="disabled" value="<?=$student_info['Sex']?>"></td></tr>
                <tr><td class="left"><label>身份证号：</label></td><td class="right"><input class="fff" id="NewID" type="text" maxlength="18" value="<?=$student_info['ICNumber']?>"></td></tr>

                 <tr><td class="left"><label>班级：</label></td><td class="right"><input type="text" name="oldpassword" disabled="disabled" value="<?=$student_info['ClassName']?>"></td></tr>
                  <tr><td class="left"><label>专业：</label></td><td class="right"><input type="text" name="oldpassword" disabled="disabled" value="<?=$student_info['MajorName']?>"></td></tr>
                   <tr><td class="left"><label>学院：</label></td><td class="right"><input type="text" name="oldpassword" disabled="disabled" value="<?=$student_info['DepartmentName']?>"></td></tr>
                    <tr><td class="left"><label>备注信息：</label></td><td class="right"><input type="text" name="oldpassword" disabled="disabled" value="<?=$student_info['Memo']?>"></td></tr>
            </table>
            <button id="sub" type="submint" value="提交">提交</button>
        </div>
    </div>
</div>
