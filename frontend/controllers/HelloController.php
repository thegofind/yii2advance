<?php

namespace frontend\controllers;

use yii\web\Controller;

class HelloController extends Controller{

	public function actionIndex(){

		// 获取请求值
		// http://localhost/advanced/frontend/web/index.php?r=tuzhi/index&id=1990

		// $request = \YII::$app->request;
		// echo $request->get('id');


		// 开启并设置session
		// session保存目录可以在配置文件php.ini中查看(搜索session.save_path)

		// $session = \YII::$app->session;
		// $session->set('user','chen');
		// $session->get('user');
		// $session->remove('user');

		$session['product'] = 'surface3';
		echo $session['product'];
		unset($session['product']);

	}
}



