<?php
namespace app\modules\question\controllers;

use app\modules\question\controllers\QuestionbaseController;
use app\models\question\Knowledgepoint;
use app\models\question\Questions;
use app\models\question\Scorepoint;
use app\models\system\TbcuitmoonDictionary;
use common\commonFuc;
use Yii;
use yii\data\Pagination;
use app\models\question\FindError;

class ShortController extends QuestionbaseController
{


    /**
     * 渲染首页
     * @return string
     */
    public function actionIndex()
    {
        $m_dic = new TbcuitmoonDictionary();
        $m_know = new Knowledgepoint();
        $m_ques = new Questions();
        $com = new commonFuc();

        //是否选择阶段
        $stage = Yii::$app->request->get();
        if (isset($stage['stage'])) {
            $where = [
                'Stage' => $stage['stage'],
            ];
        }
        $where['CourseID'] = Yii::$app->session->get('courseCode');
        $where['QuestionType'] = ['1000205'];
        $list = $m_ques->find()->select(['QuestionBh', 'name', 'KnowledgeBh', 'Score', 'CustomBh', 'Stage', 'Checked'])
            ->where($where);

        //Tab
        $countList = clone $list;
        $pages = $com->Tab($countList);

        return $this->render('index', [
            'list' => $list->offset($pages->offset)->limit($pages->limit)->all(),
            'pages' => $pages,
            'stageChoice' => $stage,
            'stage' => $m_dic->getDictionaryList('题目阶段'),
            'dif' => $m_dic->getDictionaryList('题目难度'),
            //默认显示第一阶段知识点
            'defaultKnow' => $m_know->getByStage('1000301'),
        ]);
    }


    //添加简答题

    /* public function actionCreate()
     {
         $m_short = new Questions();
         $com = new commonFuc();
         $data = Yii::$app->request->post();
         $i = 1;

         if (isset($data)) {
             foreach ($data as $key => $dataT) {
                 if ($key != 'Answer' . $i && $key != 'id' && $key!='Questions') {
                     $m_short[$key] = $dataT;
                 } else if ($key == 'Answer' . $i) {
                     $m_short['Answer'] += $dataT . ',';
                 }

                 $m_short['QuestionBh'] = $com->create_id();
                  $m_short['IsProgramming'] = '100002';
                  $m_short['Checked'] = '100002';
                  $m_short['QuestionType'] = '1000205';
                  $m_short['AddTime'] = date('Y-m-d H:i:s');
                  $m_short['CourseID'] = \Yii::$app->session->get('courseCode');

                 /*if ($m_short->validate() && $m_short->save()) {
                     $com->JsonSuccess('添加成功');
                 } else {
                     $com->JsonSuccess('添加失败');
                 }*/
    /*foreach ($data['Answer' . $i] as $answer) {
        $m_short->Answer = $m_short->Answer . $answer . " ";
    }*/
    /* if($m_short->load($data)) {
         $m_short->QuestionBh = "1000205";

     }*/
    // echo json_decode($data);


    //echo json_encode($m_short);


    public function actionCreate()
    {
        $m_ques = new Questions();
        $com = new commonFuc();
        $data = Yii::$app->request->post();
        if ($m_ques->load(Yii::$app->request->post())) {
            $m_ques->QuestionBh = $com->create_id();
            $m_ques->CourseID = Yii::$app->session->get('courseCode');
            $answer = Yii::$app->request->post('Answer');
            //$m_ques->Answer = implode('|', $answer);
            $m_ques->QuestionType = '1000205';
            $m_ques->Checked = '100002';
            $i = 1;
            foreach ($data as $key => $value) {
                if ($key == "Answer.$i") {
                    $m_ques->Answer .= $value . '||';
                }
            }
            if ($m_ques->validate() && $m_ques->save()) {
                /* $com->JsonSuccess('添加成功');*/
            } else {
                $com->JsonFail($m_ques->getErrors());
            }
        } else {
            /*$com->JsonFail('数据出错');*/
        }

        echo json_encode($m_ques->load(Yii::$app->request->post()));

    }


    //删除简答题
    public function actionDelete()
    {
        $com = new commonFuc();
        $m_ques = new Questions();

        $ids = \Yii::$app->request->get('ids');
        if (count($ids) > 0) {
            foreach ($ids as $item) {
                $m_ques->deleteAll(['QuestionBh' => $item]);
            }
            $com->JsonSuccess('删除成功');

        }
    }

    //查看简答提

    public function actionView()
    {
        $m_ques = new Questions();

        $id = Yii::$app->request->get('id');
        if (isset($id)) {
            $data = $m_ques->find()->where(['QuestionBh' => $id])->asArray()->one();
        }

        echo json_encode($data);
    }

    //修改简答题
    public function actionUpdate()
    {
        $com = new commonFuc();
        $m_ques = new Questions();
        $id = Yii::$app->request->post('id');
        $update = $m_ques->findOne($id);
        if ($update->load(Yii::$app->request->post())) {
            if ($update->validate() && $update->save()) {
                $com->JsonSuccess('更新成功');
            } else {
                $com->JsonFail($m_ques->getErrors());
            }
        } else {
            $com->JsonFail('更新失败');
        }
    }


    public function actionDiff()
    {

        $m_dic = new TbcuitmoonDictionary();

        $diffBh = Yii::$app->request->get();
        if (isset($diffBh))
            $data = $m_dic->find()->where(['CuitMoon_DictionaryCode' => $diffBh])->asArray()->one();

        echo json_encode($data);

    }

    public function actionStage()
    {

        $m_dic = new TbcuitmoonDictionary();

        $stage = Yii::$app->request->get();
        if (isset($stage))
            $data = $m_dic->find()->where(['CuitMoon_DictionaryCode' => $stage])->asArray()->one();

        echo json_encode($data);

    }

    public function actionSee()
    {
        $m_ques = new Questions();
        $com = new commonFuc();
        $id = Yii::$app->request->get();
        $data = $m_ques->find()->where(["QuestionBh" => $id])->one();
        if (isset($id)) {
            $data = $m_ques->find()->where(["QuestionBh" => $id])->one();
            if ($data->Score == '1') {
                $data->Score = '0';
            } else {
                $data->Score = '1';
            }
            $data->save();
        }

        echo json_encode($data);
    }

    public function actionCheck()
    {
        $m_ques = new Questions();
        $com = new commonFuc();
        $id = Yii::$app->request->get();
        $data = $m_ques->find()->where(["QuestionBh" => $id])->one();
        if (isset($id)) {
            $data = $m_ques->find()->where(["QuestionBh" => $id])->one();
            if ($data->Checked == '100001') {
                $data->Checked = '100002';
            } else {
                $data->Checked = '100001';
            }
            $data->save();
        }
        echo json_encode($data);
    }


}