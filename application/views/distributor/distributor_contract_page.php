<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Distributor Contracts</title>
</head>
<body>

<div id="container">
<table>
<caption>Pending Agent Contracts</caption>
<thead>
<tr>
	<td>Agent Name</td>
	<td>Status</td>
	<td colspan="2">Action</td>
</tr>
</thead>
<tbody>
<?php
if(!empty($pending_contracts))
foreach($pending_contracts as $contract){
?>	
<tr>
	<td><?=$contract["agent_name"]?></td>
	<td><?=$contract["contract_status"]?></td>
	<td>
		<input type="button" value="Approve" onclick="javascript:location.href='<?=site_url("distributor/process_contract/approve/".$contract["contract_id"]."/".$contract["distributor_id"])?>'"/>
	</td>
	<td>
		<input type="button" value="Reject" onclick="javascript:location.href='<?=site_url("distributor/process_contract/reject/".$contract["contract_id"]."/".$contract["distributor_id"])?>'"/>
	</td>
</tr>
<?php
}
?>
</tbody>
</table>
<hr/>
<table>
<caption>Approved Agent Contracts</caption>
<thead>
<tr>
	<td>Agent Name</td>
	<td>Status</td>
</tr>
</thead>
<tbody>
<?php
if(!empty($approved_contracts))
foreach($approved_contracts as $contract){
?>	
<tr>
	<td><?=$contract["agent_name"]?></td>
	<td><?=$contract["contract_status"]?></td>
</tr>
<?php
}
?>
</tbody>
</table>
<hr/>
<table>
<caption>Rejected Agent Contracts</caption>
<thead>
<tr>
	<td>Agent Name</td>
	<td>Status</td>
</tr>
</thead>
<tbody>
<?php
if(!empty($rejected_contracts))
foreach($rejected_contracts as $contract){
?>	
<tr>
	<td><?=$contract["agent_name"]?></td>
	<td><?=$contract["contract_status"]?></td>
</tr>
<?php
}
?>
</tbody>
</table>
<input type="button" value="Back to Personal page" onclick="javascript:location.href='<?=site_url("distributor/personal/".$distributor_id)?>'">
</div>

</body>
</html>