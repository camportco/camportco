<?
echo $html->css('/themes/blue/style.css');

$slideshow = $slideshows['Slideshow'];
?>

<script type="text/javascript">
	function checkFields() {
	
		return true;
	}
</script>

<input type="hidden" name="id" size="10" readonly="readonly" value="<?=$slideshow['id']?>" />

<p id="menu">SlideShow Creation/Edit</p>
<table class="dataTable">
<tr>
	<th>ID</th><td><input type="text" name="id" size="40" maxlength="100" value="<?=$slideshow['id']?>"  <? if ($slideshow != null) {?> readonly="readonly" <? }?>/></td>
	</tr>
	<tr>
	<th>URL</th><td><input type="text" name="url" size="40" maxlength="100" value="<?=$slideshow['url']?>"  /></td>
</tr>
</table>