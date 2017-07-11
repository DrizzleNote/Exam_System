<?php

namespace app\modules\question\controllers;

use app\modules\question\controllers\QuestionbaseController;
use app\models\question\Compileinfo;
use app\models\question\Custominput;
use app\models\question\Knowledgepoint;
use app\models\question\Problem;
use app\models\question\Questions;
use app\models\question\Runtimeinfo;
use app\models\question\Solution;
use app\models\question\SourceCode;
use app\models\question\SourceCodeUser;
use app\models\question\Testcase;
use app\models\system\TbcuitmoonDictionary;
use app\modules\system\controllers\DictionaryController;
use common\commonFuc;
use Yii;
use yii\base\Exception;
use yii\helpers\HtmlPurifier;

class ProgramController extends QuestionbaseController
{

    

    //Rendering programing problem home page
    public function actionIndex(){

        $m_dic = new TbcuitmoonDictionary();
        $m_ques = new Questions();
        $com = new commonFuc();

        //is Stage
        $stage  = Yii::$app->request->get();
        if(isset($stage['stage'])){
            $where = [
                'Stage' => $stage['stage'],
            ];
        }
        $where['CourseID'] = Yii::$app->session->get('courseCode');
        $where['QuestionType'] = ['1000206',];
        $list = $m_ques->find()->select(['QuestionBh','name','KnowledgeBh','CustomBh','Stage','Score','Checked'])
            ->where($where);

        //Tab
        $countList = clone $list;
        $pages = $com->Tab($countList);

        return $this->render('index',[
            'list' => $list->offset($pages->offset)->limit($pages->limit)->all(),
            'pages' => $pages,
            'stageChoice' => $stage,
            'stage' => $m_dic->getDictionaryList('题目阶段'),
            'dif' => $m_dic->getDictionaryList('题目难度'),
        ]);
    }

    
    //新增编程题
    public function actionAdd()
    {
        if(\Yii::$app->request->isPost)
        {
            $dic = new TbcuitmoonDictionary();
            $post = \Yii::$app->request->post();
            $com = new commonFuc();
            $new_q = new Questions();
            $new_q['QuestionBh'] = $com->create_id();//id
            $new_q['CourseID'] = \Yii::$app->session->get('courseCode');//课程id
            $new_q['QuestionType'] = '1000206';//编程题字典
            $new_q['CustomBh'] = $post['CustomBh'];//题目名字
            $new_q['IsProgramming'] = '100001';
            $new_q['Stage'] = $post['Stage'];//阶段
            $new_q['KnowledgeBh'] = $post['KnowledgeBh'];//知识点
            $new_q['Score'] = $post['Score'];//是否可见（神奇的字段名）
            $new_q['Difficulty'] = $post['Difficulty'];//难度等级
            $new_q['name'] = $post['name'];//题目名
            $tmp['key']['0']['code'] = $post['SourceCode'];
            $new_q['SourceCode'] = json_encode($tmp);//代码
            $new_q['Memo'] = $post['Memo'];//备注
            $new_q['Description'] = $post['Description'];
            $new_q['IsProgramBlank'] = $post['IsProgramBlank']=='1' ? '100001' : '100002';
            $new_q['AddTime'] = date('Y-m-d H:i:s');
            if($post['IsProgramBlank']=='1')
            {
                $new_q['StartTag'] = $post['StartTag'];
                $new_q['EndTag'] = $post['EndTag'];
            }
            $new_q['Checked'] = '100002';
            if($new_q->validate() && $new_q->save())
            {
                if(isset($post['test']))
                {
                    $test = $post['test'];
                    foreach ($test as $key => $value) {
                        $new_t = new Testcase();
                        $new_t['TestCaseBh'] = $com->create_id();
                        $new_t['ScoreWeight'] = $value['ScoreWeight'];
                        $new_t['TestCaseInput'] = $value['Input'];
                        $new_t['TestCaseOutput'] = $value['Output'];
                        $new_t['QuestionId'] = $new_q['QuestionBh'];
                        $new_t['Memo'] = $value['Memo'];
                        $new_t->save();
                    }
                }
                echo '添加成功';
            }
        }
    }
//     public function actionCreate(){
//         $m_ques = new Questions();
//         $com = new commonFuc();

//         $data = Yii::$app->request->post();
//         if($m_ques->load($data)){


//             $m_ques->QuestionBh = $com->create_id();
//             $m_ques->CourseID = Yii::$app->session->get('courseCode');
//             $m_ques->QuestionType = '1000206';
//             if($m_ques->save()) {

//                 foreach ($data['input'] as $key => $value) {
//                     $m_problem = new Problem();
//                     $m_problem->memory_limit = 128;
//                     $m_problem->time_limit = 1;
//                     $m_problem->save();
//                     $problemID = $m_problem->attributes['problem_id'];

//                     $m_case = new Testcase();
//                     $m_case->Memo = (string)$problemID;
//                     $m_case->TestCaseBh = $com->create_id();
//                     $m_case->TestCaseInput = $value;
//                     $m_case->TestCaseOutput = $data['output'][$key];
//                     $m_case->ScoreWeight = $data['score'][$key];
//                     $m_case->QuestionId = $m_ques->QuestionBh;
//                     $m_case->save();

// //                    $path = __DIR__ . '/../../../../../Question_TestCase';
// //                    $com->mkData($problemID, 'test.in', $value, $path);
// //                    $com->mkData($problemID, 'test.out', $data['output'][$key], $path);

//                 }
//                 $com->JsonSuccess('添加成功');
//             }
//         }else{
//             $com->JsonFail('数据错误');
//         }
//     }


    /**
     * ajax compilation
     * @return json
     */
    public function actionGetCase(){
        $Time = 3;
        $input_text = stripcslashes(Yii::$app->request->post('input_text'));
        $code = Yii::$app->request->post('code');
        $input_text = preg_replace("(\r\n)","\n",$input_text);
        $ID = \Yii::$app->request->post("ID");
        $m_problem = new Problem();

        $com = new commonFuc();
        $m_problem->title = $ID;
        $m_problem->in_date = date("Y-m-d H:i:s");
        $m_problem->time_limit = 1;
        $m_problem->memory_limit = 128;
        $m_problem->defunct = 'N';

        
        $m_problem->save();
        //获取对应的problem id
        $ProblemId = $m_problem->attributes['problem_id'];
        

        $path =  "/home/judge/data";
//                $path = __DIR__ . '/../../../Question_TestCase';
        $com->mkData($ProblemId, 'test.in', $input_text, $path);
        // $this->mkData($ProblemId, 'test.out', $value->TestCaseOutput, $path);
        $x = shell_exec("cp ".$_SERVER['DOCUMENT_ROOT']."/QuestionFile/".$ID."/* /home/judge/data/".$ProblemId);

        // var_dump($x);
        // $value->Memo = (string)$ProblemId;
        // $value->save();

  
        $m_solution = new Solution();
        $m_source = new SourceCode();
        $m_source_user = new SourceCodeUser();
        $m_run_info = new Runtimeinfo();
        $m_compile = new Compileinfo();

        $m_solution->problem_id = $ProblemId;
        $m_solution->user_id = 'admin';
        $m_solution->in_date = date("Y-m-d H:i:s");
        $m_solution->language = $com->nameTranCode(\Yii::$app->session->get('courseCode'));
        $m_solution->code_length = strlen($code);
        $m_solution->ip = $com->getClientIp();
        $m_solution->save();
        $SolutionID = $m_solution->attributes['solution_id'];


        $m_source->solution_id = $SolutionID;
        $m_source->source = $code;
        $m_source_user->solution_id = $SolutionID;
        $m_source_user->source = $code;

        $m_source->save();
        $m_source_user->save();





        //sleep($Time);
        $result = 0;
        //Poll Table solution until compilation is complete
        while($result != 11 && $result != 13){
            $result = $m_solution->find()->select(['result'])
                ->where([
                    'solution_id' => $SolutionID,
                ])->asArray()->one();
            $result = $result['result'];
            //Compile successful
            if($result ==  13 || $result ==  10 || $result == 9) {
                $Tmp = $m_run_info->find()->select(['error'])
                    ->where([
                        'solution_id' => $SolutionID,
                    ])->asArray()->one();
                echo $Tmp['error'];
                die;
            }
            //Compile failed
            if($result == 11){
                $Tmp = $m_compile->find()->select(['error'])
                    ->where([
                        'solution_id' => $SolutionID,
                    ])->asArray()->one();
                echo $Tmp['error'];
                die;
            }
        }
        /*
        $m_input = new Custominput();
        $m_solution = new Solution();
        $m_source = new SourceCode();
        $m_source_code = new SourceCodeUser();
        $m_run_info = new Runtimeinfo();
        $m_compile = new Compileinfo();
        $com = new commonFuc();

        $input_text = stripcslashes(Yii::$app->request->post('input_text'));
        $code = Yii::$app->request->post('code');
        $input_text = preg_replace("(\r\n)","\n",$input_text);
        $m_solution->problem_id = 0;
        $m_solution->user_id = 'admin';
        $m_solution->in_date = date('Y-m-d H:i:s');
        $m_solution->language = 0;
        $m_solution->ip = $com->getClientIp();
        $m_solution->code_length = strlen($code);
        $db = Yii::$app->db;
        try {
            $m_solution->save();
        }catch (Exception $e){
            echo $m_solution->getErrors();
        }
        $solution_id = $m_solution->attributes['solution_id'];
        $m_source->solution_id = $solution_id;
        $m_source->source = $code;
        $m_source_code->solution_id = $solution_id;
        $m_source_code->source = $code;
        $m_input->solution_id = $solution_id;
        $m_input->input_text = $input_text;
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $m_input->save();
            $db->createCommand('insert into source_code (solution_id,source) VALUES (:solution_id,:source)',[
                ':solution_id' => $solution_id,
                ':source' => $code,
            ])->execute();
            $db->createCommand('insert into source_code_user (solution_id,source) VALUES (:solution_id,:source)',[
                ':solution_id' => $solution_id,
                ':source' => $code,
            ])->execute();
            $transaction->commit();
        }catch (Exception $e){
            $transaction->rollBack();
        }

        $result = 0;
        //Poll Table solution until compilation is complete
        while($result != 11 && $result != 13){
            $result = $m_solution->find()->select(['result'])
                ->where([
                    'solution_id' => $solution_id,
                ])->asArray()->one();
            $result = $result['result'];
            //Compile successful
            if($result ==  13) {
                $Tmp = $m_run_info->find()->select(['error'])
                    ->where([
                        'solution_id' => $solution_id,
                    ])->asArray()->one();
                echo $Tmp['error'];
            }
            //Compile failed
            if($result == 11){
                $Tmp = $m_compile->find()->select(['error'])
                    ->where([
                        'solution_id' => $solution_id,
                    ])->asArray()->one();
                echo $Tmp['error'];
            }
        }
        */

    }
    //获取一个编程题信息
    public function actionGetProgram()
    {
        if(\Yii::$app->request->isPost)
        {
            $post = \Yii::$app->request->post();
            if(isset($post['QuestionBh']))
            {
                $aim = Questions::find()->where(['QuestionBh'=>$post['QuestionBh']])->asArray()->one();
                $aim['DifficultyCode'] = $aim['Difficulty'];
                $aim['Difficulty'] = TbcuitmoonDictionary::find()->where(['CuitMoon_DictionaryCode'=>$aim['Difficulty']])->asArray()->one()['CuitMoon_DictionaryName'];
                $aim['StageCode'] = $aim['Stage'];
                $aim['SourceCode'] = json_decode($aim['SourceCode'],true)['key']['0']['code'];
                $aim['Stage'] = TbcuitmoonDictionary::find()->where(['CuitMoon_DictionaryCode'=>$aim['Stage']])->asArray()->one()['CuitMoon_DictionaryName'];
                $aim['KnowledgeBhCode'] = $aim['KnowledgeBh'];
                $aim['KnowledgeBh'] = (new Knowledgepoint())->idTranName($aim['KnowledgeBh']);
                $aim['TestCase'] = Testcase::find()->where(['QuestionId'=>$aim['QuestionBh']])->asArray()->all();

                echo json_encode($aim);
            }
        }
    }

    //搜索编程题信息
    public function actionSearchProgram()
    {
        if(\Yii::$app->request->isPost)
        {
            $post = \Yii::$app->request->post();
            if(isset($post['key']))
            {
                $aim = Questions::find()
                 // and CourseID=:CourseID 
                ->where("QuestionType=:QuestionType and CourseID=:CourseID and CustomBh like :CustomBh or QuestionType=:QuestionType and CourseID=:CourseID  and name like :name ", [  
                    ':QuestionType' => '1000206',  
                    ':CourseID' => \Yii::$app->session->get('courseCode'),
                    ':CustomBh' => '%'.$post['key'].'%',
                    ':name' => '%'.$post['key'].'%'
                ])
                ->limit(10)
                ->asArray()->all();
                foreach ($aim as $key => $value) {
                    $aim[$key]['DifficultyCode'] = $aim[$key]['Difficulty'];
                    $aim[$key]['Difficulty'] = TbcuitmoonDictionary::find()->where(['CuitMoon_DictionaryCode'=>$aim[$key]['Difficulty']])->asArray()->one()['CuitMoon_DictionaryName'];
                    $aim[$key]['StageCode'] = $aim[$key]['Stage'];
                    $aim[$key]['SourceCode'] = json_decode($aim[$key]['SourceCode'],true)['key']['0']['code'];
                    $aim[$key]['Stage'] = TbcuitmoonDictionary::find()->where(['CuitMoon_DictionaryCode'=>$aim[$key]['Stage']])->asArray()->one()['CuitMoon_DictionaryName'];
                    $aim[$key]['KnowledgeBhCode'] = $aim[$key]['KnowledgeBh'];
                    $aim[$key]['KnowledgeBh'] = (new Knowledgepoint())->idTranName($aim[$key]['KnowledgeBh']);
                    $aim[$key]['TestCase'] = Testcase::find()->where(['QuestionId'=>$aim[$key]['QuestionBh']])->asArray()->all();
                }
                

                echo json_encode($aim);
            }
        }
    }
    //重写删除编程题方法
    public function actionDelete()
    {
        $com = new commonFuc();
        $m_ques = new Questions();

        $ids = \Yii::$app->request->get('ids');
        if (count($ids) > 0) {
            foreach ($ids as $item) {
                Testcase::deleteAll(['QuestionId'=>$item]);
                $m_ques->deleteAll(['QuestionBh' => $item]);
            }
            $com->JsonSuccess('删除成功');

        }
    }
   
    //获取困难等级
    public function actionGetDiff()
    {
        $m_dic = new TbcuitmoonDictionary();
        echo json_encode($m_dic->getDictionaryListAsArray('题目难度'));
    } 
    //删除一个测试用例
    public function actionDeleteTestCase()
    {
        if(\Yii::$app->request->isPost)
        {
            $post = \Yii::$app->request->post();
            if(isset($post['TestCaseBh']) && $post['TestCaseBh'])
            {
                Testcase::deleteAll(['TestCaseBh'=>$post['TestCaseBh']]);
                echo '删除成功';
            }
        }
    }

    public function actionUpdateTest()
    {
        $QuestionBh = \Yii::$app->request->post("QuestionBh");
        $allTest = Testcase::find()->where(['QuestionId'=>$QuestionBh])->asArray()->all();
        $Question = Questions::find()->where(['QuestionBh'=>$QuestionBh])->asArray()->one();
        $Question['SourceCode'] = json_decode($Question['SourceCode'],true)['key']['0']['code'];
        foreach ($allTest as $key1 => $value1)
        {

            $res = $this->tool($QuestionBh,$value1['TestCaseInput'], $Question['SourceCode']);

            Testcase::updateAll(['TestCaseOutput'=>$res],['TestCaseBh'=>$value1['TestCaseBh']]);

        }

        echo "更新完毕";

    }

    //更新所有测试用例
    public function actionAll()
    {
        // ->andWhere(['<>','IsProgramBlank'=>'100001'])
        $all = Questions::find()->select(['QuestionBh','SourceCode'])->where('QuestionType=\'1000206\' AND IsProgramBlank!=\'100001\' order by QuestionBh ASC')->asArray()->all();
        foreach ($all as $key => $value) {
            $all[$key]['SourceCode'] = json_decode($all[$key]['SourceCode'],true)['key']['0']['code'];
            // print_r($allTest);
            // Testcase::find()

        }
        $i=0;
        foreach ($all as $key => $value) {
            // if($value['QuestionBh'] == 'e4677fd902e843458787f9f34de94886')
            // {

            $allTest = Testcase::find()->where(['QuestionId'=>$value['QuestionBh']])->asArray()->all();
            // print_r($allTest);
            
            foreach ($allTest as $key1 => $value1) {
                if($value1['Memo'] != '1')
                {
                    $res = $this->tool($value['QuestionBh'],$value1['TestCaseInput'], $value['SourceCode']);
                    if($res != 'Runtime Error:Segmentation fault
    ')
                    {
                        Testcase::updateAll(['TestCaseOutput'=>$res,'Memo'=>'1'],['TestCaseBh'=>$value1['TestCaseBh']]);
                    }
                }
                
                
            }
            // }
            // $i++;
            // if($i>10)
                // die;
            // break;
        }
        // print_r($all);
        // echo count($all);
    }
    //input_text(输入)//code(代码)
    public function tool($ID,$input_text,$code)
    {
        $Time = 3;
        $input_text = preg_replace("(\r\n)","\n",$input_text);
        $m_problem = new Problem();

        $com = new commonFuc();
        $m_problem->title = $ID;
        $m_problem->in_date = date("Y-m-d H:i:s");
        $m_problem->time_limit = 1;
        $m_problem->memory_limit = 128;
        $m_problem->defunct = 'N';

        
        $m_problem->save();
        //获取对应的problem id
        $ProblemId = $m_problem->attributes['problem_id'];
        

        $path =  "/home/judge/data";
//                $path = __DIR__ . '/../../../Question_TestCase';
        $com->mkData($ProblemId, 'test.in', $input_text, $path);
        // $this->mkData($ProblemId, 'test.out', $value->TestCaseOutput, $path);
        $x = shell_exec("cp ".$_SERVER['DOCUMENT_ROOT']."/QuestionFile/".$ID."/* /home/judge/data/".$ProblemId);
  
        $m_solution = new Solution();
        $m_source = new SourceCode();
        $m_source_user = new SourceCodeUser();
        $m_run_info = new Runtimeinfo();
        $m_compile = new Compileinfo();

        $m_solution->problem_id = $ProblemId;
        $m_solution->user_id = 'admin';
        $m_solution->in_date = date("Y-m-d H:i:s");
        $m_solution->language = $com->nameTranCode(\Yii::$app->session->get('courseCode'));
        $m_solution->code_length = strlen($code);
        $m_solution->ip = $com->getClientIp();
        $m_solution->save();
        $SolutionID = $m_solution->attributes['solution_id'];


        $m_source->solution_id = $SolutionID;
        $m_source->source = $code;
        $m_source_user->solution_id = $SolutionID;
        $m_source_user->source = $code;

        $m_source->save();
        $m_source_user->save();

        //sleep($Time);
        $result = 0;
        //Poll Table solution until compilation is complete
        while($result != 11 && $result != 13){
            $result = $m_solution->find()->select(['result'])
                ->where([
                    'solution_id' => $SolutionID,
                ])->asArray()->one();
            $result = $result['result'];
            //Compile successful
            if($result ==  13 || $result ==  10) {
                $Tmp = $m_run_info->find()->select(['error'])
                    ->where([
                        'solution_id' => $SolutionID,
                    ])->asArray()->one();
                return $Tmp['error'];;
            }
            //Compile failed
            if($result == 11){
                $Tmp = $m_compile->find()->select(['error'])
                    ->where([
                        'solution_id' => $SolutionID,
                    ])->asArray()->one();
                return $Tmp['error'];
            }
        }
        return 0;
        /*
        $m_input = new Custominput();
        $m_solution = new Solution();
        $m_source = new SourceCode();
        $m_source_code = new SourceCodeUser();
        $m_run_info = new Runtimeinfo();
        $m_compile = new Compileinfo();
        $com = new commonFuc();

        //$input_text = stripcslashes(Yii::$app->request->post('input_text'));
        //$code = Yii::$app->request->post('code');
        $input_text = preg_replace("(\r\n)","\n",$input_text);
        $m_solution->problem_id = 0;
        $m_solution->user_id = 'admin';
        $m_solution->in_date = date('Y-m-d H:i:s');
        $m_solution->language = 0;
        $m_solution->ip = $com->getClientIp();
        $m_solution->code_length = strlen($code);
        $db = Yii::$app->db;
        try {
            $m_solution->save();
        }catch (Exception $e){
            return 0;
            // echo $m_solution->getErrors();
        }
        $solution_id = $m_solution->attributes['solution_id'];
        $m_source->solution_id = $solution_id;
        $m_source->source = $code;
        $m_source_code->solution_id = $solution_id;
        $m_source_code->source = $code;
        $m_input->solution_id = $solution_id;
        $m_input->input_text = $input_text;
        $transaction = Yii::$app->db->beginTransaction();
        try{
            $m_input->save();
            $db->createCommand('insert into source_code (solution_id,source) VALUES (:solution_id,:source)',[
                ':solution_id' => $solution_id,
                ':source' => $code,
            ])->execute();
            $db->createCommand('insert into source_code_user (solution_id,source) VALUES (:solution_id,:source)',[
                ':solution_id' => $solution_id,
                ':source' => $code,
            ])->execute();
            $transaction->commit();
        }catch (Exception $e){
            $transaction->rollBack();
        }

        $result = 0;
        //Poll Table solution until compilation is complete
        while($result != 11 && $result != 13){
            $result = $m_solution->find()->select(['result'])
                ->where([
                    'solution_id' => $solution_id,
                ])->asArray()->one();
            $result = $result['result'];
            //Compile successful
            if($result ==  13) {
                $Tmp = $m_run_info->find()->select(['error'])
                    ->where([
                        'solution_id' => $solution_id,
                    ])->asArray()->one();
                return $Tmp['error'];
            }
            //Compile failed
            if($result == 11){
                // $Tmp = $m_compile->find()->select(['error'])
                //     ->where([
                //         'solution_id' => $solution_id,
                //     ])->asArray()->one();
                // echo $Tmp['error'];
                return 0;
            }
        }
        return 0;
        */
    }

    //获取一个测试用例
    public function actionGetTestCase()
    {
        if(\Yii::$app->request->isPost)
        {
            $post = \Yii::$app->request->post();
            if(isset($post['QuestionBh']) && $post['QuestionBh'])
                echo json_encode(Testcase::find()->where(['QuestionId'=>$post['QuestionBh']])->asArray()->all());
        }
    }
    //填加一个测试用例
    public function actionAddTestCase()
    {
        if(\Yii::$app->request->isPost)
        {
            $post = \Yii::$app->request->post();
            if(isset($post['QuestionId']) && $post['QuestionId'])
            {
                $arr = Testcase::find()->where(['QuestionId'=>$post['QuestionId']])->asArray()->all();
                $sum = 0;
                foreach ($arr as $key => $value) {
                    $sum += $value['ScoreWeight'];
                }
                $sum += (int)$post['ScoreWeight'];
                if($sum <= 100 )
                {
                    $com = new commonFuc();
                    $new = new Testcase();
                    $new['TestCaseBh'] = $com->create_id();
                    foreach ($post as $key => $value) {
                        $new[$key] = $value;
                    }
                    
                    if($new->validate() && $new->save())
                        echo "添加成功";
                    else 
                        echo '数据有误，添加失败';
                }
                else
                {
                    echo "添加失败，请检查分数是否已经超过100";
                } 
            }
        }
    }
    //更新一个编程题
    public function actionUpdateProgram()
    {
        if(\Yii::$app->request->isPost)
        {
            $post = \Yii::$app->request->post();
            $tmp['key']['0']['code'] = $post['SourceCode'];
            
            $post['IsProgramBlank'] = $post['IsProgramBlank']=='1' ? '100001' : '100002';
            
            $post['SourceCode'] = json_encode($tmp);
            Questions::updateAll($post,['QuestionBh'=>$post['QuestionBh']]);
            echo "更新成功";
        }
    }

}
