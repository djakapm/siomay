<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Inventory</title>
</head>
<body>

<div id="container">
<form method="post" action="<?=site_url("inventory/do_add_bulk_product")?>" enctype="multipart/form-data">
<input type="hidden" name="distributor_id" value="<?=$distributor_id?>"/>
<fieldset>
<legend>Add Bulk Product</legend>

<label for="product_file">File</label><br/>
<input name="product_file" id="product_file" type="file"/><br/>

<br/>
<input type="button" value="Back to Inventory page" onclick="javascript:location.href='<?=site_url("inventory/view_products/".$distributor_id)?>'">
<input type="submit" value="Upload Bulk Product"/>
</fieldset>
</div>
</form>
</body>
</html>