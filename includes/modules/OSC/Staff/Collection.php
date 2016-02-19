<?php

namespace OSC\Staff;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('staff', 's');
		$this->idField = 's.id';
		$this->setDistinct(true);
		
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function filterByType( $arg ){
		if($arg){
			$this->addWhere("s.type LIKE '%" . $arg. "%' ");
		}
	}

	public function filterByName( $arg ){
		if($arg){
			$this->addWhere("s.name LIKE '%" . $arg. "%' ");
		}
	}
	public function filterByPhone( $arg ){
		if($arg){
			$this->addWhere("s.phone LIKE '%" . $arg. "%' ");
		}
	}

	public function filterById( $arg ){
		if($arg){
			$this->addWhere("s.id = '" . (int)$arg. "' ");
		}
	}

	public function sortByName($arg){
		$this->addOrderBy('s.name', $arg);
	}
}
