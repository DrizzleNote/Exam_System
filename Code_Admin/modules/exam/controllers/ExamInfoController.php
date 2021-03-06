<?php

namespace app\modules\exam\controllers;

use app\models\exam\Examprocess;
use app\models\system\TbcuitmoonDictionary;
use app\modules\front\controllers\ExamController;
use common\commonFuc;
use app\models\exam\Exampaper;
use app\models\teachplan\Examplan;
use app\models\teachplan\Teachingclassmannage;
use Yii;

class ExamInfoController extends \app\controllers\BaseController
{
    /**
     * 渲染搜首页
     * @return string
     */
    public function actionIndex()
    {
        $m_dic = new TbcuitmoonDictionary();
        $com = new commonFuc();
        $m_exam_paper = new Exampaper();

        $Info = Yii::$app->request->get();
        $Where = [];
        if (isset($Info['classID'])) {
            $Where['ExamPlanBh'] = $Info['examPlan'];
            $Where[Exampaper::tableName().'.TeachingClassID'] = $Info['classID'];
            $Data['ExamPlan_Choice'] = $Info['examPlan'];
            $Data['ClassID_Choice'] = $Info['classID'];
            $Data['Term_Choice'] = $Info['term'];
        } else {
            $Data['Term_Choice'] = false;
            $Data['ExamPlan_Choice'] = false;
            $Data['ClassID_Choice'] = false;
            $Data['Term_Choice'] = false;
        }
        // $Where['TeacherName'] = Yii::$app->session->get('UserName');
        $Tmp = $m_exam_paper->find()->leftJoin(Teachingclassmannage::tableName(),
                    Teachingclassmannage::tableName().'.TeachingClassID='.
                    Exampaper::tableName().'.TeachingClassID')->where($Where)->orderBy('StudentID ASC');
        //orderBy('CAST(StudentID as SIGNED) ASC');
        $Tmp_One = clone $Tmp;
        $Pages = $com->Tab($Tmp_One);

        return $this->render('index',[
            'term' => $m_dic->getDictionaryList('学期'),
            'pages' => $Pages,
            'list' => $Tmp->all(),
            'choice' => $Data,
        ]);
    }

    /**
     * 查看试卷详情
     */
     // public function actionView()
     // {
     //    $m_exam_paper = new Exampaper();
   
     //    $Tmp = $m_exam_paper->find()->where([
     //        'PaperID' => Yii::$app->request->get('id'),
     //    ])->asArray()->one();
  
     //     echo json_encode($Tmp);
     // }
    public function actionView()
    {
        
                $paper_info = (new \yii\db\Query())
                ->select(Exampaper::tableName().'.Memo,StuName,StudentID,ExamBeginTime,
                    ExamEndTime,MachineIP,MACAddress,' .Examplan::tableName().'.ExamPlanName')
                ->from(Exampaper::tableName())
                ->leftJoin(Examplan::tableName(),
                    Examplan::tableName().'.ExamPlanBh='.
                    Exampaper::tableName().'.ExamPlanBh')
                ->where(['PaperID' => Yii::$app->request->get('id')])
                ->one();
                echo json_encode($paper_info,JSON_UNESCAPED_UNICODE);
       
    }
   

   
    /**
     * 批量提交试卷
     */
    public function actionSubmit()
    {
        $m_exam_paper = new Exampaper();

        $Data = Yii::$app->request->get();
        $Tmp = $m_exam_paper->find()->where([
            'ExamPlanBh' => $Data['examPlan'],
            'TeachingClassID' => $Data['Class'],
        ])->all();
        foreach ($Tmp as $item) {
            $item->ExamEndTime = date('Y-m-d H:i:s');
            $item->SubmitStage = '1';
            $item->save();
        }
        echo json_encode('0');
    }

    public function actionSubmitAlone()
    {
        $m_exam_paper = new Exampaper();
        $com = new commonFuc();

        $id = Yii::$app->request->get();
        if (isset($id['id'])) {
            $Tmp = $m_exam_paper->findOne([
                'PaperID' => $id['id']
            ]);
            $Tmp->SubmitStage = '1';
            $Tmp->ExamEndTime = date('Y-m-d H:i:s');
            if ($Tmp->save()) {
                $com->JsonSuccess('交卷成功');
            } else {
                $com->JsonFail('交卷失败');
            }
        } else {
            $com->JsonFail('数据错误');
        }
    }

    public function actionCorrect()
    {
        $com = new commonFuc();
        
        $PaperID = Yii::$app->request->get();
        $score = Exampaper::find()->where(['PaperID'=>$PaperID['id']])->asArray()->one()['Score'];
        $PaperBh = Exampaper::findOne(['PaperID'=>$PaperID['id']])->PaperBh;
        $Data = $com->GetPaper($PaperBh);
        $Answer = Examprocess::find()->where(['PaperID' => $PaperID])->asArray()->all();
       $PaperID[0] = 'exam-info/index';
        return $this->render('paper',[
            'score'=>$score,
            'info' => $Data,
            'paperID' => $PaperID['id'],
            'param' => $PaperID,
            'answer' => json_encode($Answer),
        ]);
    }

    public function actionSavePaper()
    {
        $com = new commonFuc();

        $Ans = Yii::$app->request->post();
        $ExamPlanBh = Yii::$app->request->post('PaperID');
        unset($Ans['_csrf']);
        unset($Ans['PaperID']);
        $com->SavePaper($Ans,$ExamPlanBh);
        $com->JsonSuccess('修正成功');
    }

    public function actionDelete()
    {
        $com = new commonFuc();
        $m_exam_paper = new Exampaper();

        $ids = Yii::$app->request->get('ids');
        if(count($ids) > 0) {
            foreach ($ids as $item){
                Exampaper::deleteAll(['PaperID' => $item]);
            }
            $com->JsonSuccess('删除成功');
        }
    }

}
