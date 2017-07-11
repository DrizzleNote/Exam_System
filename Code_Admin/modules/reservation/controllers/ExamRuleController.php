<?php

namespace app\modules\reservation\controllers;
use app\controllers\BaseController;
use app\models\system\TbcuitmoonDictionary;
use app\models\reservation\Testcustom;
use common\commonFuc;

class ExamRuleController extends \app\controllers\BaseController
{
    public function actionIndex()
    {
        $m_testCustom = new Testcustom();
        $info = $m_testCustom->getTestCustom();
        return $this->render('index',[
                'info' => $info, 
            ]);
    }


    public function actionAdd(){
        $m_test_custom = new Testcustom();
        $com = new commonFuc();
        $TestCustomBh = $com->create_id();
        $TestCustomName = \Yii::$app->request->post('ruleName');
        $BeginTime = \Yii::$app->request->post('begin');
        $EndTime = \Yii::$app->request->post('end');
        $Memo = \Yii::$app->request->post('content');  
        
        
            $m_test_custom->TestCustomBh = $TestCustomBh;
            $m_test_custom->TestCustomName = $TestCustomName;
            $m_test_custom->BeginTime = $BeginTime;
            $m_test_custom->EndTime = $EndTime;
            $m_test_custom->Memo = $Memo;
            $m_test_custom->insert();
            
            echo json_encode("添加成功");
    }

    public function actionEdit(){
        $m_test_custom = new Testcustom();
        
        $TestCustomBh = \Yii::$app->request->post('ruleBh');
        $TestCustomName = \Yii::$app->request->post('ruleName');
        $BeginTime = \Yii::$app->request->post('begin');
        $EndTime = \Yii::$app->request->post('end');
        $Memo = \Yii::$app->request->post('content');  
        
        Testcustom::updateAll(['TestCustomName'=>$TestCustomName,'BeginTime'=>$BeginTime,'EndTime'=>$EndTime,'Memo'=>$Memo],['TestCustomBh'=>$TestCustomBh]);
        echo json_encode("修改成功");
            
    }

    public function actionDelete(){
        
        $TestCustomBh = \Yii::$app->request->get('id');
        Testcustom::deleteAll(['TestCustomBh' => $TestCustomBh]);
        echo json_encode("成功删除");    
    }

    public function actionView(){
        $m_test_custom = new Testcustom();
        $custom_info = Testcustom::find()->where([
            'TestCustomBh' => \Yii::$app->request->get('id')
            ])->asArray()->one();
        echo json_encode($custom_info);
    }

   

}
