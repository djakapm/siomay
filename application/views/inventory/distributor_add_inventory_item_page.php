<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Inventory</title>
</head>
<body>

<div id="container">
<form method="post" action="<?=site_url("inventory/do_add_product")?>" enctype="multipart/form-data">
<input type="hidden" name="distributor_id" value="<?=$distributor_id?>"/>
<fieldset>
<legend>Add New Product</legend>
<label for="product_name">Name</label><br/>
<input name="product_name" id="product_name" type="text" value="Prisma Orange"/><br/>

<label for="product_category">Category</label><br/>
<?=form_dropdown("product_category", $product_categories,"","id=\"product_category\"")?><br/>

<label for="product_stock">Stock</label><br/>
<input name="product_stock" id="product_stock" type="text" value="15"/><br/>

<label for="product_weight" title="Weight per item">Weight</label><br/>
<input name="product_weight" id="product_weight" type="text" value="2.4"/><br/>

<label for="product_price" title="Distributor price">Price</label><br/>
<input name="product_price" id="product_price" type="text" value="234000"/><br/>

<label for="product_image">Picture</label><br/>
<input name="product_image" id="product_image" type="file"/><br/>

<label for="product_description">Description</label><br/>
<textarea name="product_description" id="product_description" rows="10" cols="50"/>Sprei terbuat dari bahan katun Panca Agung ⁄ CVC</textarea><br/>

<label for="product_tag">Tag</label><br/>
<input name="product_tag" id="product_tag" type="text" value="spre,super,duper"/><br/>

<label for="product_status">Status</label><br/>
<?=form_dropdown("product_status", $product_statuses,"","id=\"product_status\"")?><br/>

<br/>
<input type="button" value="Back to Inventory page" onclick="javascript:location.href='<?=site_url("inventory/view_products/".$distributor_id)?>'">
<input type="submit" value="Save New Product"/>
</fieldset>
</div>
</form>
</body>
</html>