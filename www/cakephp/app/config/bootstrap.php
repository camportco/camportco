<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * Long description for file
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
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 *
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php is loaded
 * This is an application wide file to load any function that is not used within a class define.
 * You can also use this to include or require any files in your application.
 *
 */
/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * $modelPaths = array('full path to models', 'second full path to models', 'etc...');
 * $viewPaths = array('this path to views', 'second full path to views', 'etc...');
 * $controllerPaths = array('this path to controllers', 'second full path to controllers', 'etc...');
 *
 */
//EOF

define('IMG_ROOT', 'http://images.camportco.com/');
define('PROD_IMG_DIR', 'http://images.camportco.com/product_images/'); // to be deleted
#define('IMG_ROOT', 'http://www.camportco.com/');
#define('PROD_IMG_DIR', 'http://www.camportco.com/product_images/');

function prodImagePath() {
	$path = Configure::read('PROD_IMG_DIR');
	
	if(!isset($_SESSION['IMG_ROOT_IDX'])) {
		$_SESSION['IMG_ROOT_IDX'] = 0;
	}

	$index = $_SESSION['IMG_ROOT_IDX'];
	if ($index >= count($path)-1) {
		$index = 0;
	}
	else {
		$index++;
	}
	$_SESSION['IMG_ROOT_IDX'] = $index;
	
	return $path[$index];
}
?>
