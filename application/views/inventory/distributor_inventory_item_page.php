<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="prefix_4 grid_8">
		<div class="display_form">
		<fieldset>
			<legend>Product Detail</legend>	
			<div class="line">
				<p class="label">Name</p>
				<p class="content"><?=$product["product_name"]?></p>
			</div>
			<div class="line">
				<p class="label">Description</p>
				<p class="content"><?=$product["product_description"]?></p>
			</div>
			<div class="line">
				<p class="label">Category</p>
				<p class="content"><?=$product["product_category_desc"]?></p>
			</div>
			<div class="line">
				<p class="label">Price</p>
				<p class="content"><?=$product["product_price"]?></p>
			</div>
			<div class="line">
				<p class="label">Status</p>
				<p class="content"><?=$product["product_status_desc"]?></p>
			</div>
			<div class="line">
				<p class="label">Tags</p>
				<p class="content"><?=$product["product_tag"]?></p>
			</div>
			<div class="line">
				<p class="label">Gallery</p>
				<p class="content"><img src="<?=base_url().$product["product_image_path"]?>" alt="image" width="50%" height="50%"/></p>
			</div>
			<br/>
			<div class="buttons">
				<div class="left_block">
				<input type="button" value="Back to Inventory page" onclick="javascript:location.href='<?=site_url("inventory/view_products/".$distributor_id)?>'">
				</div>
			</div>
		</fieldset>
		</div>
	</div>
</div>
<!-- end:content -->
<?=$this->load->view("footer",true)?>