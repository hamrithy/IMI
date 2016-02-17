<?php

use
	OSC\CustomerList\Collection
		as CustomerListCol
	, OSC\CustomerList\Object
		as CustomerListObj
;

class RestApiCustomerList extends RestApi {

	public function get($params){
		$col = new CustomerListCol();
		// start limit page
		$col->sortById('DESC');
		$col->filterByName($params['GET']['name']);
		$col->filterById($params['GET']['id']);
		if($params['GET']['search_in_invoice']){
			$showDataPerPage = 10;
		}else{
			$showDataPerPage = 20;
		}

		$start = $params['GET']['start'];
		$this->applyLimit($col,
			array(
				'limit' => array( $start, $showDataPerPage )
			)
		);
		$this->applyFilters($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);
	}

	public function post($params){
		$obj = new CustomerListObj();
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
		$obj = new CustomerListObj();var_dump($params['PUT']);
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
		$obj = new CustomerListObj();
		$obj->delete($this->getId());
	}

}
