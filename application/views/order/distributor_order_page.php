<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Order</title>
</head>
<body>

<div id="container">
	<input type="button" value="Add New Order" onclick="javascript:location.href='<?=site_url("order/add_order/".$distributor_id)?>'"/>
<div>

</div>
<table>
<caption>Order</caption>
<thead>
<tr>
	<td>&nbsp;</td>
	<td>Name</td>
	<td>Product Price</td>
	<td>Shipping Price</td>
	<td>Total Price</td>
	<td>From</td>
	<td>Created Date</td>
	<td>Updated Date</td>
	<td>Status</td>
	<td colspan="2">Action</td>
</tr>
</thead>
<tbody>
<?php
if(!empty($orders))
foreach($orders as $order){
?>	
<tr>
	<td><input type="checkbox" name="selected_order_id[]" value="<?=$order["order_id"]?>"/></td>
	<td><a href="<?=site_url("inventory/view_product/".$distributor_id."/".$order["order_product_id"])?>"><?=$order["order_product_name"]?></a></td>
	<td align="right"><?=$order["order_product_price"]?></td>
	<td align="right"><?=$order["order_shipping_price"]?></td>
	<td align="right"><?=$order["order_total_price"]?></td>
	<td><?=$order["agent_name"]?></td>
	<td><?=$order["order_created_date"]?></td>
	<td><?=$order["order_updated_date"]?></td>
	<td><?=$order["order_status_desc"]?></td>
	<td>
		<input type="button" value="Edit" onclick="javascript:location.href='<?=site_url("order/edit_order/".$distributor_id."/".$order["order_id"])?>'"/>
	</td>
	<td>
		<input type="button" value="Delete" onclick="javascript:location.href='<?=site_url("order/delete_order/".$distributor_id."/".$order["order_id"])?>'"/>
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