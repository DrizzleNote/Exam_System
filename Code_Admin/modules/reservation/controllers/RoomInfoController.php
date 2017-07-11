<?php

namespace app\modules\reservation\controllers;
use app\controllers\BaseController;
use app\models\system\TbcuitmoonDictionary;
use app\models\reservation\Testroom;
use app\models\reservation\Seat;

use common\commonFuc;
use yii\web\UploadedFile;
use app\models\UploadForm;
use yii\base\Exception;
use yii\helpers\BaseJson;
use yii\helpers\Url;

class RoomInfoController extends \app\controllers\BaseController
{
    public function actionIndex()
    {
        $m_testRoom = new Testroom();
        $info = $m_testRoom->getTestRoom();
        return $this->render('index',[
                'info' => $info, 
            ]);
    }

    //考场基本信息->增加考场
    public function actionAdd(){
        $m_test_room = new Testroom();
        $com = new commonFuc();
        $TestRoomBh = $com->create_id();
        $TestRoomname = \Yii::$app->request->post('roomName');
        $SeatTotal =\Yii::$app->request->post('SeatTotal');
        $BeginIP = \Yii::$app->request->post('begin');
        $EndIP = \Yii::$app->request->post('end');
        $Memo = \Yii::$app->request->post('content');  
        
        
            $m_test_room->TestRoomBh = $TestRoomBh;
            $m_test_room->TestRoomname = $TestRoomname;
            $m_test_room->SeatTotal = $SeatTotal;
            $m_test_room->BeginIP = $BeginIP;
            $m_test_room->EndIP = $EndIP;
            $m_test_room->Memo = $Memo;
            $m_test_room->insert();
            
            echo json_encode("添加成功");
    }

    //考场基本信息->考场列表->修改考场信息
    public function actionEdit(){
        $m_test_room = new Testroom();
        
        $TestRoomBh = \Yii::$app->request->post('roomBh');
        $TestRoomname = \Yii::$app->request->post('roomName');
        $SeatTotal =\Yii::$app->request->post('SeatTotal');
        $BeginIP = \Yii::$app->request->post('begin');
        $EndIP = \Yii::$app->request->post('end');
        $Memo = \Yii::$app->request->post('content');  
        
        Testroom::updateAll(['TestRoomname'=>$TestRoomname,'BeginIP'=>$BeginIP,'EndIP'=>$EndIP,'SeatTotal'=>$SeatTotal,'Memo'=>$Memo],['TestRoomBh'=>$TestRoomBh]);
        echo json_encode("修改成功");
            
    }

    /*
    *座位管理->座位列表->编辑座位信息
    */
    public function actionEditSeatInfo(){
        $m_seat = new Seat();

        $SeatBh = \Yii::$app->request->post('SeatBh');
        $SeatAlias = \Yii::$app->request->post('SeatAlias');
        $SeatIP = \Yii::$app->request->post('SeatIP');
        $SeatMAC = \Yii::$app->request->post('SeatMAC');
        $Memo = \Yii::$app->request->post('Memo');

        Seat::updateAll(['SeatAlias'=>$SeatAlias,'SeatIP'=>$SeatIP,'SeatMAC'=>$SeatMAC,'Memo'=>$Memo],['SeatBh'=>$SeatBh]);
        echo json_encode("修改成功");
    }

    //考场基本信息->考场列表->删除考场信息
    public function actionDelete(){
        
        $TestRoomBh = \Yii::$app->request->get('id');
        Testroom::deleteAll(['TestRoomBh' => $TestRoomBh]);
        echo json_encode("成功删除");    
    }

    //座位管理->座位列表->删除某个座位信息
    public function actionDelete1(){
        
        $SeatBh = \Yii::$app->request->get('id');
        Seat::deleteAll(['SeatBh' => $SeatBh]);
        echo json_encode("成功删除");    
    }

    public function actionView(){
        $m_test_room = new Testroom();
        $room_info = Testroom::find()->where([
            'TestRoomBh' => \Yii::$app->request->get('id')
            ])->asArray()->one();
        echo json_encode($room_info);
    }

     public function actionEditSeat(){
        $m_seat = new Seat();
        $seat_info = Seat::find()->where([
            'SeatBh' => \Yii::$app->request->get('id')
            ])->asArray()->one();
        echo json_encode($seat_info);
    }

    //座位管理->添加座位
    public function actionAddSeat(){
        $m_seat = new Seat();
        $TestRoomBh = \Yii::$app->request()->get();
        
        $com = new commonFuc();
        $SeatBh = $com->create_id();
        $m_seat->SeatBh = $SeatBh;
        $m_seat->TestRoomBh = $TestRoomBh;
        $m_seat->insert();
        $data = Seat::find()->where(['SeatBh'=>$SeatBh])->asArray()->one();

        echo json_encode($data);

    }

    /**
     * excel导入学生信息
     * @return json
     */
    public function actionAddStudents(){
        $upload = new UploadForm();
        $com = new commonFuc();

        if(Yii::$app->request->isPost){
            $id = Yii::$app->request->post('id');
            $upload->excel = UploadedFile::getInstance($upload, 'excel');
            if($upload->excel && $upload->validate()){
                $upload
                    ->excel
                    ->saveAs(__DIR__.'/../../../upload/tmp_file/'.
                        md5($upload->excel->baseName).'.'.$upload->excel->extension);
                $reader = \PHPExcel_IOFactory::createReader('Excel5');
                $PHPExcel = $reader
                    ->load(__DIR__.'/../../../upload/tmp_file/'.
                        md5($upload->excel->baseName).'.'.$upload->excel->extension);
                $sheet = $PHPExcel->getSheet(0);
                $row = $sheet->getHighestRow();
                for ($i =  2; $i <= $row; $i++){//行数是以第1行开始
                    $m_student = new Studentinfo();
                    $m_classDetail = new Teachingclassdetails();
                    if($sheet->getCell('A'.$i)->getValue() == null){
                        break;
                    }

                    $m_classDetail->StuNumber = (string)$sheet->getCell('A'.$i)->getValue();
                    $m_classDetail->TeachingClassDetailsID = $com->create_id();
                    $m_classDetail->TeachingClassID = $id;
                    //-------------------------//
                    $m_student->StuNumber = (string)$sheet->getCell('A'.$i)->getValue();
                    $m_student->ICNumber = (string)$sheet->getCell('B'.$i)->getValue();
                    $m_student->Name = (string)$sheet->getCell('C'.$i)->getValue();
                    $m_student->Sex = (string)$sheet->getCell('D'.$i)->getValue();
                    // Yii::$app->security->generatePasswordHash
                    $m_student->Password = (string)md5($sheet->getCell('A'.$i)->getValue());
                    $m_student->ClassName = (string)$sheet->getCell('F'.$i)->getValue();
                    $m_student->DepartmentName = (string)$sheet->getCell('G'.$i)->getValue();
                    $m_student->MajorName = (string)$sheet->getCell('H'.$i)->getValue();
                    $m_student->Memo = (string)$sheet->getCell('I'.$i)->getValue();

                    try{
                        $m_student->save();
                    }catch (Exception $e){

                    }
                    $m_classDetail->save();

                }

                $data = [
                    'error' => 0,
                    'msg' => '错误',
                ];
                echo json_encode($data);
            }else{
                $com->JsonFail($upload->getErrors());
            }
        }else{
            $com->JsonFail('请用post方式传输');
        }
    }

    //获取EXCEL模板信息
    public function actionGetExcel()
    {
        $content = '';
        // Url::base()
        $content = file_get_contents(Url::base()."upload/ExcelExample/StudentInfo.xls");
        if(!$content)
            throw new CHttpException('500','该文件内容为空，没有找到该文件！');
            \Yii::$app->request->sendFile("Studentinfo.xls", $content);
    }

    public function actionManage()
    {
        $TestRoomBh = \Yii::$app->request->get();
        $data = Seat::find()->where(['TestRoomBh'=>$TestRoomBh])->asArray()->all();

        return $this->render('manage',[
                'data' => $data,
            ]);
    }


}



