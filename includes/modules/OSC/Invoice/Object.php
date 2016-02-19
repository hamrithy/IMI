<?php

namespace OSC\Invoice;

use
	Aedea\Core\Database\StdObject as DbObj
	, OSC\InvoiceDetail\Collection
		as  InvoiceDetailCol
;

class Object extends DbObj {
		
	protected
		$invoiceNo
		, $invoiceDate
		, $customerTypeId
		, $doctorId
		, $total
		, $noted
		, $payType
		, $subTotal
		, $discount
		, $discountType
		, $totalDiscount
		, $grandTotal
		, $deposit
		, $balance
		, $detail
		, $doctorName
		, $customerId
	;

	public function __construct( $params = array() ){
		parent::__construct($params);
		$this->detail = new InvoiceDetailCol();
	}

	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'invoice_no',
				'customer_type_id',
				'doctor_id',
				'noted',
				'total',
				'pay_type',
				'sub_total',
				'discount',
				'discount_type',
				'total_discount',
				'grand_total',
				'deposit',
				'balance',
				'detail',
				'doctor_name',
				'customer_id',
				'invoice_date'
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				invoice_no,
				customer_type_id,
				doctor_id,
				noted,
				total,
				pay_type,
				sub_total,
				discount,
				discount_type,
				total_discount,
				grand_total,
				deposit,
				invoice_date,
				balance,
				customer_id,
				doctor_name
			FROM
				invoice
			WHERE
				id = '" . (int)$this->getId() . "'	
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Invoice not found",
				404
			);
		}
		$this->setProperties($this->dbFetchArray($q));
		$this->detail->setFilter('id', $this->getInvoiceNo());
		$this->detail->populate();
	}

	public function update($id){
		if( !$id ) {
			throw new Exception("save method requires id to be set");
		}
		$this->dbQuery("
			UPDATE
				customer_type
			SET
				name = '" . $this->getName() . "',
				description = '" . $this->getDescription() . "'
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
				customer_type
			WHERE
				id = '" . (int)$id . "'
		");
	}

	public function insert(){
		$this->dbQuery("
			INSERT INTO
				invoice
			(
				invoice_no,
				invoice_date,
				customer_type_id,
				doctor_id,
				noted,
				total,
				pay_type,
				sub_total,
				discount,
				discount_type,
				total_discount,
				grand_total,
				deposit,
				balance,
				create_by,
				create_date
			)
				VALUES
			(
				'" . $this->getInvoiceNo() . "',
				'" . $this->getInvoiceDate() . "',
				'" . $this->getCustomerTypeId() . "',
				'" . $this->getDoctorId() . "',
				'" . $this->getNoted() . "',
				'" . $this->getTotal() . "',
				'" . $this->getPayType() . "',
				'" . $this->getSubTotal() . "',
				'" . $this->getDiscount() . "',
				'" . $this->getDiscountType() . "',
				'" . $this->getTotalDiscount() . "',
				'" . $this->getGrandTotal() . "',
				'" . $this->getDeposit() . "',
				'" . $this->getBalance() . "',
				'" . $this->getCreateBy() . "',
 				NOW()
			)
		");
		$this->setId( $this->dbInsertId() );
	}

	public function setDoctorName( $string ){
		$this->doctorName = $string;
	}

	public function getDoctorName(){
		return $this->doctorName;
	}

	public function setCustomerId( $string ){
		$this->customerId = $string;
	}

	public function getCustomerId(){
		return $this->customerId;
	}

	public function setDetail( $string ){
		$this->detail = $string;
	}

	public function getDetail(){
		return $this->detail;
	}

	public function setInvoiceDate( $string ){
		$this->invoiceDate = $string;
	}

	public function getInvoiceDate(){
		return $this->invoiceDate;
	}

	public function setInvoiceNo( $string ){
		$this->invoiceNo = $string;
	}

	public function getInvoiceNo(){
		return $this->invoiceNo;
	}

	public function setNoted( $string ){
		$this->noted = $string;
	}
	
	public function getNoted(){
		return $this->noted;
	}

	public function setTotal( $string ){
		$this->total = $string;
	}

	public function getTotal(){
		return $this->total;
	}

	public function setGrandTotal( $string ){
		$this->grandTotal = $string;
	}

	public function getGrandTotal(){
		return $this->grandTotal;
	}

	public function setSubTotal( $string ){
		$this->subTotal = $string;
	}

	public function getSubTotal(){
		return $this->subTotal;
	}
	public function setPayType( $string ){
		$this->payType = $string;
	}

	public function getPayType(){
		return $this->payType;
	}
	public function setDiscount( $string ){
		$this->discount = $string;
	}

	public function getDiscount(){
		return $this->discount;
	}
	public function setDiscountType( $string ){
		$this->discountType = $string;
	}

	public function getDiscountType(){
		return $this->discountType;
	}
	public function setTotalDiscount( $string ){
		$this->totalDiscount = $string;
	}

	public function getTotalDiscount(){
		return $this->totalDiscount;
	}
	public function setDeposit( $string ){
		$this->deposit = $string;
	}

	public function getDeposit(){
		return $this->deposit;
	}
	public function setBalance( $string ){
		$this->balance = $string;
	}

	public function getBalance(){
		return $this->balance;
	}
	public function setDoctorId( $string ){
		$this->doctorId = $string;
	}

	public function getDoctorId(){
		return $this->doctorId;
	}
	public function setCustomerTypeId( $string ){
		$this->customerTypeId = $string;
	}

	public function getCustomerTypeId(){
		return $this->customerTypeId;
	}

}
