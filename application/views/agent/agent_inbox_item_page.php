<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - Agent View Message</title>
</head>
<body>

<div id="container">
<p>From</p>
<p><a href="#"><?=$inbox_item["from_name"]?></a></p>
<p>Status</p>
<p><?=$inbox_item["status"]?></p>
<p>Message</p>
<p><?=$inbox_item["message"]?></p>

<input type="button" value="Back to Inbox" onclick="javascript:location.href='<?=site_url("agent/view_inbox/".$agent_id)?>'">
</div>

</body>
</html>