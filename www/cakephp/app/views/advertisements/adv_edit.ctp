<?
echo $html->css('/themes/blue/style.css');

if ($advs != null) {
	$adv = $advs['Advertisement'];
}
else {
	$adv = null;
}
?>

<script type="text/javascript">
	function checkFields() {
		return true;
	}
</script>

<input type="hidden" name="id" readonly="readonly" value="<?=$adv['id']?>" />

<p id="menu">Advertisement Creation/Edit</p>
<table class="dataTable">
<tr>
	<th>Image URL</th><td><input type="text" name="img_url" size="70" value="<?=$adv['img_url']?>"/></td>
</tr>
<tr>
    <th>URL</th><td><input type="text" name="url" size="70" value="<?=$adv['url']?>" /></td>
</tr>
</table>
