<select name='<?=$name?>' >
	<? 
	if (!isset($selected_id)) $selected_id = 0;
	
	if (isset($add_null)) {?>
        <option value="0"></option>
     <?
	}
	foreach($items as $item):
		$item = $item[$model];
		if ($item['id'] == $selected_id) { ?>
        	<option value="<?=$item['id']?>" selected="selected"><?=$item[$field_name]?></option>
        <? } else { ?>
		    <option value="<?=$item['id']?>"><?=$item[$field_name]?></option>
        <? }?>
    <? endforeach; ?>
</select>