<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="prefix_1 grid_15">
		<div class="input_form">
			<form method="post" action="<?=site_url("order/do_add_order")?>">
			<fieldset>
			<legend>Add New Order</legend>
			<div>
				<div class="label">
					<label for="product_name">Product Name</label>
				</div>
				<div class="input">
					<?=form_dropdown("product_name", $product_selections,"","id=\"product_name\"")?>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_price">Product Price</label>
				</div>
				<div class="input">
					<input name="product_price" id="product_price" type="text" value=""/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="amount_of_goods">Amount of Goods</label>
				</div>
				<div class="input">
					<input name="amount_of_goods" id="amount_of_goods" type="text" value=""/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="product_weight">Product Weight</label>
				</div>
				<div class="input">
					<input name="product_weight" id="product_weight" type="text" value=""/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="shipping_price" title="Shipping Price">Shipping Price</label>
				</div>
				<div class="input">
					<input name="shipping_price" id="shipping_price" type="text" value="6000"/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="from" title="Agent's email">From</label>
				</div>
				<div class="input">
					<input name="from" id="from" type="text" value=""/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="order_status">Status</label>
				</div>
				<div class="input">
					<?=form_dropdown("order_status", $order_statuses,"","id=\"order_status\"")?>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="notes">Notes</label>
				</div>
				<div class="input">
					<textarea name="notes" id="notes" cols="50" rows="10">Some notes</textarea>
				</div>
			</div>
			<div class="buttons">
				<div class="left_block">
					<input type="button" value="Back to Order page" onclick="javascript:location.href='<?=site_url("order/view_orders/")?>'">
				</div>
				<div class="right_block">
					<input type="submit" value="Save New Order"/>
				</div>
			</div>
			</fieldset>
			</form>
		</div>
	</div>
</div>
<!-- end:content -->
<?=$this->load->view("footer",true)?>
