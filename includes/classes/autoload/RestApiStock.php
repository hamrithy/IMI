<?php

use
	OSC\Stock\Collection
		as StockCol
	, OSC\Stock\Object
		as StockObj
;

class RestApiStock extends RestApi {

	public function get($params){
		$col = new StockCol();
		$this->applyFilters($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);
	}

	public function patch($params){
		$obj = new StockObj();
		foreach( $params['PATCH'] as $key => $value){
			$obj->setQty($value['qty']);
			$obj->setId($value['pid']);
			$obj->updateStock();
		}
//		var_dump($params['PATCH'][0]);
		exit;

	}

}
