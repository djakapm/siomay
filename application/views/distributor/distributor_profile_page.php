<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="prefix_4 grid_8">
		<div class="input_form">
			<form method="post" action="<?=site_url("distirbutor/do_save_profile")?>">
			<fieldset>
				<legend>Distributor Profile</legend>
				<div>
					<div class="label">
						<label>Name</label>
					</div>
					<div class="input">
						<input name="distributor_name" value="<?=$distributor_name?>" type="text"/>
					</div>
				</div>
				<div>
					<div class="label">
						<label>Phone Number</label>
					</div>
					<div class="input">
						<input type="text" name="distributor_phone_number" value="<?=$distributor_phone_number?>"/>
					</div>
				</div>
				<div>
					<div class="label">
						<label>Email</label>
					</div>
					<div class="input">
						<input type="text" name="distributor_email" value="<?=$distributor_email?>"/>
					</div>
				</div>
				<div>
					<div class="label">
						<label>City</label>
					</div>
					<div class="input">
						<input type="text" name="distributor_city" value="<?=$distributor_city?>"/>
					</div>
				</div>
				<div>
					<div class="label">
						<label>Address</label>
					</div>
					<div class="input">
						<input type="text" name="distributor_address" value="<?=$distributor_address?>"/>
					</div>
				</div>
				<div>
					<div class="label">
						<label>ZIP Code</label>
					</div>
					<div class="input">
						<input type="text" name="distributor_zip_code" value="<?=$distributor_zip_code?>"/>
					</div>
				</div>
				<div>
					<div class="label">
						<label>Description</label>
					</div>
					<div class="input">
						<input type="text" name="distributor_description" value="<?=$distributor_description?>"/>
					</div>
				</div>
				<div class="buttons">
					<div class="left_block">
						<input type="button" value="Back to Personal page" onclick="javascript:location.href='<?=site_url("distributor/personal/".$distributor_id)?>'">
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
<!-- end:content -->
<?=$this->load->view("footer",true)?>
