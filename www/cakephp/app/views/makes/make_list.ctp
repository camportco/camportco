<?
echo $html->css('/themes/blue/style.css');

echo $javascript->link('/jquery-1.4.1.js');
echo $javascript->link('jquery.tablesorter.min.js');
?>

<script type="text/javascript">
$(document).ready(function() 
	{ 
		$("#makeTable").tablesorter();
	} 
);

function editMakeWindow(make_id) {
	if (make_id) {
		window.open ("make_edit?make_id=" + make_id,"mywindow","status=1,width=400,height=400");
	}
	else {
		window.open ("make_edit","mywindow","status=1,width=400,height=400");
	}
}
</script>
<p>Company Maintance</p>
<input type="button" onClick="editMakeWindow()" value="+" />
<div id="hint">* double click to edit</div>
<table id="makeTable" class="tablesorter"> 
<thead> 
<tr> 
    <th>id</th>
    <th>Company Name</th>
    <th>Display Seq</th>
</tr>
</thead>
<tbody>
<? foreach($make_list as $makes):
$make = $makes['Make'];
?>
<tr <? if ($make['sts'] != 'A') { ?> class="inactiveRow" <? }?> onDblClick="editMakeWindow('<?=$make['id']?>')">
	<td><?=$make['id']?></td>
	<td><?=$make['make_name']?></td>
    <td><?=$make['display_seq']?></td>
</tr>
<? endforeach; ?>
</tbody> 
</table> 