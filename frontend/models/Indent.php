<?php

namespace app\models;

use yii\db\ActiveRecord;
class Indent extends ActiveRecord{

	public function getUser(){

		//一个订单对应一个用户，所以用hasOne()
		return $this->hasOne(User::className(),['id'=>'user_id'])->asArray();
	}


}
