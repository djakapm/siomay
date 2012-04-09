<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="grid_1">
		<h1>Inbox</h1>
	</div>
	<div class="clear"></div>
	<div class="prefix_2 grid_12">
		<div class="block">
		<h1><?=$inbox_item["from_name"]?></h1>
		<p><?=$inbox_item["message"]?></p>
		<input type="button" value="Back to Inbox" onclick="back_to_inbox()">
		</div>
	</div>
</div>
<script type="text/javascript">
function back_to_inbox(){
	location.href='<?=site_url("agent/view_inbox/".$agent_id)?>';
}
</script>
<!-- end:content -->
<?=$this->load->view("footer",true)?>
