<?php
use yii\helpers\Url;
use yii\helpers\Html;
$this->title = '课程化考核平台';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible">  <!--content="IE=edge"-->
    <title><?=$this->title?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="mystyle.css">
    <link rel="stylesheet" href="<?=Url::base()?>/front/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=Url::base()?>/front/awesome/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?=Url::base()?>/front/ionicons/ionicons.min.css">
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="<?=Url::base()?>/front/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="<?=Url::base()?>/front//fullcalendar/fullcalendar.print.css" media="print">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?=Url::base()?>/front/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="<?=Url::base()?>/front/dist/css/skins/skin-blue-light.min.css">
    <!-- Page Tab -->
    <link rel="stylesheet" href="<?=Url::base()?>/front/page-tab/css/style.min.css">

    <style type="text/css">
        body,
        body.full-height-layout div.wrapper,
        html{
            height: 100%;
        }
        body.full-height-layout div.content-wrapper{
            height: calc(100% - 140px)
        }

        body.full-height-layout div#J_mainContent{
            height: calc(100% - 40px)
        }
        .sidebar{
            margin-top: 0 !important;
            border-top: 6px solid #ECF0F5;
            background-image:linear-gradient(to bottom,#3C8DBC,#FFF);
        }
        .retu a:hover{
            color:#C60005;
        }
        .J_mainContent{
            margin-bottom: 0px !important;
        }
        .content-wrapper{
            padding-bottom: 0px !important;
        }
        .J_mainContent{
            margin-bottom: 0px !important;
        }
        .main-footer{
            padding:10px;
        }
    </style>

    <?php if(isset($this->blocks['header']) == true):?>
        <?= $this->blocks['header'] ?>
    <?php endif;?>
</head>

<script type="text/javascript">
//    document.write('<iframe src="/ad_footer.html?'+ (new Date()).getTime() +'" width="918" scrolling="no" frameborder="0" height="41"></iframe>');
</script>  <!--解决火狐浏览器下的iframe页面自动缓存,不可删除-->
<body class="hold-transition skin-blue-light sidebar-mini fixed full-height-layout" style="background-color: #ECF0F5;">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header" style="background-color: #ECF0F5;">

        <!-- Logo -->
        <a href="<?=Url::toRoute('site/index')?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>...</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">主菜单</span>
        </a>
        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">隐藏|显示</span>
            </a>
            <!-- Navbar Right Menu -->
            <p style="width:90%; float:left; text-align:center; color:white; font-size:22px; letter-spacing: 3px; padding-top:10px;"><b>C语言课程平台学生练习中心</b></p>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image" style="height:50px !important;">
                   <!--  <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
                </div>
                <div class="pull-left info" style="left: 0px; width: 92%; text-align: center;">
                    <p id="name" style="font-size:26px; color:#C60005; font-family: 华文新魏; "><?=\app\models\systembase\Studentinfo::find()->where(['StuNumber' => Yii::$app->session->get('StudentNum')])->asArray()->one()['Name'];?></p>
                    <!-- Status -->
                    <p class="retu"><i class="fa fa-circle text-success"></i> <a href="<?=Url::toRoute('site/logout')?>">退出登录</a></p>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">选项卡</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="mypage" id="PreTest">
                    <a class="J_menuItem mypage" style="text-decoration:none; border-top:1px solid #DEDEDE;" data-content="content-main" data-iframe="true" data-index="1" href="<?=Url::toRoute('exam/index')?>">
                        <i class="fa fa-dashboard"></i> <span>进入考试</span>
                    </a>
                </li>
                <li id="Practice" class="treeview mypage sidebar-toggle">
                    <a href="<?=Url::toRoute('test/index')?>">
                        <i class="fa fa-dashboard" ></i> <span>进入练习</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>
                <li class="treeview mypage" id="MyGrade">
                    <a href="<?=Url::toRoute('grade/index')?>" class="mypage">
                        <i class="fa fa-star-o"></i>  <span>成绩查询</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>
                <li class="treeview mypage">
                    <a href="<?=Url::toRoute('up/index')?>">
                        <i class="fa fa-star-o"></i> <span>作业管理</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>
                <li class="treeview mypage">
                    <a href="#">
                        <i class="fa fa-star-o"></i> <span>工程实践</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>
                <li class="treeview mypage">
                    <a href="<?=Url::toRoute('site/change-password')?>">
                        <i class="fa fa-briefcase"></i> <span>修改密码</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>
                <li class="treeview mypage">
                    <a href="<?=Url::toRoute('site/person-info')?>">
                        <i class="fa fa-briefcase"></i> <span>个人信息</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>

                <li class="treeview mypage">
                    <a href="<?=Url::toRoute('test/code')?>">
                        <i class="fa fa-briefcase"></i> <span>在线编译</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div id="J_mainContent" class="J_mainContent" style="overflow: auto; height: 100%; margin-bottom: 0px;">
            <!-- Main content -->
            <?= $content ?>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">

        <strong>Copyright &copy; 2017 <a href="#">CUIT-LOOP</a>.</strong> All rights reserved.
    </footer>

    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.0 -->
<script src="<?=Url::base()?>/front/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?=Url::base()?>/front/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- Page Tab -->
<script src="<?=Url::base()?>/front/page-tab/js/contabs.js?v=4"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=Url::base()?>/front/jquery-ui/jquery-ui.min.js"></script>
<!-- Slimscroll -->
<script src="<?=Url::base()?>/front/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=Url::base()?>/front/fastclick/fastclick.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="<?=Url::base()?>/front/moment/moment.min.js"></script>
<script src="<?=Url::base()?>/front//fullcalendar/fullcalendar.min.js"></script>

<script type="text/javascript">

</script>
</body>
<?php if(isset($this->blocks['footer']) == true):?>
    <?= $this->blocks['footer'] ?>
<?php endif;?>
</html>
