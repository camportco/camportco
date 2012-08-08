<?php
class CategorysController extends AppController {
	var $name = 'Categorys';
	var $helpers = array('Html','Javascript');
	
// Admin Function
	function category_list() {
		$this->Category->recursive = 0;
		$cat_list = $this->Category->findAll(null, 
			null,
			'display_seq, id'
		);
		
		$this->set('cat_list', $cat_list);
		$this->layout = 'admin';
	}
	
	function category_edit() {
		if (!empty($this->params['url']['cat_id'])) {
			$cat_id = $this->params['url']['cat_id'];
			
			$this->Category->recursive = 0;
			$categorys = $this->Category->find(array('id' => $cat_id));
			
			$this->set('delete_enable', 'Y');
		}
		else {
			$categorys = null;
		}
		
		if (!empty($this->params['url']['refresh'])) {
			$this->set('refresh', 'Y');
		}
		
		$this->set('categorys', $categorys);
		$this->layout = 'maintance_window';
	}
	
	function edit() {
		if (!empty($this->params['form'])) {
			$cat_id = $this->params['form']['id'];
			$cat_name = $this->params['form']['cat_name'];
			
			$req_action = $this->params['form']['req_action'];
			
			if ($req_action == 'Save') {
				// Add / update
				if ($this->Category->save($this->params['form'])) {
					if (empty($cat_id)) {
						$this->flash('New catgeory ['.$cat_name.'] has been created.', 'category_edit?refresh=refresh');
					}
					else {
						$this->flash('Category ['.$cat_name.'] has been updated.', 'category_edit?refresh=refresh&cat_id='.$cat_id);
					}
				} else {
					$this->flash('There was a problem with your modification', 'category_edit');
				}
			}
			else if ($req_action == 'Delete') {
				$num_rows = ClassRegistry::init('Product')->findCount(array('cat_id' => $cat_id));
				
				// Delete
				if ($num_rows == 0) {
					if ($this->Category->remove(array('id' => $cat_id))) {
						$this->flash('Category ['.$cat_name.'] has been deleted.', 'category_edit?refresh=refresh');
					}
					else {
						$this->flash('There was a problem with your deletion', 'category_edit&cat_id='.$cat_id);
					}
				}
				else {
					$this->flash('Deletion failed! Category ['.$cat_name.'] is used by some products.', 'category_edit&cat_id='.$cat_id);
				}
			}
			else {
				$this->flash('No such action!');
			}
		}
	}
	
// Guest Function
	function get_cat_seq() {
		$this->Category->recursive = 0;
//		$cat = $this->Category->query("select @rownum:=@rownum+1 rank, cat_name from category , (SELECT @rownum:=-1) r where sts='A' order by  display_seq  ");

	$this->Category->recursive = 0;
  $cat = $this->Category->findAll(
			array('sts' => 'A'), 
			'cat_name',
			'display_seq'
		);

		return $cat;
	}
	
	
	function menus() {
		$this->Category->recursive = 0;
		$menus = $this->Category->findAll(
			array('sts' => 'A'), 
			null,
			'display_seq'
			//array('Make' => array('display_seq'))
		);
		$this->set('menus', $menus);
		
		if (empty($this->params['url']['cid'])) {
		$cid=0;
		}else{
		$cid = $this->params['url']['cid'];
		}
		$this->set('cid', $cid);
	}
	
	function sub_menus() {
		$cat_id = $this->params['url']['cat_id'];
	
		$this->Category->recursive = 0;
/*		$this->Category->Make->bindModel(array(
			'hasMany' => array(
				'Product' => array(
					'className'  => 'Product',
					'foreignKey' => 'make_id',
					'conditions' =>array('cat_id'=>$cat_id)
				)
			)
		));*/
/*
		$subMenus = $this->Category->findAll(array('id' => $cat_id), 
			null,
			'display_seq'//array('Make' =>'display_seq')
		);*/
		
		$this->set('cat_id', $cat_id);

		$this->layout = 'content';
		//$this->layout = 'default'; // for testing
	}
}
?>
