<?php
class Make extends AppModel {
	var $name = 'Make';
	var $useTable = 'make';
	
	var $validate = array(
		'cat_name' => VALID_NOT_EMPTY,
		'display_seq' => VALID_NUMBER
	);
	
	function dropdown() {
		$this->recursive = 0;
		$make_list = $this->findAll(null, 
			null,
			'make_name'
		);

		return $make_list;
	}
}
?>
