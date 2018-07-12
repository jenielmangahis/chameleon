<?php
class AppModel extends Model {
	
	function lastQuery(){
		$dbo = $this->getDatasource();
		$logs = $dbo->_queriesLog;
		// return the first element of the last array (i.e. the last query)
		return current(end($logs));
	}
	
	// debug($this->lastQuery()); // in model
	// debug($this->Model->lastQuery()); // in controller
	// $this->render('sql');
	
}
?>