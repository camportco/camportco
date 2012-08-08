<?php
class MakesController extends AppController {
	var $name = 'Makes';
	var $helpers = array('Html','Javascript');
	
// Admin Function
	function make_list() {
		$this->Make->recursive = 0;
		$make_list = $this->Make->findAll(null, 
			null,
			'display_seq, id'
		);
	
		$this->set('make_list', $make_list);
		$this->layout = 'admin';
	}
	
	function make_edit() {		
		if (!empty($this->params['url']['make_id'])) {
			$make_id = $this->params['url']['make_id'];
			
			$this->Make->recursive = 0;
			$makes = $this->Make->find(array('id' => $make_id));
			
			$this->set('delete_enable', 'Y');
		}
		else {
			$makes = null;
		}
		
		if (!empty($this->params['url']['refresh'])) {
			$this->set('refresh', 'Y');
		}

		$this->set('makes', $makes);
		$this->layout = 'maintance_window';
	}
	
	function edit() {
		if (!empty($this->params['form'])) {
			$make_id = $this->params['form']['id'];
			$make_name = $this->params['form']['make_name'];
			
			$req_action = $this->params['form']['req_action'];
			
			if ($req_action == 'Save') {
				// Add / Update
				if ($this->Make->save($this->params['form'])) {
					if (empty($make_id)) {
						$this->flash('New company ['.$make_name.'] has been created.', 'make_edit?refresh=refresh');
					}
					else {
						$this->flash('Company ['.$make_name.'] has been updated.', 'make_edit?refresh=refresh&make_id='.$make_id);
					}
				} else {
					$this->flash('There was a problem with your modification', 'make_edit');
				}
			}
			else if ($req_action == 'Delete') {
				// Delete
				$num_rows = ClassRegistry::init('Product')->findCount(array('make_id' => $make_id));
				
				// Delete
				if ($num_rows == 0) {
					if ($this->Make->remove(array('id' => $make_id))) {
						$this->flash('Company ['.$make_name.'] has been deleted.', 'make_edit?refresh=refresh&make_id='.$make_id);
					}
					else {
						$this->flash('There was a problem with your deletion', 'make_edit&make_id='.$make_id);
					}
				}
				else {
					$this->flash('Deletion failed! Company ['.$make_name.'] is used by some products.', 'make_edit');
				}
			}
			else {
				$this->flash('No such action!');
			}
		}
	}
}
?>