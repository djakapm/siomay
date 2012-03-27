<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Inventory</title>
</head>
<body>

<div id="container">
<form method="post" action="<?=site_url("inventory/do_delete_product")?>" enctype="multipart/form-data">
<input type="hidden" name="distributor_id" value="<?=$distributor_id?>"/>
<input type="hidden" name="product_id" value="<?=$product_id?>"/>
<input type="hidden" name="product_name" value="<?=$product["product_name"]?>"/>
<fieldset>
<legend>Delete Product</legend>
<label for="product_name">Name</label><br/>
<p><?=$product["product_name"]?><p/>

<label for="product_category">Category</label><br/>
<p><?=$product["product_category_desc"]?><p/>

<label for="product_stock">Stock</label><br/>
<p><?=$product["product_stock"]?><p/>

<label for="product_weight" title="Weight per item">Weight</label><br/>
<p><?=$product["product_weight"]?><p/>

<label for="product_price" title="Distributor price">Price</label><br/>
<p><?=$product["product_price"]?><p/>

<label for="product_image">Picture</label><br/>
<?php
if(!empty($product["product_image_path"])){
?>
<img src="<?=base_url()."resources/image/".$product["product_image_path"]?>" alt="current_product_image"/><br/>
<?php } else{?>
<p>No image available for this product.</p>
<?php } ?>


<label for="product_description">Description</label><br/>
<p><?=$product["product_description"]?><p/>

<label for="product_tag">Tag</label><br/>
<p><?=$product["product_tag"]?><p/>

<label for="product_status">Status</label><br/>
<p><?=$product["product_status_desc"]?><p/>

<br/>
<input type="button" value="Back to Inventory page" onclick="javascript:location.href='<?=site_url("inventory/view_products/".$distributor_id)?>'">
<input type="submit" value="Remove Product"/>
</fieldset>
</div>
</form>
</body>
</html>