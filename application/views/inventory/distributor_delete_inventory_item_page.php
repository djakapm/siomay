<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="prefix_1 grid_15">
		<div class="input_form">
			<form method="post" action="<?=site_url("inventory/do_delete_product")?>" enctype="multipart/form-data">
			<input type="hidden" name="product_id" value="<?=$product_id?>"/>
			<input type="hidden" name="product_name" value="<?=$product["product_name"]?>"/>
			<fieldset>
			<legend>Delete Product</legend>
			<div>
				<div class="label">
					<label for="product_name">Name</label>
				</div>
				<div class="input">
					<input name="product_name" value="<?=$product["product_name"]?>" readonly="readonly"/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_category">Category</label>
				</div>
				<div class="input">
					<input name="product_category_desc" value="<?=$product["product_category_desc"]?>" readonly="readonly"/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_stock">Stock</label>
				</div>
				<div class="input">
					<input name="product_stock" value="<?=$product["product_stock"]?>" readonly="readonly"/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_weight" title="Weight per item">Weight</label>
				</div>
				<div class="input">
					<input name="product_weight" value="<?=$product["product_weight"]?>" readonly="readonly"/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_price" title="Distributor price">Price</label>
				</div>
				<div class="input">
					<input name="product_price" value="<?=$product["product_price"]?>" readonly="readonly"/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_image">Picture</label>
				</div>
				<div class="input">
					<?php
					if(!empty($product["product_image_path"])){
					?>
					<img src="<?=base_url().$product["product_image_path"]?>" alt="current_product_image"/>
					<?php } else{?>
					<p>No image available for this product.</p>
					<?php } ?>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_description">Description</label>
				</div>
				<div class="input">
					<input name="product_description" value="<?=$product["product_description"]?>" readonly="readonly"/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_tag">Tag</label>
				</div>
				<div class="input">
					<input name="product_tag" value="<?=$product["product_tag"]?>" readonly="readonly"/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_status">Status</label>
				</div>
				<div class="input">
					<input name="product_status_desc" value="<?=$product["product_status_desc"]?>" readonly="readonly"/>
				</div>
			</div>

			<div class="buttons">
				<div class="left_block">
					<input type="button" value="Back to Inventory page" onclick="javascript:location.href='<?=site_url("inventory/view_products/")?>'">
				</div>
				<div class="right_block">
					<input type="submit" value="Remove Product"/>
				</div>
			</div>
			</fieldset>
			</form>
		</div>
	</div>
</div>
<!-- end:content -->
<?=$this->load->view("footer",true)?>