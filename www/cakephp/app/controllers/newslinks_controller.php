<?php

class NewslinksController extends AppController {
	var $name = 'Newslinks';
	var $helpers = array('Html','Javascript', 'Form');


function newslink_edit() {		
		if (!empty($this->params['url']['newslink_id'])) {
			$news_id = $this->params['url']['newslink_id'];
			
			$this->Newslink->recursive = 0;
			$newslinks = $this->Newslink->find(array('Newslink.id' => $news_id));
				
			$this->set('delete_enable', 'N');
		}
		else {
			$newslinks = null;
		}
		
		if (!empty($this->params['url']['refresh'])) {
			$this->set('refresh', 'Y');
		}
		

		$this->set('newslinks', $newslinks);
		$this->layout = 'maintance_window';
	}
	
	function newslink_list() {

		$this->Newslink->recursive = 1;
		$new_list = $this->Newslink->findAll(null, 
			null,
			'Newslink.id'
		);
		
		$this->set('newslink_list', $new_list);
		$this->layout = 'admin';
	}

// Guest Function
	function get_new_url() {
			
		//$this->Newslink->bindModel();
		
		$newslink = $this->Newslink->findAll(
			null,
			array('URL','CONTENT'),
			'Newslink.display_seq',
			null,
			null,
			1
		);
		return $newslink;
	}
	
function edit() {
		if (!empty($this->params['form'])) {
			$newslink_id = $this->params['form']['id'];
			$newslink_url = $this->params['form']['url'];
			$newslink_content = $this->params['form']['content'];
			$req_action = $this->params['form']['req_action'];
			
			if ($req_action == 'Save') {
				// Add / Update
				if ($this->Newslink->save($this->params['form'])) {
				
					if (empty($newslink_id)) {
						$this->flash('New newslink ['.$newslink_url.'] has been created.', 'newslink_edit?refresh=refresh');
					}
					else {
						$this->flash('New ['.$newslink_url.'] has been updated.', 'newslink_edit?refresh=refresh&newslink_id='.$newslink_id);
					}
				} else {
					$this->flash('There was a problem with your modification', 'newslink_edit?newslink_id='.$newslink_id);
				}
			}
			else if ($req_action == 'Delete') {
				// Delete
				if ($this->Newslink->remove(array('id' => $newslink_id))) {
					$this->flash('New ['.$newslink_url.'] has been deleted.', 'newslink_edit?refresh=refresh');
					
				 
					
				}
				else {
					$this->flash('There was a problem with your deletion', 'newslink_edit?newslink_id='.$newslink_id);
				}
			}
			else {
				$this->flash('No such action!');
			}
		}
	}
	
	

}
?>
