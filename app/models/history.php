<?php
class History extends AppModel{

	var $name	= 'History'; 
	var $useTable	= 'Histories';// table name
	public $hasMany  = array('history_clicks');	
}
?>