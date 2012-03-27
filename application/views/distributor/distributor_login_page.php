<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Distributor Login</title>
</head>
<body>

<div id="container">
	<form method="post" action="<?=site_url("distributor/do_login")?>">
		<fieldset>
			<legend>Distributor Login</legend>
			

			<label for="distributor_email">Email</label><br/>
			<input id="distributor_email" name="distributor_email" value="me@email.com"/><br/>

			<label for="distributor_password">Password</label><br/>
			<input id="distributor_password" name="distributor_password" type="password"/><br/>

			<input type="submit" value="Login"/>
		</fieldset>
	</form>
	<div>
	<a href="<?=site_url("distributor/register")?>">Become an Distributor</a>
	&nbsp;
	<a href="<?=base_url()?>">Home</a>
	</div>
</div>

</body>
</html>