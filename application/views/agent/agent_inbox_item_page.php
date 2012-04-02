<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
<p>From</p>
<p><a href="#"><?=$inbox_item["from_name"]?></a></p>
<p>Status</p>
<p><?=$inbox_item["status"]?></p>
<p>Message</p>
<p><?=$inbox_item["message"]?></p>

<input type="button" value="Back to Inbox" onclick="javascript:location.href='<?=site_url("agent/view_inbox/".$agent_id)?>'">
</div>
<!-- end:content -->
<?=$this->load->view("footer",true)?>
