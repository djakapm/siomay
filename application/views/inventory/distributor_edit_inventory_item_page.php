<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Inventory</title>
</head>
<body>

<div id="container">
<form method="post" action="<?=site_url("inventory/do_edit_product")?>" enctype="multipart/form-data">
<input type="hidden" name="distributor_id" value="<?=$distributor_id?>"/>
<input type="hidden" name="product_id" value="<?=$product_id?>"/>
<input type="hidden" name="product_name" value="<?=$product["product_name"]?>"/>
<fieldset>
<legend>Edit Product</legend>
<label for="product_name">Name</label><br/>
<p><?=$product["product_name"]?><p/>

<label for="product_category">Category</label><br/>
<?=form_dropdown("product_category", $product_categories,$product["product_category_id"],"id=\"product_category\"")?><br/>

<label for="product_stock">Stock</label><br/>
<input name="product_stock" id="product_stock" type="text" value="<?=$product["product_stock"]?>"/><br/>

<label for="product_weight" title="Weight per item">Weight</label><br/>
<input name="product_weight" id="product_weight" type="text" value="<?=$product["product_weight"]?>"/><br/>

<label for="product_price" title="Distributor price">Price</label><br/>
<input name="product_price" id="product_price" type="text" value="<?=$product["product_price"]?>"/><br/>

<label for="product_image">Picture</label><br/>
<?php
if(!empty($product["product_image_path"])){
?>
<img src="<?=base_url().$product["product_image_path"]?>" alt="current_product_image"/><br/>
<?php } else{?>
<p>No image available for this product.</p>
<?php } ?>
<input name="product_image" id="product_image" type="file"/><br/>


<label for="product_description">Description</label><br/>
<textarea name="product_description" id="product_description" rows="10" cols="50"/><?=$product["product_description"]?></textarea><br/>

<label for="product_tag">Tag</label><br/>
<input name="product_tag" id="product_tag" type="text" value="<?=$product["product_tag"]?>"/><br/>

<label for="product_status">Status</label><br/>
<?=form_dropdown("product_status", $product_statuses,$product["product_status"],"id=\"product_status\"")?><br/>

<br/>
<input type="button" value="Back to Inventory page" onclick="javascript:location.href='<?=site_url("inventory/view_products/".$distributor_id)?>'">
<input type="submit" value="Save Changes"/>
</fieldset>
</div>
</form>
</body>
</html>