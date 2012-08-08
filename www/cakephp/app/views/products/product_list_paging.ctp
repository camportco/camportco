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