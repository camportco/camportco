<?php
class AdminController extends AppController {
	var $name = 'Admin';
	var $helpers = array('Html','Javascript');
	
	function main() {
/*		$count_file = 'counter.txt';
		$count = 0;
		if (file_exists($count_file)) {
			// Get current count
			$count = intval(trim(file_get_contents($count_file))) or $count = 0;
		}*/
		
		$systemParam = ClassRegistry::init('Systemparameter')->find(array('key' => 'hit_count'));
		
		$this->set('count', $systemParam['Systemparameter']['value']);
		$this->layout = 'admin';
	}
}
?>
