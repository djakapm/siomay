<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Order</title>
</head>
<body>

<div id="container">
<form method="post" action="<?=site_url("order/do_add_order")?>">
<input type="hidden" name="distributor_id" value="<?=$distributor_id?>"/>
<fieldset>
<legend>Add New Order</legend>
<label for="product_name">Product Name</label><br/>
<?=form_dropdown("product_name", $product_selections,"","id=\"product_name\"")?><br/>

<label for="product_price">Product Price</label><br/>
<input name="product_price" id="product_price" type="text" value=""/><br/>

<label for="amount_of_goods">Amount of Goods</label><br/>
<input name="amount_of_goods" id="amount_of_goods" type="text" value=""/><br/>

<label for="product_weight">Product Weight</label><br/>
<input name="product_weight" id="product_weight" type="text" value=""/><br/>

<label for="shipping_price" title="Shipping Price">Shipping Price</label><br/>
<input name="shipping_price" id="shipping_price" type="text" value="6000"/><br/>

<label for="from" title="Agent's email">From</label><br/>
<input name="from" id="from" type="text" value="agent1@email.com"/><br/>

<label for="order_status">Status</label><br/>
<?=form_dropdown("order_status", $order_statuses,"","id=\"order_status\"")?><br/>

<label for="notes">Notes</label><br/>
<textarea name="notes" id="notes" cols="50" rows="10">Some notes</textarea>
<br/>

<br/>
<input type="button" value="Back to Order page" onclick="javascript:location.href='<?=site_url("order/view_orders/".$distributor_id)?>'">
<input type="submit" value="Save New Order"/>
</fieldset>
</div>
</form>
</body>
</html>