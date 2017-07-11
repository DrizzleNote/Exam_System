<?php

namespace app\modules\reservation\controllers;
use app\models\reservation\Testroom;
use app\models\reservation\Openconfigure;
use app\models\reservation\Testcustom;
use common\commonFuc;


class RoomConfigController extends \app\controllers\BaseController
{
    public function actionIndex()
    {
    	$m_testRoom = new Testroom();
        $info = $m_testRoom->getTestRoom();

        $m_testCustom = new Testcustom();
        $data = $m_testCustom->getTestCustom();
        return $this->render('index',[
        		'info' => $info,
        		'data' => $data,
        	]);
    }

    public function actionSubmitOne()
    {
    	$m_config = new Openconfigure();
    	$com = new commonFuc();
        $ConfigureBh = $com->create_id();
        $TestRoomBh = \Yii::$app->request->post('id');

        $m_config->ConfigureBh = $ConfigureBh;
        $m_config->TestRoomBh = $TestRoomBh;

        $m_config->save();
        echo json_encode("$ConfigureBh");
        // return $ConfigureBh;


    }

   public function actionSubmitTwo()
    {      
        $ConfigureBh = \Yii::$app->request->post('gloab_Bh');
        $TestDate = \Yii::$app->request->post('id');

        Openconfigure::updateAll(['TestDate'=>$TestDate],['ConfigureBh'=>$ConfigureBh]);

        echo json_encode($TestDate);
        // return $ConfigureBh;


    }

    public function actionSubmitThree()
    {      
        $ConfigureBh = \Yii::$app->request->post('gloab_Bh');
        $TestCustomBh= \Yii::$app->request->post('id');

        Openconfigure::updateAll(['TestCustomBh'=>$TestCustomBh],['ConfigureBh'=>$ConfigureBh]);

        echo json_encode($TestCustomBh);
        // return $ConfigureBh;
    }

}
