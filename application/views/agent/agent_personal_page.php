<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<h1>Hi, <?=$agent_name?> welcome to Gudang Virtual</h1>
	<p>What would you like to do?</p>
	<ul>
		<li><a href="<?=site_url("agent/profile/".$agent_id)?>">View your profile</a></li>
		<li><a href="<?=site_url("agent/apply/".$agent_id)?>">Apply to a distributor</a></li>
		<li><a href="<?=site_url("agent/view_inbox/".$agent_id)?>">Inbox</a></li>
		<li><a href="<?=site_url("agent/do_logout")?>">Logout</a></li>
	</ul> 

</div>
<!-- end:content -->
<?=$this->load->view("footer",true)?>
