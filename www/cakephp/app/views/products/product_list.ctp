<?

if ($num_rows % $pagesize == 0) {
	$no_of_page = $num_rows / $pagesize;
}
else {
	$no_of_page = $num_rows / $pagesize + 1;
}
$no_of_page = (int)$no_of_page;
?>

<p>Product Maintance</p>

<form action="#" method="get">
<p>Search</p>
<table>
	<tr>
    	<td>Product ID:</td>
        <td><input type="text" name="product_id" /></td>
    </tr>
    <tr>
    	<td>Name</td>
        <td><input type="text" name="name" /></td>
    </tr>
    <tr>
    	<td>Category</td>
        <td><? echo $this->element('dropdown', 
			array('name' => 'cat_id',
			'field_name' => 'cat_name', 
			'model' => 'Category',
			'items' => $cat_list,
			'add_null' => 'add_null')); ?></td>
    </tr>
    <tr>
    	<td>Company</td>
        <td><? echo $this->element('dropdown', 
			array('name' => 'make_id',
			'field_name' => 'make_name', 
			'model' => 'Make',
			'items' => $make_list,
			'add_null' => 'add_null')); ?></td>
    </tr>
    <tr>
    	<td>Description</td>
        <td><input type="text" name="desc" /></td>
    </tr>
    <tr>
    	<td>Status</td>
    	<td>
            <select name='sts' >
                <option value="" selected="selected"></option>
                <option value="A" >Active</option>
                <option value="I" >Inactive</option>
	        </select>
        </td>
	</tr>
</table>
<input type="submit" name="search" value="Search" />
</form>  

<br /><br />
<input type="button" onClick="editProdWindow()" value="+" />
<div id="hint">* double click to edit</div>
<div id="pager" class="tablesorterPager">
<form>
    <img src="../js/pager/icons/first.png" class="first" onclick="gotoFirst()"/>
    <img src="../js/pager/icons/prev.png" class="prev" onclick="goToPrev()"/>
    <input type="text" class="pagedisplay" value="1/<?=$no_of_page?>"/>
    <img src="../js/pager/icons/next.png" class="next" onclick="goToNext()"/>
    <img src="../js/pager/icons/last.png" class="last" onclick="goToLast()"/>
    <select class="pagesize" disabled="disabled">
        <option selected="selected"  value="10">10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option  value="40">40</option>
    </select>
    <input type="text" id="page_num" value="1"/><img src="../js/pager/icons/jump.png" class="jump" onclick="goToPage()"/>
</form>
</div>

<div id="product_container">

    <table id="prodTable" class="tablesorter"> 
    <thead> 
        <tr> 
            <th width="30">Product ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Company</th>
            <th>Description</th>
            <th>Remarks</th>
            <th>No. of Photo</th>
            <th>Display Seq</th>
            <th>Status<br />(A / I)</th>
        </tr>
    </thead>
        <tbody>
        <? foreach($prod_list as $products):
        $product = $products['Product'];
		$category = $products['Category'];
		$make = $products['Make']
        ?>
        <tr <? if ($product['sts'] != 'A') { ?> class="inactiveRow" <? }?> onDblClick="editProdWindow('<?=$product['id']?>')">
            <td><?=$product['product_id']?></td>
            <td><?=$product['name']?></td>
            <td><?=$category['cat_name']?></td>
            <td><?=$make['make_name']?></td>
            <td><?=$product['desc']?></td>
            <td><?=$product['remark']?></td>
             <td><?=$product['photo_cnt']?></td>
            <td><?=$product['display_seq']?></td>
            <td><?=$product['sts']?></td>
        </tr>
        <? endforeach; ?>
        </tbody> 
    </table>
</div>
    
<br><br>

<form id="serachCriteria">
	<input type="hidden" name="product_id" value="<?=$product_id?>" />
   	<input type="hidden" name="name" value="<?=$name?>" />
    <input type="hidden" name="cat_id" value="<?=$cat_id?>" />
    <input type="hidden" name="make_id" value="<?=$make_id?>" />
    <input type="hidden" name="desc" value="<?=$desc?>" />
    <input type="hidden" name="sts" value="<?=$sts?>" />
</form>

<?
echo $html->css('/themes/blue/style.css');
echo $html->css('/js/pager/jquery.tablesorter.pager.css');

echo $javascript->link('/jquery-1.4.1.js');
?>

<script type="text/javascript">
/*$(document).ready(function() { 
    $("#prodTable") 
    .tablesorter({widthFixed: true}) 
    .tablesorterPager({container: $("#pager")}); 
	
});*/

var currentPage = 1;
var no_of_page = <?=$no_of_page?>;
var num_rows = <?=$num_rows?>;

function editProdWindow(prod_id) {
	if (prod_id) {
		window.open ("product_edit?prod_id=" + prod_id,"mywindow","status=1,width=800,height=530");
	}
	else {
		window.open ("product_edit","mywindow","status=1,width=800,height=530");
	}
}

function gotoFirst() {
	if (no_of_page != 1) {
		goto_page(1);
	}
}

function goToPrev() {
	if (no_of_page != 1) {
		goto_page(currentPage - 1);
	}
}

function goToNext() {
	if (currentPage != no_of_page) {
		goto_page(currentPage + 1);
	}
}

function goToLast() {
	if (currentPage != no_of_page) {
		goto_page(no_of_page);
	}
}

function goToPage() {
	page = $('#page_num').val();
	if (page != currentPage && page > 0 && page <= no_of_page) {
		goto_page(parseInt(page));
	}
}

function goto_page(page) {
	var searchcriteria = $('#serachCriteria').serialize();
	$('#product_container').load('product_list_paging?num_rows=' + num_rows + '&zpage=' + page + '&pagesize=10&' + encodeURI(searchcriteria),
								function(response, status, xhr) {
									$('.pagedisplay').val(page + '/' + no_of_page);
									currentPage = page;
								});
}

</script>