<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
		<div class="prefix_1 grid_15">
			<div class="input_form">
				<form method="post" action="<?=site_url("agent/do_register")?>">
					<fieldset>
						<legend>New Agent Registration</legend>
						<div>
							<div class="label">
								<label for="agent_name">Name</label>
							</div>
							<div class="input">
								<input id="agent_name" name="agent_name" value=""/>
							</div>
						</div>
						<div>
							<div class="label">						
								<label for="agent_phone_number">Handphone No.</label>
							</div>
							<div class="input">
								<input id="agent_phone_number" name="agent_phone_number" value=""/>
							</div>
						</div>
						<div>
							<div class="label">
								<label for="agent_email">Email</label>
							</div>
								<div class="input">
								<input id="agent_email" name="agent_email" value=""/>
							</div>
						</div>
						<fieldset class="sub_fieldset">
							<legend>Security</legend>
						<div>
							<div class="label">
								<label for="agent_password">Password</label>
							</div>
								<div class="input">
								<input id="agent_password" name="agent_password" type="password"/>
							</div>
						</div>
						<div>
							<div class="label">
								<label for="agent_password_confirmed">Re-Type Password</label>
							</div>
							<div class="input">
								<input id="agent_password_confirmed" name="agent_password_confirmed" type="password"/>
							</div>
						</div>
						</fieldset>
						<fieldset class="sub_fieldset">
							<legend>Address</legend>
						<div>
							<div class="label">
								<label for="agent_city">City</label>
							</div>
							<div class="input">
								<?=form_dropdown("agent_city", $cities,"","id=\"agent_city\"")?>
							</div>
						</div>
						<div>
							<div class="label">
								<label for="agent_address">Street Address</label>
							</div>
								<div class="input">
								<input id="agent_address" name="agent_address" value=""/><br/>
							</div>
						</div>
						<div>
							<div class="label">
								<label for="agent_zip_code">ZIP Code</label>
							</div>
							<div class="input">
								<input id="agent_zip_code" name="agent_zip_code" value=""/>
							</div>
						</div>
						</fieldset>
						<div class="buttons">
							<div class="left_block">
								<input type="button" value="Back to Home page" onclick="cancel()"/>
							</div>
							<div class="right_block">
								<input type="submit" value="Register"/>
							</div>
						</div>
					</fieldset>
				</form>
		</div>
	</div>
</div>
<script type="text/javascript">
function cancel(){
	location.href='<?=base_url()?>';
}
</script>
<!-- end:content -->
<?=$this->load->view("footer",true)?>
