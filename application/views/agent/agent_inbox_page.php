<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Agent Inbox</title>
</head>
<body>

<div id="container">
<table>
<caption>Inbox</caption>
<thead>
<tr>
	<td>From</td>
	<td>Message</td>
	<td>Status</td>
</tr>
</thead>
<tbody>
<?php
if(!empty($inbox_items))
foreach($inbox_items as $inbox_item){
?>	
<tr>
	<td><?=$inbox_item["from_name"]?></td>
	<td>
	<p>
		<a href="<?=site_url("agent/view_inbox_item/".$inbox_item["id"])?>"><?=word_limiter($inbox_item["message"],15)?></a>
	</p>
	</td>
	<td><?=$inbox_item["status"]?></td>
</tr>
<?php
}
?>
</tbody>
</table>

<input type="button" value="Back to Personal page" onclick="javascript:location.href='<?=site_url("agent/personal/".$agent_id)?>'">
</div>

</body>
</html>