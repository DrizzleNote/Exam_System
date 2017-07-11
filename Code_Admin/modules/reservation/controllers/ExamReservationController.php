<?php

namespace app\modules\reservation\controllers;
use app\controllers\BaseController;
use app\models\system\TbcuitmoonDictionary;
use app\models\reservation\Openconfigure;
use app\models\reservation\Testcustom;
use app\models\reservation\Testroom;
use app\models\reservation\Appointment;
use app\models\systembase\Studentinfo;



use common\commonFuc;

class ExamReservationController extends \app\controllers\BaseController
{
    public function actionIndex()
    {
    	$m_config = new Openconfigure();
    	$info = $m_config->getOpenConfigure();

    	foreach ($info as $key => $value) {
    		// foreach ($value as $key1 => $value1) {
    			// if(is_array($value1)){
    			$info[$key]['TestRoomName'] = Testroom::find()->where(['TestRoomBh'=>$value['TestRoomBh']])->asArray()->one()['TestRoomname'];
    			$info[$key]['testBeginTime'] = Testcustom::find()->where(['TestCustomBh'=>$value['TestCustomBh']])->asArray()->one()['BeginTime'];
    			$info[$key]['testEndTime'] = Testcustom::find()->where(['TestCustomBh'=>$value['TestCustomBh']])->asArray()->one()['EndTime'];
    			$info[$key]['SeatTotal'] = Testroom::find()->where(['TestRoomBh'=>$value['TestRoomBh']])->asArray()->one()['SeatTotal'];
                $info[$key]['SeatSelect'] = Appointment::find()->where(['ConfigureBh'=>$value['ConfigureBh']])->count();
    			// }
    		// }
    		
    	}
        return $this->render('index',[
        		'info'=>$info,
        	]);
    }


    public function actionView()
    {

        $ConfigureBh = \Yii::$app->request->get();
        $info = Appointment::find()->where(['ConfigureBh'=>$ConfigureBh])->orderBy("StuNumber ASC")->asArray()->all();
        foreach ($info as $key => $value) {
            $info[$key]['StuName'] = Studentinfo::find()->where(['StuNumber'=>$value['StuNumber']])->asArray()->one()['Name'];
            $info[$key]['ClassName'] = Studentinfo::find()->where(['StuNumber'=>$value['StuNumber']])->asArray()->one()['ClassName'];
        }
        return $this->render('details',[
                'info'=>$info,
            ]);

    }


    public function actionDetails()
    {
       $AppointmentBh = \Yii::$app->request->get();
        $data = Appointment::find()->where(['AppointmentBh'=>$AppointmentBh])->asArray()->one();
       
            $data['StuName'] = Studentinfo::find()->where(['StuNumber'=>$data['StuNumber']])->asArray()->one()['Name'];
            $data['ClassName'] = Studentinfo::find()->where(['StuNumber'=>$data['StuNumber']])->asArray()->one()['ClassName'];
            $data['TestRoomName'] = Testroom::find()->where(['TestRoomBh'=>$data['TestRoomBh']])->asArray()->one()['TestRoomname'];         
        echo json_encode($data);

    }

    public function actionDelete()
    {
        $com = new commonFuc();
       
        $id = \Yii::$app->request->get();
        if(count($id) > 0) {
            foreach ($id as $item){
                Appointment::deleteAll(['AppointmentBh' => $item]);
            }
            $com->JsonSuccess('删除成功');
        }
    }

     public function actionDelete1()
    {
        $com = new commonFuc();
       
        $id = \Yii::$app->request->get();
        if(count($id) > 0) {
            foreach ($id as $item){
                Openconfigure::deleteAll(['ConfigureBh' => $item]);
            }
            $com->JsonSuccess('删除成功');
        }
    }

    
 

}
