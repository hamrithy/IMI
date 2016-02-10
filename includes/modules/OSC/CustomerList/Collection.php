<?php

namespace OSC\CustomerList;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('tab_customer', 'c');
		$this->idField = 'c.id';
		$this->setDistinct(true);
		
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function filterByName( $arg ){
		if($arg){
			$this->addWhere("c.full_name LIKE '%" . $arg. "%' ");
		}
	}

	public function filterById( $arg ){
		if($arg){
			$this->addWhere("c.id = '" . (int)$arg. "' ");
		}
	}

	public function sortById($arg){
		$this->addOrderBy('c.id', $arg);
	}
}
