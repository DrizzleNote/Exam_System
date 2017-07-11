<?php
namespace app\modules\question\controllers;

use app\controllers\BaseController;
use app\models\system\TbcuitmoonDictionary;


class StatusController extends BaseController
{
	public function actionIndex()
    {
    	$status = TbcuitmoonDictionary::find()->where(['CuitMoon_DictionaryName'=>'设置题库状态'])->asArray()->one()['CuitMoon_DictionaryCode'];
    	return $this->render('index',['status'=>$status]);
    }

    public function actionChange()
    {
    	$info = \Yii::$app->request->post();
    	TbcuitmoonDictionary::updateAll(['CuitMoon_DictionaryCode'=>$info['status']],['CuitMoon_DictionaryName'=>'设置题库状态']);
    	echo '成功';
    }
}
