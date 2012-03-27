<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Distributor Personal</title>
</head>
<body>

<div id="container">
	<h1>Hi, <?=$distributor_name?> welcome to Gudang Virtual</h1>
	<p>What would you like to do?</p>
	<ul>
		<li><a href="<?=site_url("order/view_orders/".$distributor_id)?>">View your orders</a></li>
		<li><a href="<?=site_url("inventory/view_products/".$distributor_id)?>">View your inventory</a></li>
		<li><a href="<?=site_url("distributor/profile/".$distributor_id)?>">View your profile</a></li>
		<li><a href="<?=site_url("distributor/view_contracts/".$distributor_id)?>">View contracts with agents</a></li>
		<li><a href="<?=site_url("distributor/manage_agents/".$distributor_id)?>">View agents</a></li>
		<li><a href="<?=site_url("distributor/do_logout")?>">Logout</a></li>
	</ul> 

</div>

</body>
</html>