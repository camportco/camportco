<?
echo $html->css('/themes/blue/style.css');

if ($categorys != null) {
	$category = $categorys['Category'];
}
else {
	$category = null;
}
?>

<script type="text/javascript">
	function checkFields() {
		var missinginfo = "";
		
		if (document.form1.cat_name.value == "" ) {
			missinginfo += "\n     -  Category Name";
		}
		
		var varString = document.form1.display_seq.value;
		var intVal = parseFloat(varString);
		if (varString != intVal) {
			missinginfo += "\n     -  Display Seq [should be integer]";
		}
		
		if (missinginfo != "") {
			missinginfo ="_____________________________\n" +
			"You failed to correctly fill in your:\n" +
			missinginfo + "\n_____________________________" +
			"\nPlease re-enter and submit again!";
			alert(missinginfo);
			return false;
		}
		return true;
	}
</script>

<input type="hidden" name="id" size="10" readonly="readonly" value="<?=$category['id']?>" />

<p id="menu">Category Creation/Edit</p>
<table class="dataTable">
<tr>
	<th>Category Name</th><td><input type="text" name="cat_name" size="40" maxlength="100" value="<?=$category['cat_name']?>"/></td>
</tr>
<tr>
    <th>Display Seq</th><td><input type="text" name="display_seq" size="10" maxlength="10" value="<?=$category['display_seq']?>" /></td>
</tr>
<tr>
	<th>Status</th>
    <td>
    	<? if ($category == NULL || $category['sts'] == 'A' ) { ?>
            <input type="radio" name="sts" value="A" checked="checked" /> Active
            <input type="radio" name="sts" value="I" /> Inactive
		<? } else { ?>
        	<input type="radio" name="sts" value="A" /> Active
            <input type="radio" name="sts" value="I" checked="checked" /> Inactive
        <? } ?>
	</td>
</tr>
</table>
