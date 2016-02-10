<?php

namespace OSC\CustomerList;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$customerTypeId
		, $fullName
		, $detail
		, $sex
		, $dob
		, $tel
		, $email
		, $address
		, $relativeContact
		, $relativeTel
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'full_name',
				'detail',
				'customer_type_id',
				'sex',
				'dob',
				'tel',
				'email',
				'address',
				'relative_contact',
				'relative_tel',
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				full_name,
				detail,
				customer_type_id,
				sex,
				dob,
				tel,
				email,
				address,
				relative_contact,
				relative_tel
			FROM
				tab_customer
			WHERE
				id = '" . (int)$this->getId() . "'	
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Customer List not found",
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
				tab_customer
			SET
				full_name = '" . $this->getFullName() . "',
				customer_type_id = '" . $this->getCustomerTypeId() . "',
				dob = '" . $this->getDob() . "',
				tel = '" . $this->getTel() . "',
				address = '" . $this->getAddress() . "',
				detail = '" . $this->getDetail() . "',
				email = '" . $this->getEmail() . "',
				relative_contact = '" . $this->getRelativeContact() . "',
				relative_tel = '" . $this->getRelativeTel() . "',
				sex = '" . $this->getSex() . "',
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
				tab_customer
			WHERE
				id = '" . (int)$id . "'
		");
	}

	public function insert(){
		$this->dbQuery("
			INSERT INTO
				tab_customer
			(
				full_name,
				detail,
				address,
				tel,
				dob,
				relative_contact,
				relative_tel,
				email,
				customer_type_id,
				sex,
				createdate
			)
				VALUES
			(
				'" . $this->getFullName() . "',
				'" . $this->getDetail() . "',
				'" . $this->getAddress() . "',
				'" . $this->getTel() . "',
				'" . $this->getDob() . "',
				'" . $this->getRelativeContact() . "',
				'" . $this->getRelativeTel() . "',
				'" . $this->getEmail() . "',
				'" . $this->getCustomerTypeId() . "',
				'" . $this->getSex() . "',
 				NOW()
			)
		");
		$this->setId( $this->dbInsertId() );
	}

	public function setDetail( $string ){
		$this->detail = $string;
	}

	public function getDetail(){
		return $this->detail;
	}

	public function setSex( $string ){
		$this->sex = $string;
	}

	public function getSex(){
		return $this->sex;
	}

	public function setCustomerTypeId( $string ){
		$this->customerTypeId = $string;
	}

	public function getCustomerTypeId(){
		return $this->customerTypeId;
	}

	public function setEmail( $string ){
		$this->email = $string;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setRelativeTel( $string ){
		$this->relativeTel = $string;
	}

	public function getRelativeTel(){
		return $this->relativeTel;
	}

	public function setRelativeContact( $string ){
		$this->relativeContact = $string;
	}

	public function getRelativeContact(){
		return $this->relativeContact;
	}

	public function setTel( $string ){
		$this->tel = $string;
	}

	public function getTel(){
		return $this->tel;
	}

	public function setAddress( $string ){
		$this->address = $string;
	}

	public function getAddress(){
		return $this->address;
	}

	public function setDob( $string ){
		$this->dob = $string;
	}

	public function getDob(){
		return $this->dob;
	}

	public function setFullName( $string ){
		$this->fullName = $string;
	}
	
	public function getFullName(){
		return $this->fullName;
	}

}
