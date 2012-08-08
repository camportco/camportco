<?php
/* SVN FILE: $Id$ */
/**
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
 * @subpackage    cake.cake.libs.view.templates.pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset();?>
	<title>
		<?php __('Camport Camera Accessories'); ?>
		<?php echo $title_for_layout;?>
	</title>

	<meta name="description" content="camport camera accessories" />
	<meta name="keywords" content="camport camera accessories" />
    <?php echo $html->css('/style.css');?>

	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    
    <? echo $html->css('/themes/base/ui.all.css');?>
    
	<?php //echo $html->css('cake.generic');?>
	<?php echo $scripts_for_layout;?>
</head>
<body>
	<? $webroot = $this->webroot; ?>
	<input type="hidden" name="webroot" id="webroot" value="<?=$html->webroot?>" />

	<div id="container">
		<div id="content">
			<div id="header">
				<? echo $this->element('page_header'); ?>
			</div>
			<?php $session->flash();?>

			<? echo $content_for_layout;?>

            <div id="footer">
                <div id="fl">
                	<p>Copyright c 2011 Camport Camera Accessories</p>
                </div>
            </div>
		</div> 
	</div>
	<?php echo $cakeDebug?>
</body>
</html>
