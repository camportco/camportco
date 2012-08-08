<?php

class ProductsController extends AppController {
	var $name = 'Products';
	var $helpers = array('Html','Javascript', 'Form');
	var $components = array('Upload');

// Admin Function
	function product_list() {
		if (!empty($this->params['url']['search'])) {
			$condition = $this->getCondition();
		}
		else {
			$condition = null;
		}
		
		if (empty($this->params['url']['zpage'])) {
			$zpage = 1;
		}
		else {
			$zpage = $this->params['url']['zpage'];
		}
		$this->set('zpage', $zpage);
		
/*		if (empty($this->params['url']['pagesize'])) {
			$pagesize = 1;
		}
		else {
			$pagesize = $this->params['url']['pagesize'];
		}*/
		$pagesize = 10;
		$this->set('pagesize', $pagesize);
		
		
		// Count
		if (empty($this->params['url']['num_rows'])) {
			$num_rows = $this->Product->findCount($condition);
			$this->set('num_rows', $num_rows);
		}
		
		 $this->setSearchQuery();

		$prod_list = $this->Product->findAll(
				$condition,
				null,
				'Product.display_seq, Product.id',
				$pagesize,
				$zpage);
		
/*		$this->Product->recursive = 1;
		$prod_list = $this->Product->findAll($condition, 
			null,
			'Product.display_seq, Product.id'
		);*/
		
		// For dropdown
		$cat_list = ClassRegistry::init('Category')->dropdown();
		$make_list = ClassRegistry::init('Make')->dropdown();
		
		$this->set('cat_list', $cat_list);
		$this->set('make_list', $make_list);
		$this->set('prod_list', $prod_list);
		$this->layout = 'admin';
	}
	
	function product_list_paging() {
		$condition = $this->getCondition();
		
		if (empty($this->params['url']['zpage'])) {
			$zpage = 1;
		}
		else {
			$zpage = $this->params['url']['zpage'];
		}
		$this->set('zpage', $zpage);
		
/*		if (empty($this->params['url']['pagesize'])) {
			$pagesize = 1;
		}
		else {
			$pagesize = $this->params['url']['pagesize'];
		}*/
		$pagesize = 10;
		$this->set('pagesize', $pagesize);
		
		
		// Count
		if (empty($this->params['url']['num_rows'])) {
			$num_rows = $this->Product->findCount($condition);
			$this->set('num_rows', $num_rows);
		}

		$prod_list = $this->Product->findAll(
				$condition,
				null,
				'Product.display_seq, Product.id',
				$pagesize,
				$zpage);

		$this->set('prod_list', $prod_list);
		$this->layout = 'content';
	}
	
	function product_edit() {		
		if (!empty($this->params['url']['prod_id'])) {
			$prod_id = $this->params['url']['prod_id'];
			
			$this->Product->recursive = 0;
			$products = $this->Product->find(array('Product.id' => $prod_id));
			
			// Check image file existance
			if (file_exists('product_images/'.$products['Product']['product_id'].'_s.jpg')) {
				$this->set('img_small_exist', 'Y');
			}
			if (file_exists('product_images/'.$products['Product']['product_id'].'_l.jpg')) {
				$this->set('img_large_exist', 'Y');
			}
			
			$this->set('delete_enable', 'Y');
		}
		else {
			$products = null;
		}
		
		if (!empty($this->params['url']['refresh'])) {
			$this->set('refresh', 'Y');
		}
		
		// For dropdown
		$cat_list = ClassRegistry::init('Category')->dropdown();
		$make_list = ClassRegistry::init('Make')->dropdown();

		$this->set('cat_list', $cat_list);
		$this->set('make_list', $make_list);
		$this->set('products', $products);
		$this->layout = 'maintance_window';
	}
	
	function edit() {
		if (!empty($this->params['form'])) {
			$prod_id = $this->params['form']['id'];
			$prod_name = $this->params['form']['name'];
			$product_id = $this->params['form']['product_id'];
			
			$req_action = $this->params['form']['req_action'];
			
			if ($req_action == 'Save') {
				// Add / Update
				if ($this->Product->save($this->params['form'])) {
					// Upload image
					$destination = realpath('../../app/webroot/product_images/') . '/';
			
					// grab the file
					$file = $this->data['img_s'];

					// upload the image using the upload component
					if ($file) {
						$result = $this->Upload->upload($file, $destination, $product_id.'_s.jpg');
						
						if (!$result){
							$this->data['Image']['images'] = $this->Upload->result;
						} else {
							// display error
							$errors = $this->Upload->errors;
							var_dump($errors);
							echo "Image (Small) upload fail!<br>$errors<br>";
						}
					}
					
					// Large Image
					$file = $this->data['img_l'];
					if ($file) {
						$result = $this->Upload->upload($file, $destination, $product_id.'_l.jpg');
						
						if (!$result){
							$this->data['Image']['images'] = $this->Upload->result;
						} else {
							// display error
							$errors = $this->Upload->errors;
							var_dump($errors);
							echo "Image (Large) upload fail!<br>$errors<br>";
						}
					}
				
					if (empty($prod_id)) {
						$this->flash('New product ['.$prod_name.'] has been created.', 'product_edit?refresh=refresh');
					}
					else {
						$this->flash('Product ['.$prod_name.'] has been updated.', 'product_edit?refresh=refresh&prod_id='.$prod_id);
					}
				} else {
					$this->flash('There was a problem with your modification', 'product_edit?prod_id='.$prod_id);
				}
			}
			else if ($req_action == 'Delete') {
				// Delete
				if ($this->Product->remove(array('id' => $prod_id))) {
					$this->flash('Product ['.$prod_name.'] has been deleted.', 'product_edit?refresh=refresh');
					
					// Delete image
					
				}
				else {
					$this->flash('There was a problem with your deletion', 'product_edit?prod_id='.$prod_id);
				}
			}
			else {
				$this->flash('No such action!');
			}
		}
	}
	
// Guest Function
	function get_random_prod() {
		$cat_name = $this->params['cat_name'];
		
		$this->Product->bindModel(array(
			'belongsTo' => array(
				 'Category' => array(
					'className'  => 'Category',
					'foreignKey' => 'cat_id'
					//,				'conditions' => array('Category.cat_name'=>$cat_name)
				)
			)
		));
		
		$product = $this->Product->findAll(
			array('Product.sts'=>'A', 'Make.sts'=>'A','Category.cat_name'=>$cat_name),
			null,
			'RAND()',
			1,
			null,
			1
		);
		return $product;
	}
	
	function show_product() {

		if (!empty($this->params['url']['cat_id'])) {
			$cat_id = $this->params['url']['cat_id'];
		}
		else {
			$cat_id = '';
		}
		
		if (!empty($this->params['url']['make_id'])) {
			$make_id = $this->params['url']['make_id'];
		}
		else {
			$make_id = '';
		}

		if (!empty($this->params['url']['zpage'])) {
			$zpage = $this->params['url']['zpage'];
		}
		else {
			$zpage = '';
		}
		
		if (!empty($this->params['url']['divId'])) {
			$divId = $this->params['url']['divId'];
		}
		else {
			$divId = '';
		}
		
		//$products = $this->Product->findAll(array('cat_id' => $cat_id, 'make_id' => $make_id),
		$products = $this->Product->findAll(
			array('cat_id' => $cat_id, 
				'Product.sts' => 'A',
				'Make.sts' => 'A'),
			null,
			'Make.display_seq, Product.display_seq, Product.id desc', // todo display_seq
			15,
			$zpage);
/*
		if (isset($this->params['requested'])) {
			$rtn_params = array(
				'zpage' => $zpage,
				'per_page' => 15,
				'products' => $products,
				'divId' => divId
			);
			
			return $rtn_params;
		}*/

		$this->set('zpage', $zpage);
		$this->set('cat_id', $cat_id);
		$this->set('make_id', $make_id);
		$this->set('products', $products);
		$this->set('divId', $divId);
		
		$this->layout = 'content';
	}
	
	function get_count() {

		if (!empty($this->params['url']['cat_id'])) {
			$cat_id = $this->params['url']['cat_id'];
		}
		else {
			$cat_id = '';
		}

		$num_rows = $this->Product->findCount(array('cat_id' => $cat_id, 'Product.sts'=>'A', 'Make.sts'=>'A'));
			
		if (isset($this->params['requested'])) {
			return $num_rows;
		}
	}
	
	function search() {
		$products = $this->Product->findAll(
			array('product_id' => $this->params['pass']),null,'Product.display_seq'
		);
		
		$this->set('products', $products);
	}
	
	function mopbox_form() {
		$product_id = $this->params['url']['product_id'];
		$products = $this->Product->findAll(
			array('product_id' => $product_id)
		);
		
		$this->set('products', $products);
		$this->layout = 'content';
	}
	
	function getCondition() {
		$condition = array();

		if (!empty($this->params['url']['product_id'])) {
			$key = $this->params['url']['product_id'];
			array_push($condition, array("Product.product_id LIKE" => "%$key%"));
		}
		
		if (!empty($this->params['url']['name'])) {
			$key = $this->params['url']['name'];
			array_push($condition, array("Product.name LIKE" => "%$key%"));
		}
		
		if (!empty($this->params['url']['cat_id'])) {
			$key = $this->params['url']['cat_id'];
			array_push($condition, array("Product.cat_id" => "$key"));
		}
		
		if (!empty($this->params['url']['make_id'])) {
			$key = $this->params['url']['make_id'];
			array_push($condition, array("Product.make_id" => "$key"));
		}
		
		if (!empty($this->params['url']['desc'])) {
			$key = $this->params['url']['desc'];
			array_push($condition, array("Product.desc LIKE" => "%$key%"));
		}
		
		if (!empty($this->params['url']['sts'])) {
			$key = $this->params['url']['sts'];
			array_push($condition, array("Product.sts" => "$key"));
		}
		return $condition;
	}
	
	function setSearchQuery() {
		if (!empty($this->params['url']['product_id'])) {
			$key = $this->params['url']['product_id'];
			$this->set('product_id', $key);
		}
		else {
			$this->set('product_id', '');
		}
		
		if (!empty($this->params['url']['name'])) {
			$key = $this->params['url']['name'];
			$this->set('name', $key);
		}
		else {
			$this->set('name', '');
		}
		
		if (!empty($this->params['url']['cat_id'])) {
			$key = $this->params['url']['cat_id'];
			$this->set('cat_id', $key);
		}
		else {
			$this->set('cat_id', '');
		}
		
		if (!empty($this->params['url']['make_id'])) {
			$key = $this->params['url']['make_id'];
			$this->set('make_id', $key);
		}
		else {
			$this->set('make_id', '');
		}
		
		if (!empty($this->params['url']['desc'])) {
			$key = $this->params['url']['desc'];
			$this->set('desc', $key);
		}
		else {
			$this->set('desc', '');
		}
		
		if (!empty($this->params['url']['sts'])) {
			$key = $this->params['url']['sts'];
			$this->set('sts', $key);
		}
		else {
			$this->set('sts', '');
		}
	}
}
?>
