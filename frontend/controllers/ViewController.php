<?php

namespace frontend\controllers;

use yii\web\Controller;

class ViewController extends Controller{

	//视图创建
	public function actionIndex(){

		return $this->renderPartial('index');

	}

	//参数传递
	public function actionIndex1(){

		$user_name = 'chen';
		$user_phone = array(123,456);

		$data = array();
		$data['view_name'] = $user_name;
		$data['view_phone'] = $user_phone;
		return $this->renderPartial('index1',$data);	//传递的参数必须为数组

	}

	//数据安全
	public function actionIndex2(){

		$hello = 'hello world<script>alert(333);</script>';

		$data = array();
		$data['say_hi'] = $hello; 
		return $this->renderPartial('index2',$data);

	}

	//布局文件
	public $layout = 'common';
	public function actionIndex3(){

		return $this->render('index3');  //将index3放入$content中
	}

	
}