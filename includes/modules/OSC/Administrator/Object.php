<?php

namespace OSC\Administrator;

use
	Aedea\Core\Database\StdObject as DbObj
;

class Object extends DbObj {
		
	protected
		$userName
		, $userPassword
		, $id
	;
	
	public function toArray( $params = array() ){
		$args = array(
			'include' => array(
				'id',
				'user_name',
			)
		);
		return parent::toArray($args);
	}
	
	public function load( $params = array() ){
		$q = $this->dbQuery("
			SELECT
				user_name,
				user_password
			FROM
				administrators
			WHERE
				id = '" . (int)$this->getId() . "'	
		");
		
		if( ! $this->dbNumRows($q) ){
			throw new \Exception(
				"404: Administrator not found",
				404
			);
		}
		$this->setProperties($this->dbFetchArray($q));
	}

	public function insert(){
		$this->dbQuery("
			INSERT INTO
				administrators
			(
				user_name,
				user_password
			)
				VALUES
			(
				'" . $this->getUserName() . "',
				'" . $this->getUserPassword() . "'
			)
		");
		$this->setId( $this->dbInsertId() );
	}

	public function update(){
		$this->dbQuery("
			UPDATE
				administrators
			SET
				user_name = '" . $this->getUserName() . "',
				user_password = '" . $this->getUserPassword() . "'
			WHERE
				id = '" . (int)$this->getId() . "'
		");
	}

	public function delete($id){
		if( !$id ) {
			throw new Exception("delete method requires id to be set");
		}
		$this->dbQuery("
			DELETE FROM
				administrators
			WHERE
				id = '" . (int)$id . "'
		");
	}

	public function setUserName( $string ){
		$this->userName = (string)$string;
	}

	public function getUserName(){
		return $this->userName;
	}

	public function setId( $string ){
		$this->id = (int)$string;
	}

	public function getId(){
		return $this->id;
	}

	public function setUserPassword( $string ){
		$this->userPassword = (string)$string;
	}
	
	public function getUserPassword(){
		return $this->userPassword;
	}
	
}
