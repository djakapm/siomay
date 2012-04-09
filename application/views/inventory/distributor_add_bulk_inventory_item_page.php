<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="prefix_1 grid_15">
		<div class="input_form">
		<form method="post" action="<?=site_url("inventory/do_add_bulk_product")?>" enctype="multipart/form-data">
		<input type="hidden" name="distributor_id" value="<?=$distributor_id?>"/>
		<fieldset>
		<legend>Add Bulk Product</legend>
		<div>
			<div class="label">
				<label for="product_file">File</label>
			</div>
			<div class="input">
				<input name="product_file" id="product_file" type="file"/>
			</div>
		</div>

		<div class="buttons">
			<div class="left_block">
				<input type="button" value="Back to Inventory page" onclick="javascript:location.href='<?=site_url("inventory/view_products/")?>'">
			</div>
			<div class="right_block">
				<input type="submit" value="Upload Bulk Product"/>
			</div>
		</div>
		</fieldset>
		</form>
		</div>
	</div>
</div>	
<!-- end:content -->
<?=$this->load->view("footer",true)?>