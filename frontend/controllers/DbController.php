<?php

namespace frontend\controllers;

use yii\web\Controller;
use app\models\User;

class DbController extends Controller{

	public function actionIndex(){

		$sql = 'select * from User where Id=:id';
		$result = User::findBySql($sql,array(':id'=>'2 or 1=1'))->all();  //防止sql注入
		$result_toArray = User::findBySql($sql,array(':id'=>'2 or 1=1'))->asArray()->all();

		return $this->renderPartial('index',$result_toArray[0]);

		//print_r($result_toArray);  //可以不使用render()或renderPartial(),直接打印出结果

	}

	public function actionIndex1(){

		$sql = 'select * from User where Id>:id';

		//User::findBySql($sql,array(':id'=>'1'))->asArray()->batch(1)    is right
		//User::findBySql($sql,array(':id'=>'1'))->batch(1)->asArray()    is wrong
		foreach(User::findBySql($sql,array(':id'=>'1'))->asArray()->batch(1) as $users){
			print_r($users);
		}
	}

}