<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="prefix_3 grid_10">
			<div class="input_form">
				<form method="post" action="<?=site_url("agent/do_save_account")?>">
					<fieldset>
							<legend>Account Setting</legend>
							<fieldset class="sub_fieldset">
								<legend>Change Password</legend>
								<div>
									<div class="label">
									<label for="agent_old_password">Old Password</label>
									</div>
									<div class="input">
									<input type="password" id="agent_old_password" name="agent_old_password" value=""/>
									</div>
								</div>
								<div class="clear"></div>
								<div>
									<div class="label">
									<label for="agent_new_password">New Password</label>
									</div>
									<div class="input">
									<input type="password" id="agent_new_password" name="agent_new_password" value=""/>
									</div>
								</div>
								<div class="clear"></div>
								<div>
									<div class="label">
									<label for="agent_new_confirmed_password">Type The New Password Again</label>
									</div>
									<div class="input">
									<input type="password" id="agent_new_confirmed_password" name="agent_new_confirmed_password" value=""/>
									</div>
								</div>
								<div class="clear"></div>
							</fieldset>

							<div class="buttons">
								<div class="left_block">
									<input type="button" value="Back to Personal page" onclick="cancel()"/>
								</div>
								<div class="right_block">
									<input type="submit" value="Save Account Setting"/>
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
