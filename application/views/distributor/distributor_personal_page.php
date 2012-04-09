<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="grid_6">
		<ul class="personal_menu">
			<li><a href="<?=site_url("order/view_orders/")?>">View orders</a></li>
			<li><a href="<?=site_url("inventory/view_products/")?>">View inventory</a></li>
			<li><a href="<?=site_url("distributor/profile/")?>">View profile</a></li>
			<li><a href="<?=site_url("distributor/view_contracts/")?>">View contracts with agents</a></li>
			<li><a href="<?=site_url("distributor/manage_agents/")?>">View agents</a></li>
			<li><a href="<?=site_url("distributor/do_logout")?>">Logout</a></li>
		</ul> 
	</div>
	<div class="grid_10">
	</div>

</div>
<!-- end:content -->
<?=$this->load->view("footer",true)?>
