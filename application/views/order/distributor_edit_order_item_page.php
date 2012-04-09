<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="prefix_1 grid_15">
		<div class="input_form">
			<form method="post" action="<?=site_url("order/do_edit_order")?>">
			<input type="hidden" name="order_id" value="<?=$order["order_id"]?>"/>

			<fieldset>
			<legend>Edit Order</legend>			
			<div>
				<div class="label">
					<label for="amount_of_goods">Amount of Goods</label>
				</div>
				<div class="input">
					<input name="amount_of_goods" id="amount_of_goods" type="text" value="<?=$order["order_amount_of_goods"]?>"/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="from" title="Agent's email">From</label>
				</div>
				<div class="input">
					<input name="from" id="from" type="text" value="<?=$order["agent_email"]?>"/>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="order_status">Status</label>
				</div>
				<div class="input">
					<?=form_dropdown("order_status", $order_statuses,$order["order_status"],"id=\"order_status\"")?>
				</div>
			</div>
			<div>
				<div class="label">
					<label for="notes">Notes</label>
				</div>
				<div class="input">
					<textarea name="notes" id="notes" cols="50" rows="10"><?=$order["order_notes"]?></textarea>
				</div>
			</div>
			<div class="clear"></div>
			<fieldset class="sub_fieldset">
				<legend>Detail</legend>
				<span>Product Name</span><br/>
				<span><?=$product_selections[$order["order_product_id"]]?></span><br/>

				<span>Product Price</span><br/>
				<span><?=$order["order_product_price"]?></span><br/>
				<span>Product Weight</span><br/>
				<span><?=$order["order_product_weight"]?></span><br/>
				<span>Shipping Price</span><br/>
				<span><?=$order["order_shipping_price"]?></span><br/>

			</fieldset>
			<div class="buttons">
				<div class="left_block">
					<input type="button" value="Back to Order page" onclick="javascript:location.href='<?=site_url("order/view_orders/".$distributor_id)?>'">
				</div>
				<div class="right_block">
					<input type="submit" value="Update Order"/>
				</div>
			</div>
			</fieldset>
			</form>
		</div>
	</div>
</div>
<!-- end:content -->
<?=$this->load->view("footer",true)?>
