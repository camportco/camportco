<?
echo $html->css('/themes/blue/style.css');

$product = $products['Product'];
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

<input type="hidden" name="id" size="10" readonly="readonly" value="<?=$product['id']?>" />

<p id="menu">Product Creation/Edit</p>
<table class="dataTable">
<tr>
	<th>Product ID</th><td><input type="text" name="product_id" size="40" maxlength="100" value="<?=$product['product_id']?>"  <? if ($product != null) {?> readonly="readonly" <? }?>/></td>
</tr>
<tr>
	<th>Name</th><td><input type="text" name="name" size="40" maxlength="100" value="<?=$product['name']?>"/></td>
</tr>
<tr>
	<th>Category</th>
    <td>
			<? echo $this->element('dropdown', 
			array('name' => 'cat_id',
			'field_name' => 'cat_name', 
			'model' => 'Category',
			'items' => $cat_list,
			'selected_id' => $product['cat_id'])); ?>
	</td>
</tr>
<tr>
	<th>Company</th>
    <td>
		<? echo $this->element('dropdown', 
			array('name' => 'make_id',
			'field_name' => 'make_name', 
			'model' => 'Make',
			'items' => $make_list,
			'selected_id' => $product['make_id'])); ?>
	</td>
</tr>
<tr>
	<th>Description</th><td><textarea rows="5" cols="40" name="desc"><?=$product['desc']?></textarea></td>
</tr>
<tr>
	<th>Remarks</th><td><textarea rows="5" cols="40" name="remark"><?=$product['remark']?></textarea></td>
</tr>
<tr>
    <th>Display Seq</th><td><input type="text" name="display_seq" size="10" maxlength="10" value="<?=$product['display_seq']?>" /></td>
</tr>
<tr>
	<th>Status</th>
    <td>
    	<? if ($product == NULL || $product['sts'] == 'A' ) { ?>
            <input type="radio" name="sts" value="A" checked="checked" /> Active
            <input type="radio" name="sts" value="I" /> Inactive
		<? } else { ?>
        	<input type="radio" name="sts" value="A" /> Active
            <input type="radio" name="sts" value="I" checked="checked" /> Inactive
        <? } ?>
	</td>
</tr>
<tr>
	<th>No. of Photo</th>
    <td><input type="text" name="photo_cnt" size="10" maxlength="10" value="<?=$product['photo_cnt']?>" /></td>
</tr>
<tr>
	<th>Image (Small):</th>
    <td>
        <? echo $form->file('img_s');?>
		<? if (isset($img_small_exist)) { ?><a href="../product_images/<?=$product['product_id']?>_s.jpg" target="_blank">Image</a> <? } ?>
    </td>
</tr>
<tr>
	<th>Image (Large):</th>
    <td>
    	<? echo $form->file('img_l');?>
		<? if (isset($img_large_exist)) { ?><a href="../product_images/<?=$product['product_id']?>_l.jpg" target="_blank">Image</a> <? } ?>
    </td>
</tr>
</table>