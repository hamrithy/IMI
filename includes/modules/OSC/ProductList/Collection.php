<?php

namespace OSC\ProductList;

use Aedea\Core\Database\StdCollection;

class Collection extends StdCollection {
	
	public function __construct( $params = array() ){
		parent::__construct($params);
		$this->addTable('product_list', 'pl');
		$this->idField = 'pl.id';
		$this->setDistinct(true);
		$this->objectType = __NAMESPACE__ . '\Object';		
	}

	public function filterByBarcode( $arg ){
		if($arg){
			$this->addWhere("pl.barcode LIKE '%" . $arg. "%' ");
		}
	}

	public function filterByName( $arg ){
		if($arg){
			$this->addWhere("pl.product_name LIKE '%" . $arg. "%' ");
		}
	}

	public function filterById( $arg ){
		if($arg){
			$this->addWhere("pl.id = '" . (int)$arg. "' ");
		}
	}

	public function sortById($arg){
		$this->addOrderBy('pl.id', $arg);
	}
	
}
