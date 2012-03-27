<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Applying to Distributor</title>
</head>
<body>

<div id="container">
<form method="post" action="<?=site_url("agent/do_search_distributor_by_email")?>">
	<input type="hidden" name="agent_id" value="<?=$agent_id?>"/>
	<fieldset>
		<legend>Search</legend>
		<input type="text" name="distributor_email" value="me@email.com"/>
		<input type="submit" value="Search Distributor"/>
	</fieldset>
</form>
<form method="post" action="<?=site_url("agent/do_apply")?>">
	<?php
	if(!empty($distributor_id)){
	?>
	<input type="hidden" name="agent_id" value="<?=$agent_id?>"/>
	<input type="hidden" name="distributor_id" value="<?=$distributor_id?>"/>
		<fieldset>
			<legend>Distributor Profile</legend>
			<label>Name</label><br/>
			<p><?=$distributor_name?></p><br/>
			<label>Phone Number</label><br/>
			<p><?=$distributor_phone_number?></p><br/>
			<label>Email</label><br/>
			<p><?=$distributor_email?></p><br/>
			<label>City</label><br/>
			<p><?=$distributor_city?></p><br/>
			<label>Address</label><br/>
			<p><?=$distributor_address?></p><br/>
			<label>ZIP Code</label><br/>
			<p><?=$distributor_zip_code?></p><br/>
			<label>Description</label><br/>
			<p><?=$distributor_description?></p><br/>
		</fieldset>
		<input type="submit" value="Apply"/>

	<?php
	}
	?>
</form>
</div>
</body>
</html>