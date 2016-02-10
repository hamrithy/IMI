<?php

use
	OSC\ProductList\Collection
		as ProductListCol
	, OSC\ProductList\Object
		as ProductListObj
;

class RestApiProductList extends RestApi {

	public function get($params){
		$col = new ProductListCol();
		// start limit page
		$col->sortById('DESC');
		$col->filterByName($params['GET']['name']);
		$col->filterByBarcode($params['GET']['barcode']);
		$col->filterById($params['GET']['id']);
		$showDataPerPage = 10;
		$start = $params['GET']['start'];
		$this->applyLimit($col,
			array(
				'limit' => array( $start, $showDataPerPage )
			)
		);
		return $this->getReturn($col, $params);
	}

	public function post($params){
		$obj = new ProductListObj();
		$obj->setProperties($params['POST']);
		$obj->insert();
		return array(
			'data' => array(
				'id' => $obj->getId(),
				'success' => 'success'
			)
		);
	}

	public function put($params){
		$obj = new ProductListObj();
		$this->setId($this->getId());
		$obj->setProperties($params['PUT']);
		$obj->update($this->getId());
		return array(
			'data' => array(
				'id' => $obj->getId(),
				'success' => 'success'
			)
		);
	}

	public function delete(){
		$obj = new ProductListObj();
		$obj->delete($this->getId());
	}

}
