<?php

namespace OSC\Invoice;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		
		$this->addTable('invoice', 'i');
		$this->idField = 'i.id';
		$this->setDistinct(true);
		
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function filterById( $arg ){
		if($arg){
			$this->addWhere("i.id = '" . (int)$arg. "' ");
		}
	}

}
