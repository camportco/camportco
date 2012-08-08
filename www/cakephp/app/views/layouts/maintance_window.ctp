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

	<meta name="description" content="Small Corporation" />
	<meta name="keywords" content="small, corporation" />
    <?php echo $html->css('/style.css');?>
    <?php echo $html->css('/style_admin.css');?>

	<link rel="icon" href="favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    
    <? echo $html->css('/themes/base/ui.all.css');?>
    
	<?php //echo $html->css('cake.generic');?>
	<?php echo $scripts_for_layout;?>
    
    <script type="text/javascript">
		<? if (isset($refresh)) { ?>
			if (window.opener && !window.opener.closed) {
				window.opener.location.reload();
			}
		<? } ?>
		
		function goDelete() {
			if (confirm("Do you really want to delete the item?")){
				document.form1.req_action.value = "Delete";
				document.form1.submit();
			}
		}
		
		function goSave() {
			if (checkFields()) {
				document.form1.req_action.value = "Save";
				document.form1.submit();
			}
		}
	</script>
    
</head>
<body>
	<div id="container">
		<div id="content">
        	<form name="form1" action="edit" method="post" enctype="multipart/form-data">
            <input type="hidden" name="req_action" value="">
			<?php $session->flash();?>

			<? echo $content_for_layout;?>
            
            <input type="button" value="Save" onclick="goSave()" />
            <? if (isset($delete_enable)) { ?>
                <input type="button" value="Delete" onclick="goDelete()" />
            <? } ?>
            </form>
		</div> 
	</div>
</body>
</html>