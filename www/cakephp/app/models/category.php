<?php
class Category extends AppModel {
	var $name = 'Category';
	var $useTable = 'category';
	
	var $validate = array(
		'cat_name' => VALID_NOT_EMPTY,
		'display_seq' => VALID_NUMBER
	);

	/*
	var $hasAndBelongsToMany = array(
		'Make' =>
		array(
		'className'         	=> 'Make',
		'joinTable'             => 'category_make',
		'foreignKey'            => 'cat_id',
		'associationForeignKey' => 'make_id',
		'order'					=> 'display_seq'
		)
	);*/
	
	function dropdown() {
		$this->recursive = 0;
		$cat_list = $this->findAll(null, 
			null,
			'cat_name'
		);

		return $cat_list;
	}
}
?>
