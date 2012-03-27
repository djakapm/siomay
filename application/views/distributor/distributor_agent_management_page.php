<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Agent Management</title>
</head>
<body>

<div id="container">
<form method="post" action="<?=site_url("distributor/broadcast_message")?>">
<input type="hidden" name="distributor_id" value="<?=$distributor_id?>"/>
<input type="submit" value="Broadcast Message"/><br/>
<table>
<caption>Agent Management</caption>
<thead>
<tr>
	<td>&nbsp;</td>
	<td>Agent Name</td>
	<td colspan="2">Action</td>
</tr>
</thead>
<tbody>
<?php
if(!empty($agents))
foreach($agents as $agent){
?>	
<tr>
	<td><input type="checkbox" name="selected_agent_id[]" value="<?=$agent["agent_id"]?>"/></td>
	<td><a href="<?=site_url("distributor/view_agent_profile/".$agent["agent_id"]."/".$distributor_id)?>"><?=$agent["agent_name"]?></a></td>
	<td>
		<input type="button" value="Send Message" onclick="javascript:location.href='<?=site_url("distributor/send_message/".$distributor_id."/".$agent["agent_id"])?>'"/>
	</td>
	<td>
		<input type="button" value="Terminate Contract" onclick="javascript:location.href='<?=site_url("distributor/terminate_contract/".$distributor_id."/".$agent["agent_id"])?>'"/>
	</td>
</tr>
<?php
}
?>
</tbody>
</table>
</form>
<input type="button" value="Back to Personal page" onclick="javascript:location.href='<?=site_url("distributor/personal/".$distributor_id)?>'">
</div>

</body>
</html>