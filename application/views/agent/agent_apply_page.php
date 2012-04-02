<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="grid_16">
		<div class="input_form">
			<form method="post" action="<?=site_url("agent/do_search_distributor_by_email")?>">
				<input type="hidden" name="agent_id" value="<?=$agent_id?>"/>
				<fieldset>
					<legend>Search</legend>
					<input type="text" name="distributor_email" value=""/>
					<input type="submit" value="Search Distributor"/>
					<input type="button" value="Back to Personal page" onclick="javascript:location.href='<?=site_url("agent/personal/".$agent_id)?>'"/>
				</fieldset>
			</form>
		</div>
	</div>
	<div class="clear"></div>
	<div class="grid_16">
			<?php
			if(!empty($distributor_id)){
			?>
			<div style="width:100%">
				<form method="post" action="<?=site_url("agent/do_apply")?>">
					<input type="hidden" name="agent_id" value="<?=$agent_id?>"/>
					<input type="hidden" name="distributor_id" value="<?=$distributor_id?>"/>
				<h1>Distributor Profile</h1>
				<p><?=$distributor_description?></p>
				<p style="margin:0"><?=$distributor_name?></p>
				<p style="margin:0"><?=$distributor_phone_number?></p>
				<p style="margin:0"><?=$distributor_email?></p>
				<p style="margin:0"><?=$distributor_city?></p>
				<p style="margin:0"><?=$distributor_address?></p>
				<p style="margin:0"><?=$distributor_zip_code?></p>
				<div class="clear"></div>
				<div style="height:20px">
					<div style="float:left">
						<input type="button" value="Back to Personal page" onclick="javascript:location.href='<?=site_url("agent/personal/".$agent_id)?>'"/>
					</div>
					<div style="float:right">
						<input type="submit" value="Apply"/>
					</div>
				</div>
				</form>
			</div>
			<?php
			}
			?>
	</div>
</div>
<!-- end:content -->
<?=$this->load->view("footer",true)?>
