<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="prefix_1 grid_15">
		<div class="input_form">
			<form method="post" action="<?=site_url("inventory/do_edit_product")?>" enctype="multipart/form-data">
			<input type="hidden" name="product_id" value="<?=$product_id?>"/>
			<input type="hidden" name="product_name" value="<?=$product["product_name"]?>"/>
			<fieldset>
			<legend>Edit Product</legend>
			<div>
				<div class="label">
					<label for="product_name">Name</label>
				</div>
				<div class="input">
					<input name="product_name" value="<?=$product["product_name"]?>"/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_category">Category</label>
				</div>
				<div class="input">
					<?=form_dropdown("product_category", $product_categories,$product["product_category_id"],"id=\"product_category\"")?>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_stock">Stock</label>
				</div>
				<div class="input">
					<input name="product_stock" id="product_stock" type="text" value="<?=$product["product_stock"]?>"/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_weight" title="Weight per item">Weight</label>
				</div>
				<div class="input">
					<input name="product_weight" id="product_weight" type="text" value="<?=$product["product_weight"]?>"/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_price" title="Distributor price">Price</label>
				</div>
				<div class="input">
					<input name="product_price" id="product_price" type="text" value="<?=$product["product_price"]?>"/>
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
					<img src="<?=base_url().$product["product_image_path"]?>" alt="current_product_image"/><br/>
					<?php } else{?>
					<p>No image available for this product.</p>
					<?php } ?>
					<input name="product_image" id="product_image" type="file"/>
					</div>
			</div>
			<div>
				<div class="label">
					<label for="product_description">Description</label>
				</div>
				<div class="input">
					<textarea name="product_description" id="product_description" rows="10" cols="50"/><?=$product["product_description"]?></textarea>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_tag">Tag</label>
				</div>
				<div class="input">
					<input name="product_tag" id="product_tag" type="text" value="<?=$product["product_tag"]?>"/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_status">Status</label>
				</div>
				<div class="input">
					<?=form_dropdown("product_status", $product_statuses,$product["product_status"],"id=\"product_status\"")?>
				</div>
			</div>
			<div class="buttons">
				<div class="left_block">
					<input type="button" value="Back to Inventory page" onclick="javascript:location.href='<?=site_url("inventory/view_products/")?>'">
				</div>
				<div class="right_block">
					<input type="submit" value="Save Changes"/>
				</div>
			</div>
			</fieldset>
			</form>
		</div>
	</div>
</div>
<!-- end:content -->
<?=$this->load->view("footer",true)?>