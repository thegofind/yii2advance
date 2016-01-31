<?php

namespace frontend\controllers;

use yii\web\Controller;
use app\models\User;
use app\models\Indent;

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

	//关联查询
	public function actionQuery(){

		//查询用户名为chenhaoran的所有订单
		$user = User::find()->where(['name'=>'chenhaoran'])->one();
		$result = $user->indent;   //等同于$result = $user->hasMany(Indent::className(),['user_id'=>'id'])->asArray()->all();
		print_r($result);

		//查询拥有价格为23的订单的任一用户
		$indent = Indent::find()->where(['price'=>23])->one();
		$result1 = $indent->user;
		print_r($result1);


		//查询拥有价格为23的订单的所有用户
		$indents = Indent::find()->where(['price'=>123])->all();
		foreach ($indents as $indent) {
			$result2 = $indent->user;
			print_r($result2);
		}
		
	}

	//关联查询性能
	public function actionPerformance(){

		//释放关联查询缓存
		// $user = User::find()->where(['name'=>'chenhaoran']);
		// $user_obj = $user->one();
		// $user_arr = $user->asArray()->one();

		// $indent = $user_obj->indent; 	//结果会被缓存
		// print_r($indent);

		// //修改chenhaoran用户的一个订单的价格为777
		// $oneIndentOfUser = Indent::find()->where(['user_id'=>$user_arr['id']])->one();
		// $oneIndentOfUser['price']=777;
		// $oneIndentOfUser->save();
		
		// unset($user_obj->indent);  //释放掉缓存
		// $indent1 = $user_obj->indent;
		// print_r($indent1);

		//关联查询性能优化，需求：查询id大于3的所有用户的订单

		//未优化
		$users = User::find()->where(['>','id','3'])->all();
		foreach ($users as $user) {
			$indents = $user->indent;
			print_r($indents);
		}

		//已优化，等同于select * from indent where user_id in (...)
		$usersWith = User::find()->where(['>','id','3'])->with('indent')->all();
		foreach ($usersWith as $user) {
			$indents = $user->indent;
			print_r($indents);
		}
	}

}