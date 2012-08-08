<? echo $javascript->link('/jquery-1.4.2.min.js', false); ?>
<? echo $javascript->link('/ui/jquery.ui.core.js', false); ?>
<? echo $javascript->link('/ui/jquery.ui.widget.js', false); ?>

<?
echo $html->css('/mopBox/mopBox-2.5.css');
echo $javascript->link('/ui/jquery.ui.mouse.js');
echo $javascript->link('/ui/jquery.ui.draggable.js');
echo $javascript->link('/ui/jquery.ui.resizable.js');
echo $javascript->link('/mopBox/jquery.pngFix.js');
echo $javascript->link('/mopBox/mopBox-2.5.js'); ?>

<style type="text/css">

.searchRslt {
	width: 700px;
	text-align: left;
	padding: 10px;
}

.img_s { margin-left: auto; margin-right: auto; display:block; border: 3px solid #eee; padding: 1px; max-width:220px; max-height:130px; }
.searchRslt td, .searchRslt th {vertical-align:top; text-align: left }
.loading td {vertical-align: middle; text-align: center}
</style>

<div class='searchRslt'>
<table cellspacing="20">
<? 
$i = 0;

foreach($products as $item): 
	$product = $item['Product'];
	$make = $item['Make'];
	$product['desc'] = str_replace( "\r\n", "</p><p>",$product['desc']);
	$product['desc'] = "<p>" . $product['desc']. "</p>";
?>
<tr>
    <td width="220">
        <a id="<?='a_prod_'.$i ?>" href="#p">
        <img class="img_s" src="<?=PROD_IMG_DIR.$product['product_id'].'_s.jpg'?>" onclick="prod_click('<?=$product['product_id']?>')"/>
        </a>
    </td>
    <td>
        <table>
            <tr><td colspan="2" align="left"><? echo $html->image("../images/prod_info.gif", array("width" => "250", "height"=> "25")); ?></td></tr>
            <tr><th width="100">ID:</th><td><?=$product['product_id']?></td></tr>
            <tr><th>Name:</th><td><?=$product['name']?></td></tr>
            <tr><th>Company:</th><td><?=$make['make_name']?></td></tr>
            <tr><th>Description:</th><td><? if (!empty($product['desc'])) { echo $product['desc']; } else {echo "No description";}?></td></tr>
            <tr><th>Remark:</th><td><? if (!empty($product['remark'])) { echo $product['remark']; } else {echo "No remark";}?></td></tr>
        </table>
    </td>
</tr>
<? $i++; endforeach; ?>
</table>
<br>
</div>

<!-- For mopbox -->
<div class="hidden">
	<input type="button" id="mopbox"/>
	<div id="prod_detail">
	</div>
</div>

<script type="text/javascript">
	var jq = jQuery.noConflict();
	
	jq(document).ready(function(){
		jq(document).bind("contextmenu",function(e){
			return false;
		});
		
		jq("#mopbox").mopBox({'target':'#prod_detail','w':1000,'h':400});
	});
	
	function prod_click(product_id){
		jq("#prod_detail").html('<table class=\"loading\"><tr><td width=1000 align=center><? echo $html->image("../images/loading.gif")?></td></tr></table>');
		jq("#mopbox").click();
		jq("#prod_detail").load("<?=$html->webroot?>products/mopbox_form?product_id=" + product_id,
			function(){
				jq("#mopbox").click();
			}
		);
	};
</script>
