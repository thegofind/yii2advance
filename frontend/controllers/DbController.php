<?php

namespace frontend\controllers;

use yii\web\Controller;
use app\models\User;

class DbController extends Controller{

	//查询数据
	public function actionSearch(){

		$sql = 'select * from User where id=:id';
		$result = User::findBySql($sql,array(':id'=>'2 or 1=1'))->all();  //防止sql注入
		$result_toArray = User::findBySql($sql,array(':id'=>'2 or 1=1'))->asArray()->all();

		return $this->renderPartial('search',$result_toArray[0]);

		//print_r($result_toArray);  //可以不使用render()或renderPartial(),直接打印出结果

	}

	//查询数据
	//where的更多用法可以查看YII2类参考手册中的接口yii\db\QueryInterface
	public function actionSearch1(){

		//User::findBySql($sql,array(':id'=>'1'))->asArray()->batch(1)    is right
		//User::findBySql($sql,array(':id'=>'1'))->batch(1)->asArray()    is wrong
		foreach(User::find()->where(['>','id','1'])->asArray()->batch(1) as $users){
			print_r($users);
		}
	}

	//删除数据
	public function actionDelete(){

		// $result = User::find()->all();
		// $last_num = count($result)-1;

		//第一种方法：删除数据库中最后一行数据
		//$result[$last_num]->delete();

		//第二种方法：删除数据库中Id大于2的
		User::deleteAll('id>:id',array(':id'=>2));
	}

	//添加数据
	public function actionAdd(){

		$user = new User;
		$user->name = 'simon1';
		$user->mail = '432423@qq.com';
		$user->password = 'fsfhsdlfh';
		
		//数据验证，在User类中添加rules()对数据进行校验
		$user->validate();
		if($user->hasErrors()){
			echo 'your data is error';
			die;
		}
		$user->save();
	}

	//修改数据
	public function actionAlter(){

		$result = User::find()->where(['>','id','4'])->one();
		print_r($result);
		$result['name'] = 'chenduo';
		$result->save();
	}



}