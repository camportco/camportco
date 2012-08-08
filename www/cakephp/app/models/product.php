<?php
class Product extends AppModel {
	var $name = 'Product';
	var $useTable = 'product';
	var $belongsTo = array(
         'Category' => array(
			'className'  => 'Category',
            'foreignKey' => 'cat_id',
        ),
		'Make' => array(
			'className'  => 'Make',
            'foreignKey' => 'make_id',
        )
    );
}
?>
