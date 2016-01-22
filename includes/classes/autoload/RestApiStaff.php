<?php

use
	OSC\Staff\Collection
		as StaffCol
;

class RestApiStaff extends RestApi {

	public function get($params){
		$col = new StaffCol();
		$this->applyFilters($col, $params);
		$this->applySortBy($col, $params);
		return $this->getReturn($col, $params);
	}


}
