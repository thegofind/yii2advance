<?php

namespace app\models;

use yii\db\ActiveRecord;
class User extends ActiveRecord{

	public function rules(){

		return [
			['id','integer'],
			['name','string','length'=>[0,7]]
		];
	}
	
}

