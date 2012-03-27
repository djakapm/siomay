<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Contract Termination Page</title>
</head>
<body>

<div id="container">
<p>
	Warning!! Terminating contract with the agent will remove all pending transaction. 
	The agent will need to re-apply after contract termination process.
</p>
<form method="post" action="<?=site_url("distributor/do_terminate_contract/".$distributor_id."/".$agent_id)?>">
<input type="submit" value="Terminate Contract"/>
<input type="button" value="Cancel Contract Termination" onclick="javascript:location.href='<?=site_url("distributor/manage_agents/".$distributor_id)?>'"/>
</form>
</div>

</body>
</html>