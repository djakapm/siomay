<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Inventory</title>
</head>
<body>

<div id="container">
	<input type="button" value="Add New Product" onclick="javascript:location.href='<?=site_url("inventory/add_product/".$distributor_id)?>'"/>
	<input type="button" value="Add Bulk Products" onclick="javascript:location.href='<?=site_url("inventory/add_bulk_product/".$distributor_id)?>'"/>
<div>

</div>
<table>
<caption>Inventory</caption>
<thead>
<tr>
	<td>&nbsp;</td>
	<td>Name</td>
	<td>Description</td>
	<td>Stock</td>
	<td>Weight(Kg)</td>
	<td>Price(Rp)</td>
	<td>Status</td>
	<td colspan="2">Action</td>
</tr>
</thead>
<tbody>
<?php
if(!empty($products))
foreach($products as $product){
?>	
<tr>
	<td><input type="checkbox" name="selected_product_id[]" value="<?=$product["product_id"]?>"/></td>
	<td><a href="<?=site_url("inventory/view_product/".$distributor_id."/".$product["product_id"])?>"><?=$product["product_name"]?></a></td>
	<td><?=word_limiter($product["product_description"],50)?></td>
	<td align="right"><?=$product["product_stock"]?></td>
	<td align="right"><?=$product["product_weight"]?></td>
	<td align="right"><?=$product["product_price"]?></td>
	<td><?=$product["product_status_desc"]?></td>
	<td>
		<input type="button" value="Edit" onclick="javascript:location.href='<?=site_url("inventory/edit_product/".$distributor_id."/".$product["product_id"])?>'"/>
	</td>
	<td>
		<input type="button" value="Delete" onclick="javascript:location.href='<?=site_url("inventory/delete_product/".$distributor_id."/".$product["product_id"])?>'"/>
	</td>
</tr>
<?php
}
?>
</tbody>
</table>
<input type="button" value="Back to Personal page" onclick="javascript:location.href='<?=site_url("distributor/personal/".$distributor_id)?>'">
</div>

</body>
</html>