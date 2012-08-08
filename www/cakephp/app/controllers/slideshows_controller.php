<?php

class SlideshowsController extends AppController {
	var $name = 'Slideshows';
	var $helpers = array('Html','Javascript', 'Form');


function slideshow_edit() {		
		if (!empty($this->params['url']['slide_id'])) {
			$slide_id = $this->params['url']['slide_id'];
			
			$this->Slideshow->recursive = 0;
			$slideshows = $this->Slideshow->find(array('Slideshow.id' => $slide_id));
				
			$this->set('delete_enable', 'N');
		}
		else {
			$slideshows = null;
		}
		
		if (!empty($this->params['url']['refresh'])) {
			$this->set('refresh', 'Y');
		}
		

		$this->set('slideshows', $slideshows);
		$this->layout = 'maintance_window';
	}
	
	function slideshow_list() {

		$this->Slideshow->recursive = 1;
		$slide_list = $this->Slideshow->findAll(null, 
			null,
			'Slideshow.id'
		);
		
		$this->set('slide_list', $slide_list);
		$this->layout = 'admin';
	}

// Guest Function
	function get_slideshow_url() {
			
		//$this->Slideshow->bindModel();
		
		$slideshow = $this->Slideshow->findAll(
			null,
			array('URL'),
			null,
			null,
			null,
			1
		);
		return $slideshow;
	}
	
function edit() {
		if (!empty($this->params['form'])) {
			$slide_id = $this->params['form']['id'];
			$slide_url = $this->params['form']['url'];
			$req_action = $this->params['form']['req_action'];
			
			if ($req_action == 'Save') {
				// Add / Update
				if ($this->Slideshow->save($this->params['form'])) {
				
					if (empty($slide_id)) {
						$this->flash('New slidwshow ['.$slide_url.'] has been created.', 'slideshow_edit?refresh=refresh');
					}
					else {
						$this->flash('Slideshow ['.$slide_url.'] has been updated.', 'slideshow_edit?refresh=refresh&slide_id='.$slide_id);
					}
				} else {
					$this->flash('There was a problem with your modification', 'slideshow_edit?slide_id='.$slide_id);
				}
			}
			else if ($req_action == 'Delete') {
				// Delete
				if ($this->Slideshow->remove(array('id' => $slide_id))) {
					$this->flash('Slideshow ['.$slide_url.'] has been deleted.', 'slideshow_edit?refresh=refresh');
					
					// Delete image
					
				}
				else {
					$this->flash('There was a problem with your deletion', 'slideshow_edit?slide_id='.$slide_id);
				}
			}
			else {
				$this->flash('No such action!');
			}
		}
	}
	
	

}
?>
