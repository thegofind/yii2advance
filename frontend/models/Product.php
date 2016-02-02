<?php

namespace app\models;

class Product{

	private $productName;
	private $price;
	private $address;

	// protected $productName;
	// protected $price;


	public function __construct($productName,$price){

		$this->productName = $productName;
		$this->price = $price;

	}

	public function getProductName(){
		return $this->productName;
	}

	public function getPrice(){
		return $this->price;
	}

}