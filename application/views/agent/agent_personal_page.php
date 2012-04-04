<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="grid_16">
		<h1>Hi, <?=$agent_name?> welcome to Gudang Virtual</h1>
		<p>What would you like to do?</p>
		<ul>
			<li><a href="<?=site_url("agent/profile")?>">View your profile</a></li>
			<li><a href="<?=site_url("agent/apply")?>">Apply to a distributor</a></li>
			<li><a href="<?=site_url("agent/view_inbox")?>">Inbox</a></li>
		</ul> 
	</div>
</div>
<!-- end:content -->
<?=$this->load->view("footer",true)?>
