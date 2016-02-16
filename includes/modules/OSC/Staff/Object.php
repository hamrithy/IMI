<?php

namespace OSC\Staff;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$type
		, $name
		, $sex
		, $phone
		, $dob
		, $position
		, $spouse
		, $minor
		, $contractDate
		, $startContract
		, $endContract
		, $address
		, $note
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'type',
				'id',
				'name',
				'sex',
				'phone',
				'position',
				'dob',
				'spouse',
				'minor',
				'contract_date',
				'start_contract',
				'end_contract',
				'address',
				'note'
			)
		);

		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				name,
				phone,
				type,
				sex,
				address,
				dob,
				position,
				spouse,
				minor,
				note,
				contract_date,
				start_contract,
				end_contract
			FROM
				staff
			WHERE
				id = '" . (int)$this->getId() . "'	
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Staff not found",
				404
			);
		}
		$this->setProperties($this->dbFetchArray($q));
	}

	public function delete($id){
		if( !$id ) {
			throw new Exception("delete method requires id to be set");
		}
		$this->dbQuery("
			DELETE FROM
				staff
			WHERE
				id = '" . (int)$id . "'
		");
	}

	public function update($id){
		$this->dbQuery("
			UPDATE
				staff
			SET
 				sex = '" . $this->getSex() . "',
 				name = '" . $this->getName() . "',
 				phone = '" . $this->getPhone() . "',
 				type = '" . $this->getType() . "',
 				address = '" . $this->getAddress() . "',
 				dob = '" . $this->getDob() . "',
 				position = '" . $this->getPosition() . "',
 				spouse = '" . $this->getSpouse() . "',
 				minor = '" . $this->getMinor() . "',
 				note = '" . $this->getNote() . "',
 				contract_date = '" . $this->getContractDate() . "',
 				start_contract = '" . $this->getStartContract() . "',
 				end_contract = '" . $this->getEndContract() . "'
			WHERE
				id = '" . (int)$id . "'
		");
	}

	public function insert(){
		$this->dbQuery("
			INSERT INTO
				staff
			(
				name,
				phone,
				type,
				sex,
				address,
				dob,
				position,
				spouse,
				minor,
				note,
				contract_date,
				start_contract,
				end_contract,
				status,
				create_date
			)
				VALUES
			(
				'" . $this->getName() . "',
				'" . $this->getPhone() . "',
				'" . $this->getType() . "',
				'" . $this->getSex() . "',
				'" . $this->getAddress() . "',
				'" . $this->getDob() . "',
				'" . $this->getPosition() . "',
				'" . $this->getSpouse() . "',
				'" . $this->getMinor() . "',
				'" . $this->getNote() . "',
				'" . $this->getContractDate() . "',
				'" . $this->getStartContract() . "',
				'" . $this->getEndContract() . "',
				1,
				NOW()
			)
		");
		$this->setId( $this->dbInsertId() );
	}

	public function setEndContract( $date ){
		$this->endContract = date('Y-m-d', strtotime( $date ));
	}

	public function getEndContract(){
		return $this->endContract;
	}

	public function setStartContract( $date ){
		$this->startContract = date('Y-m-d', strtotime( $date ));
	}

	public function getStartContract(){
		return $this->startContract;
	}

	public function setContractDate( $date ){
		$this->contractDate = date('Y-m-d', strtotime( $date ));;
	}

	public function getContractDate(){
		return $this->contractDate;
	}

	public function setNote( $string ){
		$this->note = (string)$string;
	}

	public function getNote(){
		return $this->note;
	}

	public function setMinor( $string ){
		$this->minor = (string)$string;
	}

	public function getMinor(){
		return $this->minor;
	}

	public function setSpouse( $string ){
		$this->spouse = (string)$string;
	}

	public function getSpouse(){
		return $this->spouse;
	}

	public function setPosition( $string ){
		$this->position = (string)$string;
	}

	public function getPosition(){
		return $this->position;
	}

	public function setDob( $date ){
		$this->dob =  date('Y-m-d', strtotime( $date ));
	}

	public function getDob(){
		return $this->dob;
	}

	public function setAddress( $string ){
		$this->address = (string)$string;
	}

	public function getAddress(){
		return $this->address;
	}

	public function setSex( $string ){
		$this->sex = (string)$string;
	}

	public function getSex(){
		return $this->sex;
	}

	public function setType( $string ){
		$this->type = (string)$string;
	}

	public function getType(){
		return $this->type;
	}

	public function setPhone( $string ){
		$this->phone = (string)$string;
	}

	public function getPhone(){
		return $this->phone;
	}

	public function setName( $string ){
		$this->name = (string)$string;
	}
	
	public function getName(){
		return $this->name;
	}
	
}
