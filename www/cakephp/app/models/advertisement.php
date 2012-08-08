<?php
class Advertisement extends AppModel {
	var $name = 'Advertisement';
	var $useTable = 'advertisement';
	
	function get_advertisement_url() {
		$adv = $this->findAll(
			null,
			array('url', 'img_url'),
			'id',
			null,
			null,
			1
		);
		return $adv;
	}
}
?>
