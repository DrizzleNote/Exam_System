<?php

namespace app\modules\reservation\controllers;
use app\controllers\BaseController;
use app\models\system\TbcuitmoonDictionary;
use app\models\reservation\Appointment;
use app\models\reservation\Testroom;
use common\commonFuc;


class StuSeatController extends \app\controllers\BaseController
{
    public function actionIndex()
    {	
    	
    	

        return $this->render('index');
    }

    public function actionGetStudent()
    {
    	$date = \Yii::$app->request->get();
    	$info = Appointment::find()->where(['TestDate'=>$date])->asArray()->all();

    	foreach ($info as $key => $value) {
    		$info[$key]['TestRoomname'] = Testroom::find()->where(['TestRoomBh'=>$value['TestRoomBh']])->asArray()->one()['TestRoomname'];
    	}

    	echo json_encode($info);
    }

}
