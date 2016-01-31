<?php

namespace app\models;

use yii\db\ActiveRecord;
class User extends ActiveRecord{

	public function rules(){

		return [
			['id','integer'],
			['name','string','length'=>[0,20]]
		];
	}

	public function getIndent(){

		//一个user有多个indent，所以用hasMany()
		return $this->hasMany(Indent::className(),['user_id'=>'id'])->asArray();
		
	}
	
}

