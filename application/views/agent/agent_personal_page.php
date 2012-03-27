<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Agent Personal</title>
</head>
<body>

<div id="container">
	<h1>Hi, <?=$agent_name?> welcome to Gudang Virtual</h1>
	<p>What would you like to do?</p>
	<ul>
		<li><a href="<?=site_url("agent/profile/".$agent_id)?>">View your profile</a></li>
		<li><a href="<?=site_url("agent/apply/".$agent_id)?>">Apply to a distributor</a></li>
		<li><a href="<?=site_url("agent/view_inbox/".$agent_id)?>">Inbox</a></li>
		<li><a href="<?=site_url("agent/do_logout")?>">Logout</a></li>
	</ul> 

</div>

</body>
</html>