<?php

namespace OSC\StockOut;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$stockOutDate
		, $customerId
		, $staffId
		, $grandTotal
		, $payment
		, $remain
		, $note
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'stock_out_date',
				'customer_id',
				'staff_id',
				'grand_total',
				'payment',
				'remain',
				'note',
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				stock_out_date,
				customer_id,
				staff_id,
				grand_total,
				payment,
				remain,
				note
			FROM
				stock_out
			WHERE
				id = '" . (int)$this->getId() . "'	
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Stock Out not found",
				404
			);
		}
		$this->setProperties($this->dbFetchArray($q));
	}

	public function insert(){
		$this->dbQuery("
			INSERT INTO
				stock_out
			(
				stock_out_date,
				customer_id,
				staff_id,
				grand_total,
				payment,
				remain,
				note
			)
				VALUES
			(
				'" . $this->getStockOutDate() . "',
				'" . $this->getCustomerId() . "',
				'" . $this->getStaffId() . "',
				'" . $this->getGrandTotal() . "',
				'" . $this->getPayment() . "',
				'" . $this->getRemain() . "',
				'" . $this->getNote() . "'
			)
		");
		$this->setProductsId( $this->dbInsertId() );
	}

	public function setNote( $string ){
		$this->note = $string;
	}

	public function getNote(){
		return $this->note;
	}

	public function setRemain( $string ){
		$this->remain = $string;
	}

	public function getRemain(){
		return $this->remain;
	}

	public function setPayment( $string ){
		$this->payment = $string;
	}

	public function getPayment(){
		return $this->payment;
	}

	public function setGrandTotal( $string ){
		$this->grandTotal = $string;
	}

	public function getGrandTotal(){
		return $this->grandTotal;
	}

	public function setStaffId( $string ){
		$this->staffId = (int)$string;
	}

	public function getStaffId(){
		return $this->staffId;
	}

	public function setCustomerId( $string ){
		$this->customerId = (int)$string;
	}

	public function getCustomerId(){
		return $this->customerId;
	}

	public function setStockOutDate( $string ){
		$this->stockOutDate = $string;
	}
	
	public function getStockOutDate(){
		return $this->stockOutDate;
	}
	
}
