<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Distributor Profile</title>
</head>
<body>

<div id="container">
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
	<input type="button" value="Back to Personal page" onclick="javascript:location.href='<?=site_url("distributor/personal/".$distributor_id)?>'">
</div>

</body>
</html>