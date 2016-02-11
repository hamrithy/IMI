<?php

namespace OSC\Products;

use
	Aedea\Core\Database\StdObject as DbObj
	, OSC\ProductsType\Collection
			as ProductTypeCol
;

class Object extends DbObj {
		
	protected
		$productsPrice
		, $productsName
		, $productsQuantity
		, $productsTypeFields
		, $productsTypeId
		, $productsDescription
		, $barcode
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'products_price',
				'status',
				'products_quantity',
				'products_type_fields',
				'barcode',
				'products_description',
				'products_name'
			)
		);
		return parent::toArray($args);
	}

	public function __construct( $params = array() ){
 		parent::__construct($params);
		
 		$this->productsTypeFields = new ProductTypeCol();
	}

	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				products_price,
				status,
				products_quantity,
				products_description,
				products_name,
				products_type_id,
				barcode
			FROM
				products
			WHERE
				id = '" . (int)$this->getId() . "'
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Products not found",
				404
			);
		}
		
		$this->setProperties($this->dbFetchArray($q));

 		$this->productsTypeFields->setFilter('id', $this->getProductsTypeId());
 		$this->productsTypeFields->populate();

	}
	
	public function updateStatus($id) {
		if( !$id ) {
			throw new Exception("save method requires id");
		}
		$this->dbQuery("
			UPDATE
				products
			SET 
				status = '" . (int)$this->getStatus() . "'
			WHERE
				products_id = '" . (int)$id . "'
		");
	}

	public function delete($id){
		if( !$id ) {
			throw new Exception("delete method requires id to be set");
		}
		$this->dbQuery("
			DELETE FROM
				products
			WHERE
				id = '" . (int)$id . "'
		");
	}

	public function update($id){
		$this->dbQuery("
			UPDATE
				products
			SET
				products_name = '" . $this->getProductsName() . "',
				products_description = '" . $this->getProductsDescription() . "',
 				products_price = '" . $this->getProductsPrice() . "',
 				barcode = '" . $this->getBarcode() . "',
 				products_type_id = '" . $this->getProductsTypeId() . "'
			WHERE
				id = '" . (int)$id . "'
		");
		
	}
	
	public function insert(){	
		$this->dbQuery("
			INSERT INTO
				products
			(
				products_quantity,
				products_name,
				products_price,
				products_description,
				products_type_id,
				barcode,
				status,
				create_date
			)
				VALUES
			(
				'" . (int)$this->getProductsQuantity() . "',
				'" . $this->getProductsName() . "',
 				'" . $this->getProductsPrice() . "',
				'" . $this->getProductsDescription() . "',
				'" . $this->getProductsTypeId() . "',
				'" . $this->getBarcode() . "',
 				1,
 				NOW()
			)
		");	
		$this->setId( $this->dbInsertId() );
	}
	
	public function setProductsDescription( $string ){
		$this->productsDescription = $string;
	}
	
	public function getProductsDescription(){
		return $this->productsDescription;
	}
	
	public function setProductsName( $string ){
		$this->productsName = $string;
	}
	
	public function getProductsName(){
		return $this->productsName;
	}
	
	public function setProductsQuantity( $int ){
		$this->productsQuantity = (int)$int;
	}
	
	public function getProductsQuantity(){
		return $this->productsQuantity;
	}
	
	public function setProductsTypeFields( $type ){
		$this->productsTypeFields = $type;
	}
	
	public function getProductsTypeFields(){
		return $this->productsTypeFields;
	}

	public function setProductsTypeId( $type ){
		$this->productsTypeId = $type;
	}

	public function getProductsTypeId(){
		return $this->productsTypeId;
	}

	public function getProductsPrice(){
		return $this->productsPrice;
	}
	public function setProductsPrice( $int ){
		$this->productsPrice = $int;
	}

	public function getBarcode(){
		return $this->barcode;
	}
	public function setBarcode( $int ){
		$this->barcode = $int;
	}

}
