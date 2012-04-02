<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="prefix_4 grid_8">
			<div class="input_form">
				<form method="post" action="<?=site_url("agent/do_login")?>">
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
							<div>
								<div class="label">							
								<label for="agent_city">City</label>
								</div>
								<div class="input">
								<input type="text" id="agent_city" name="agent_city" value="<?=$agent_city?>"/>
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
							<div class="clear"></div>
							<div class="buttons">
								<div class="left_block">
									<input type="button" value="Back to Personal page" onclick="javascript:location.href='<?=site_url("agent/personal/".$agent_id)?>'"/>
								</div>
								<div class="right_block">
									<input type="button" value="Save Profile"/>
								</div>
							</div>
					</fieldset>
				</form>			
			</div>
	</div>
</div>
<!-- end:content -->
<?=$this->load->view("footer",true)?>
