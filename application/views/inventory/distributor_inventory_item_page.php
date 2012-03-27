<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Inventory</title>
</head>
<body>

<div id="container">
<div>
<img src="<?=base_url().$product["product_image_path"]?>" alt="image"/>
</div>
<div>
<p>Name</p>
<p><?=$product["product_name"]?></p>
<p>Description</p>
<p><?=$product["product_description"]?></p>
<p>Category</p>
<p><?=$product["product_category_desc"]?></p>
<p>Price</p>
<p><?=$product["product_price"]?></p>
<p>Status</p>
<p><?=$product["product_status_desc"]?></p>
<p>Tags</p>
<p><?=$product["product_tag"]?></p>
</div>
<input type="button" value="Back to Inventory page" onclick="javascript:location.href='<?=site_url("inventory/view_products/".$distributor_id)?>'">
</div>

</body>
</html>