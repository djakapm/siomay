<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="prefix_1 grid_15">
		<div class="input_form">
			<form method="post" action="<?=site_url("inventory/do_add_product")?>" enctype="multipart/form-data">			
			<fieldset>
			<legend>Add New Product</legend>
			<div>
				<div class="label">
					<label for="product_name">Name</label>
				</div>
				<div class="input">
					<input name="product_name" id="product_name" type="text" value=""/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_category">Category</label>
				</div>
				<div class="input">
					<?=form_dropdown("product_category", $product_categories,"","id=\"product_category\"")?>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_stock">Stock</label>
				</div>
				<div class="input">
					<input name="product_stock" id="product_stock" type="text" value="15"/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_weight" title="Weight per item">Weight</label>
				</div>
				<div class="input">
					<input name="product_weight" id="product_weight" type="text" value=""/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_price" title="Distributor price">Price</label>
				</div>
				<div class="input">
					<input name="product_price" id="product_price" type="text" value=""/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_image">Picture</label>
				</div>
				<div class="input">
					<input name="product_image" id="product_image" type="file"/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_description">Description</label>
				</div>
				<div class="input">
					<textarea name="product_description" id="product_description" rows="10" cols="50"/></textarea>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_tag">Tag</label>
				</div>
				<div class="input">
					<input name="product_tag" id="product_tag" type="text" value=""/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_status">Status</label>
				</div>
				<div class="input">
					<?=form_dropdown("product_status", $product_statuses,"","id=\"product_status\"")?>
				</div>
			</div>
			<div class="buttons">
				<div class="left_block">
					<input type="button" value="Back to Inventory page" onclick="javascript:location.href='<?=site_url("	inventory/view_products/")?>'">
				</div>
				<div class="right_block">
					<input type="submit" value="Save New Product"/>
				</div>
			</div>
			</fieldset>
			</form>
		</div>
	</div>
</div>	
<!-- end:content -->
<?=$this->load->view("footer",true)?>