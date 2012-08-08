<?php

class AdvertisementsController extends AppController {
	var $name = 'Advertisements';
	var $helpers = array('Html','Javascript', 'Form');


	function adv_edit() {		
		if (!empty($this->params['url']['id'])) {
			$adv_id = $this->params['url']['id'];
			
			$this->Advertisement->recursive = 0;
			$advs = $this->Advertisement->find(array('Advertisement.id' => $adv_id));
				
			$this->set('delete_enable', 'N');
		}
		else {
			$advs = null;
		}
		
		if (!empty($this->params['url']['refresh'])) {
			$this->set('refresh', 'Y');
		}

		$this->set('advs', $advs);
		$this->layout = 'maintance_window';
	}
	
	function adv_list() {

		$this->Advertisement->recursive = 1;
		$adv_list = $this->Advertisement->findAll(null, 
			null,
			'Advertisement.id'
		);
		
		$this->set('adv_list', $adv_list);
		$this->layout = 'admin';
	}

// Guest Function
	function edit() {
		if (!empty($this->params['form'])) {
			$adv_id = $this->params['form']['id'];
			$img_url = $this->params['form']['img_url'];
			$req_action = $this->params['form']['req_action'];
			
			if ($req_action == 'Save') {
				// Add / Update
				if ($this->Advertisement->save($this->params['form'])) {
				
					if (empty($adv_id)) {
						$this->flash('New advertisement ['.$img_url.'] has been created.', 'adv_edit?refresh=refresh');
					}
					else {
						$this->flash('Advertisement ['.$img_url.'] has been updated.', 'adv_edit?refresh=refresh&id='.$adv_id);
					}
				} else {
					$this->flash('There was a problem with your modification', 'adv_edit?id='.$adv_id);
				}
			}
			else if ($req_action == 'Delete') {
				// Delete
				if ($this->Advertisement->remove(array('id' => $adv_id))) {
					$this->flash('Advertisement ['.$img_url.'] has been deleted.', 'adv_edit?refresh=refresh');
					
					// Delete image
					
				}
				else {
					$this->flash('There was a problem with your deletion', 'adv_edit?id='.$adv_id);
				}
			}
			else {
				$this->flash('No such action!');
			}
		}
	}
}
?>
