<?php

use
	OSC\DoctorList\Collection
		as DoctorCol
	, OSC\DoctorList\Object
		as DoctorObj
;

class RestApiDoctorList extends RestApi {

	public function get($params){
		$col = new DoctorCol();
		// start limit page
		$col->sortById('DESC');
		$col->filterByName($params['GET']['name']);
		$params['GET']['id'] ? $col->filterById($params['GET']['id']) : '';
		$showDataPerPage = 10;
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
		$obj = new DoctorObj();
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
		$obj = new DoctorObj();
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
		$obj = new DoctorObj();
		$obj->delete($this->getId());
	}

}
