<?php

namespace app\models;

use app\models\Product;

class CdProduct extends Product{

	public function getAddress(){

			parent::$address = 'address';
			return $this->address;
	}

}