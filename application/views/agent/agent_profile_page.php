<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Agent Profile</title>
</head>
<body>

<div id="container">
	<fieldset>
		<legend>Agent Profile</legend>
		<label>Name</label><br/>
		<p><?=$agent_name?></p><br/>
		<label>Phone Number</label><br/>
		<p><?=$agent_phone_number?></p><br/>
		<label>Email</label><br/>
		<p><?=$agent_email?></p><br/>
		<label>City</label><br/>
		<p><?=$agent_city?></p><br/>
		<label>Address</label><br/>
		<p><?=$agent_address?></p><br/>
		<label>ZIP Code</label><br/>
		<p><?=$agent_zip_code?></p><br/>
	</fieldset>
	<input type="button" value="Back to Personal page" onclick="javascript:location.href='<?=site_url("agent/personal/".$agent_id)?>'">
</div>

</body>
</html>