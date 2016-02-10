<?php

namespace OSC\ProductList;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$productName
		, $productType
		, $barcode
		, $detail
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'product_name',
				'detail',
				'barcode',
				'product_type'
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				product_name,
				detail,
				barcode,
				product_type
			FROM
				product_list
			WHERE
				id = '" . (int)$this->getId() . "'	
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Product List not found",
				404
			);
		}
		$this->setProperties($this->dbFetchArray($q));
	}

	public function update($id){
		if( !$id ) {
			throw new Exception("save method requires id to be set");
		}
		$this->dbQuery("
			UPDATE
				product_list
			SET
				product_name = '" . $this->getProductName() . "',
				product_type = '" . $this->getProductType() . "',
				barcode = '" . $this->getBarcode() . "',
				detail = '" . $this->getDetail() . "'
			WHERE
				id = '" . (int)$id . "'
		");

	}

	public function delete($id){
		if( !$id ) {
			throw new Exception("delete method requires id to be set");
		}
		$this->dbQuery("
			DELETE FROM
				product_list
			WHERE
				id = '" . (int)$id . "'
		");
	}

	public function insert(){
		$this->dbQuery("
			INSERT INTO
				product_list
			(
				product_name,
				detail,
				barcode,
				product_type,
				create_date
			)
				VALUES
			(
				'" . $this->getProductName() . "',
				'" . $this->getDetail() . "',
				'" . $this->getBarcode() . "',
				'" . $this->getProductType() . "',
 				NOW()
			)
		");
		$this->setId( $this->dbInsertId() );
	}

	public function setProductType( $string ){
		$this->productType = $string;
	}

	public function getProductType(){
		return $this->productType;
	}

	public function setBarcode( $string ){
		$this->barcode = $string;
	}

	public function getBarcode(){
		return $this->barcode;
	}

	public function setDetail( $string ){
		$this->detail = $string;
	}

	public function getDetail(){
		return $this->detail;
	}

	public function setProductName( $string ){
		$this->productName = $string;
	}
	
	public function getProductName(){
		return $this->productName;
	}

}
