<?
echo $html->css('/themes/blue/style.css');

$newslink = $newslinks['Newslink'];
?>

<script type="text/javascript">
	function checkFields() {
		var missinginfo = "";
		
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

<input type="hidden" name="id" size="10" readonly="readonly" value="<?=$newslink['id']?>" />

<p id="menu">newslink Creation/Edit</p>
<table class="dataTable">
<tr>
	<th>ID</th><td><input type="text" name="id" size="40" maxlength="100" value="<?=$newslink['id']?>"  <? if ($newslink != null) {?> readonly="readonly" <? }?>/></td>
	</tr>
	<tr>
	<th>Content</th><td><input type="text" name="content" size="50" maxlength="200" value="<?=$newslink['content']?>"  /></td>
</tr>
<tr>
	<th>URL</th><td><input type="text" name="url" size="50" maxlength="200" value="<?=$newslink['url']?>"  /></td>
</tr>
<tr>
	<th>Display Seq</th><td><input type="text" name="display_seq" size="10" value="<?=$newslink['display_seq']?>" /></td>
</tr>
</table>