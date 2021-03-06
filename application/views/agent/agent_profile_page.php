<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="prefix_1 grid_15">
			<div class="input_form">
				<form method="post" action="<?=site_url("agent/do_save_profile")?>">
					<fieldset>
							<legend>Agent Profile</legend>
							<div>
								<div class="label">
								<label for="agent_name">Name</label>
								</div>
								<div class="input">
								<input type="text" id="agent_name" name="agent_name" value="<?=$agent_name?>"/>
								</div>
							</div>
							<div class="clear"></div>
							<div>
								<div class="label">							
								<label for="agent_phone_number">Phone Number</label>
								</div>
								<div class="input">
								<input type="text" id="agent_phone_number" name="agent_phone_number" value="<?=$agent_phone_number?>"/>
								</div>
							</div>
							<div class="clear"></div>							
							<div>
								<div class="label">							
								<label for="agent_email">Email</label>
								</div>
								<div class="input">
								<input type="text" id="agent_email" name="agent_email" value="<?=$agent_email?>"/>
								</div>
							</div>
							<div class="clear"></div>
							<fieldset class="sub_fieldset">
									<legend>Address</legend>
							<div>
								<div class="label">							
									<label for="agent_city">City</label>
								</div>
								<div class="input">
									<?=form_dropdown("agent_city", $cities,$agent_city,"id=\"agent_city\"")?>
								</div>
							</div>
							<div class="clear"></div>
							<div>
								<div class="label">							
								<label for="agent_address">Address</label>
								</div>
								<div class="input">
								<input type="text" id="agent_address" name="agent_address" value="<?=$agent_address?>"/>
								</div>
							</div>
							<div class="clear"></div>
							<div>
								<div class="label">							
								<label for="agent_zip_code">ZIP Code</label>
								</div>
								<div class="input">
								<input type="text" id="agent_zip_code" name="agent_zip_code" value="<?=$agent_zip_code?>"/>
								</div>
							</div>
							</fieldset>
							<div class="clear"></div>
							<div class="buttons">
								<div class="left_block">
									<input type="button" value="Back to Personal page" onclick="cancel()"/>
								</div>
								<div class="right_block">
									<input type="submit" value="Save Profile"/>
								</div>
							</div>
					</fieldset>
				</form>			
			</div>
	</div>
</div>
<script type="text/javascript">
function cancel(){
	location.href='<?=site_url("agent/personal/".$agent_id)?>';
}
</script>

<!-- end:content -->
<?=$this->load->view("footer",true)?>
