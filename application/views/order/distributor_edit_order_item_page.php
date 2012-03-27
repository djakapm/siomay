<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Order</title>
</head>
<body>

<div id="container">
<form method="post" action="<?=site_url("order/do_edit_order")?>">
<input type="hidden" name="distributor_id" value="<?=$distributor_id?>"/>
<input type="hidden" name="order_id" value="<?=$order["order_id"]?>"/>

<fieldset>
<legend>Edit Order</legend>
<span>Product Name</span><br/>
<span><?=$product_selections[$order["order_product_id"]]?></span><br/>

<span>Product Price</span><br/>
<span><?=$order["order_product_price"]?></span><br/>

<label for="amount_of_goods">Amount of Goods</label><br/>
<input name="amount_of_goods" id="amount_of_goods" type="text" value="<?=$order["order_amount_of_goods"]?>"/><br/>

<span>Product Weight</span><br/>
<span><?=$order["order_product_weight"]?></span><br/>

<span>Shipping Price</span><br/>
<span><?=$order["order_shipping_price"]?></span><br/>

<label for="from" title="Agent's email">From</label><br/>
<input name="from" id="from" type="text" value="<?=$order["agent_email"]?>"/><br/>

<label for="order_status">Status</label><br/>
<?=form_dropdown("order_status", $order_statuses,$order["order_status"],"id=\"order_status\"")?><br/>

<label for="notes">Notes</label><br/>
<textarea name="notes" id="notes" cols="50" rows="10"><?=$order["order_notes"]?></textarea>
<br/>

<br/>
<input type="button" value="Back to Order page" onclick="javascript:location.href='<?=site_url("order/view_orders/".$distributor_id)?>'">
<input type="submit" value="Update Order"/>
</fieldset>
</div>
</form>
</body>
</html>