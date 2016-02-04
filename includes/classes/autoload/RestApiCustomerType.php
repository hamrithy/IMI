<?php

use
	OSC\CustomerType\Collection
		as CustomerTypeCol
	, OSC\CustomerType\Object
		as CustomerTypeObj
;

class RestApiCustomerType extends RestApi {

	public function get(){
		$col = new CustomerTypeCol();
		$this->applyFilters($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);
	}

	public function post($params){
		$obj = new CustomerTypeObj();
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
		$obj = new CustomerTypeObj();var_dump($params['PUT']);
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
		$obj = new CustomerTypeObj();
		$obj->delete($this->getId());
	}

}
