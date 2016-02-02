<?php

namespace frontend\controllers;

use yii\web\Controller;
use app\models\Product;
use app\models\CdProduct;

class PhpController extends Controller{

	public function actionIndex(){

		$product = new Product('jielun',50);
		print_r($product->getProductName());
		print_r('<br>---------------<br>');


		$cdProduct = new CdProduct('jay',20);
		print_r($cdProduct->getProductName());
		//print_r($cdProduct->getAddress());   //子类无法使用parent::$address访问父类的私有属性
	}
	
//实例无法访问类中的private和protected方法和属性
//子类默认继承父类的所有方法和属性
//private方法和函数，子类仅仅只是继承，无法修改
}