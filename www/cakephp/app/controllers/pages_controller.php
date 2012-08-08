<?php
/* SVN FILE: $Id$ */
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 */
class PagesController extends AppController {
/**
 * Controller name
 *
 * @var string
 * @access public
 */
	var $name = 'Pages';
/**
 * Default helper
 *
 * @var array
 * @access public
 */
	var $helpers = array('Html', 'Javascript');
/**
 * This controller does not use a model
 *
 * @var array
 * @access public
 */
	var $uses = array();
	
	var $page = '';
	var $subpage = '';
/**
 * Displays a view
 *
 * @param mixed What page to display
 * @access public
 */
	function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title = Inflector::humanize($path[$count - 1]);
		}
		
		$catseq = $this->requestAction("categorys/get_cat_seq");
	
		$i=0;
		foreach ($catseq as $val):
		  $cat[$val['Category']['cat_name']]=$i;
		  $i++;
		endforeach;
		$this->set('cat_id_by_cat_name',$cat);

		// -----
		// get news url
		// ----
		$surl = $this->requestAction("newslinks/get_new_url");
		$i=0;
		//$this->set('news', $surl);
		foreach ($surl as $val):
		  $url[$i]['URL']=$val['Newslink']['URL'];
		  $url[$i]['Content']=$val['Newslink']['CONTENT'];
		  $i++;
		endforeach;
		$this->set('news_content', $url);

		// -----
		// get slideshow url
		// ----
		$surl = $this->requestAction("slideshows/get_slideshow_url");
		$i=0;
		//$this->set('slideshows', $surl);
		foreach ($surl as $val):
		  $url[$i]=$val['Slideshow']['URL'];
		  $i++;
		endforeach;
		$this->set('slideshow_url', $url);
		
		// -----
		// Get advertisement url
		// -----
		$surl = ClassRegistry::init('Advertisement')->get_advertisement_url();
		$this->set('adv_url', $surl);

		// --------------------------
		// Camera Accessories
		$item1 = $this->requestAction("products/get_random_prod", 
						array('cat_name' => 'Camera Accessories'));
		
		// Camera Inserts
		$item2 = $this->requestAction("products/get_random_prod", 
						array('cat_name' => 'Camera Inserts'));
						
		// Camera Inserts
		$item3 = $this->requestAction("products/get_random_prod", 
						array('cat_name' => 'Camera Bags'));
						
		// Camera Inserts
		$item4 = $this->requestAction("products/get_random_prod", 
						array('cat_name' => 'Camera Straps'));

		$this->set('products', array(
					'accessory' => $item1[0],
					'insert' => $item2[0],
					'bag' => $item3[0],
					'strap' => $item4[0]));
		// -------------------------
		
		// Counter
		$systemParam = ClassRegistry::init('Systemparameter');
		$params = $systemParam->find(array('key' => 'hit_count'));
		$param = $params['Systemparameter'];
		$param['value'] = $param['value'] + 1;
		$systemParam->save($param);
		/* obsoleted
		$count_file = 'counter.txt';
		if (file_exists($count_file)) {
			// Get current count
			$count = intval(trim(file_get_contents($count_file))) or $count = 0;

			// Increase the count by 1
			$count = $count + 1;
			$fp = @fopen($count_file,'w+') or die('ERROR: Can\'t write to the log file ('.$count_file.'), please make sure this file exists and is CHMOD to 666 (rw-rw-rw-)!');
			flock($fp, LOCK_EX);
			fputs($fp, $count);
			flock($fp, LOCK_UN);
			fclose($fp);
		}
		else {
			die('ERROR: Invalid log file!');
		}*/
		
		$this->set(compact('page', 'subpage', 'title'));
		$this->render(join('/', $path));
	}
}

?>