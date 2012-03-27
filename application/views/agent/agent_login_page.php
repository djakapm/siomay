<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Agent Login</title>
</head>
<body>

<div id="container">
	<form method="post" action="<?=site_url("agent/do_login")?>">
		<fieldset>
			<legend>Agent Login</legend>
			

			<label for="agent_email">Email</label><br/>
			<input id="agent_email" name="agent_email" value="me@email.com"/><br/>

			<label for="agent_password">Password</label><br/>
			<input id="agent_password" name="agent_password" type="password"/><br/>

			<input type="submit" value="Login"/>
		</fieldset>
	</form>
	<div>
	<a href="<?=site_url("agent/register")?>">Become an Agent</a>
	&nbsp;
	<a href="<?=base_url()?>">Home</a>
	</div>
</div>

</body>
</html>