<?php

namespace app\controllers;

use app\models\system\TbcuitmoonModule;
use app\models\TbcuitmoonUser;
use app\models\system\TbcuitmoonDictionary;
use common\commonFuc;
use Yii;
use yii\helpers\Url;
use app\models\Captcha;

class SiteController extends SitebaseController
{

	
    public $layout = 'lte_main';
    public function actions(){
        return [
             'captcha' => [
                'class' => 'yii\captcha\CaptchaAction', 
	            'maxLength' => 5, 
	            'minLength' => 4 ,
	            'padding' => 5, 

                
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }  
    // public function actions()
    // {
    //     return [
    //         'error' => [
    //             'class' => 'yii\web\ErrorAction',
    //         ],
    //     ];
    // }


    public function actionIndex()
    {
        //是否登陆
        $verify = new Captcha();
        if(Yii::$app->user->isGuest){
            $this->layout = "lte_main_login";
            return $this->render('login',[
            'verify' => $verify]);
        }else{
            $sysInfo = [
                ['name'=> '操作系统', 'value'=>php_uname('r')],
                ['name'=>'PHP版本', 'value'=>phpversion()],
                ['name'=>'Yii版本', 'value'=>Yii::getVersion()],
                ['name'=>'数据库', 'value'=>'You Guess'],
                ['name'=>'AdminLTE', 'value'=>'V2.3.6'],
                ['name'=>'建议和BUG', 'value'=>'http://git.oschina.net/penngo/chadmin/issues'],
                ['name'=>'当前登录IP','value'=>(new commonFuc())->getClientIp()],
            ];
            $this->layout = 'lte_main';
            $module = new TbcuitmoonModule();
            $info = $module->getAllModules();
            return $this->render('index', [
                'system_menus' => $info,
                'sysInfo' => $sysInfo,
            ]);
        }
    }



    public function actionLogin(){
        $com = new commonFuc();
        $m_user = new TbcuitmoonUser();
        $verify = new Captcha();
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');
        $rememberMe = Yii::$app->request->post('remember');
        $rememberMe = $rememberMe == 'y' ? true : false;
        if(!$verify->load(Yii::$app->request->post()) || !$verify->validate())
        	echo json_encode(['error'=>1]);

        else
        {
        	if(TbcuitmoonUser::login($username, $password, $rememberMe) == true){
	            TbcuitmoonUser::updateAll(
	                ['CuitMoon_UserRemarks' => $com->getClientIp()],
	                ['CuitMoon_UserName' => $username]
	            );
	            Yii::$app->session->set('UserName',$username);
	            //检测角色
	            $Tmp = '';
	            $Roles = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
	            foreach ($Roles as $item) {
	                $Tmp = $item->name;
	            }
	            if ($Tmp == '教师') {
	                Yii::$app->session->set('courseCode',$m_user->findOne([
	                    'CuitMoon_UserID' => Yii::$app->user->getId()
	                ])->CuitMoon_AreaCode);
	            }
	            echo json_encode(['error'=>0]);
	        }
	        else{
	            echo json_encode(['error'=>2]);
	        }
        }
        
    }


    public function actionLogout(){
//        Yii::$app->user->identity->clearUserSession();
        Yii::$app->user->logout();
        return $this->goHome();
    }


    /**
     * 设置课程
     * @return \yii\web\Response
     */
    public function actionSetCourse(){
        $session = Yii::$app->session;
        $session->open();
        \Yii::$app->session->set('courseCode',Yii::$app->request->get('courseCode'));
        return $this->redirect(Url::toRoute('site/index'));
    }

    public function actionChangePassword() {
        return $this->render('change-password');
    }
    public function actionChangeMyinfo() {
        $m_dic = new TbcuitmoonDictionary();

        return $this->render('change-myinfo',[
            
            'myinfo' => TbcuitmoonUser::find()->where(['CuitMoon_UserName'=>\Yii::$app->session->get('UserName')])->asArray()->one()
            ]
            
            );
    }
    public function actionSaveMyinfo() {
        if(\Yii::$app->request->isPost)
        {
            $aim = TbcuitmoonUser::find()->where(['CuitMoon_UserName'=>\Yii::$app->session->get('UserName')])->one();
            $aim->load(\Yii::$app->request->post());
            $aim->save();
            return $this->redirect(Url::toRoute('site/index'));
        }
    }

    public function actionChange() {
        $com = new commonFuc();
        $info = \Yii::$app->request->post();
        $id = \Yii::$app->session->get('UserName');
        $Student = TbcuitmoonUser::find()->where(['CuitMoon_UserName' => $id])->one();
        if (Yii::$app->getSecurity()
            ->validatePassword($info['oldpassword'], $Student['CuitMoon_UserPassWord'])) {
            TbcuitmoonUser::updateAll(['CuitMoon_UserPassWord'=>\Yii::$app->getSecurity()->generatePasswordHash($info['newpassword'])],['CuitMoon_UserName'=>$id]);
            // $Student->CuitMoon_UserPassWord = Yii::$app->getSecurity()->generatePasswordHash($info['newpassword']);
            if ($Student->save()) 
                echo "修改成功";
        } else {
            echo "密码错误";
        }
    }


}
