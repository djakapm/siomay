<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - New Agent Registration</title>
</head>
<body>

<div id="container">
	<form method="post" action="<?=site_url("agent/do_register")?>">
		<fieldset>
			<legend>New Agent Registration</legend>
			<label for="agent_name">Name</label><br/>
			<input id="agent_name" name="agent_name" value="john doe"/><br/>

			<label for="agent_phone_number">Handphone No.</label><br/>
			<input id="agent_phone_number" name="agent_phone_number" value="082116318693"/><br/>

			<label for="agent_email">Email</label><br/>
			<input id="agent_email" name="agent_email" value="me@email.com"/><br/>

			<label for="agent_password">Password</label><br/>
			<input id="agent_password" name="agent_password" type="password"/><br/>

			<label for="agent_password_confirmed">Re-Type Password</label><br/>
			<input id="agent_password_confirmed" name="agent_password_confirmed" type="password"/><br/>

			<label for="agent_city">City</label><br/>
			<select id="agent_city" name="agent_city">
			<?php
				foreach($cities as $city){
			?>
				<option value="<?=$city["id"]?>"><?=$city["name"]?></option>
			<?php
			}
			?>
			</select><br/>

			<label for="agent_address">Address</label><br/>
			<input id="agent_address" name="agent_address" value="jl.cikoko barat 2"/><br/>

			<label for="agent_zip_code">ZIP Code</label><br/>
			<input id="agent_zip_code" name="agent_zip_code" value="12770"/><br/>
			<input type="submit" value="Register"/>
			<input type="button" value="Cancel" onclick="javascript:location.href='<?=site_url("agent/login");?>'"/>
		</fieldset>
	</form>
</div>

</body>
</html>