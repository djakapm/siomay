<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="alpha grid_16 omega" style="text-align:center">
		<h3>Sign in to Gudang Virtual!</h3>
	</div>
	<div class="clear"></div>
	<div class="prefix_3 grid_4">
		<div class="login_form">
			<form method="post" action="<?=site_url("agent/do_login")?>">
			<fieldset>
				<legend>Agent</legend>
				<label for="agent_email">Email</label><br/>
				<input id="agent_email" name="agent_email" value=""/><br/>

				<label for="agent_password">Password</label><br/>
				<input id="agent_password" name="agent_password" type="password"/><br/>

				<input type="submit" value="Login"/>
				</fieldset>
			</form>
		<div>
			<a href="<?=base_url()?>">Forgot Password</a>
		</div>
		<div>
			<a href="<?=site_url("agent/register")?>">Become an Agent</a>
		</div>
		</div>
	</div>
	<div class="grid_2" style="text-align:center">
		<h1>Or</h1>
	</div>
	<div class="grid_4">
		<div class="login_form">
		<form method="post" action="<?=site_url("distributor/do_login")?>">
			<fieldset>
				<legend>Distributor</legend>
				<label for="distributor_email">Email</label><br/>
				<input id="distributor_email" name="distributor_email" value=""/><br/>

				<label for="distributor_password">Password</label><br/>
				<input id="distributor_password" name="distributor_password" type="password"/><br/>

				<input type="submit" value="Login"/>
			</fieldset>
		</form>
		<div>
			<a href="<?=base_url()?>">Forgot Password</a>
		</div>
		<div>
			<a href="<?=site_url("distributor/register")?>">Become a Distributor</a>
		</div>
		</div>
	</div>
</div>
<div class="clear"></div>
<!-- end:content -->
<?=$this->load->view("footer",true)?>
