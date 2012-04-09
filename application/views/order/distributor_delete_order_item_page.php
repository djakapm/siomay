<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="prefix_1 grid_15">
		<div class="input_form">
			<form method="post" action="<?=site_url("order/do_delete_order")?>">
			<input type="hidden" name="order_id" value="<?=$order["order_id"]?>"/>

			<fieldset>
			<legend>Delete Order</legend>
			<span>Product Name</span><br/>
			<span><?=$product_selections[$order["order_product_id"]]?></span><br/>

			<span>Product Price</span><br/>
			<span><?=$order["order_product_price"]?></span><br/>

			<span>Amount of Goods</span><br/>
			<span><?=$order["order_amount_of_goods"]?></span><br/>

			<span>Product Weight</span><br/>
			<span><?=$order["order_product_weight"]?></span><br/>

			<span>Shipping Price</span><br/>
			<span><?=$order["order_shipping_price"]?></span><br/>

			<span>From</span><br/>
			<span><?=$order["agent_name"]."(".$order["agent_email"].")"?></span><br/>

			<span>Status</span><br/>
			<span><?=$order_statuses[$order["order_status"]]?></span><br/>

			<label for="notes">Notes</label><br/>
			<p><?=$order["order_notes"]?></p>

			<br/>
			<input type="button" value="Back to Order page" onclick="javascript:location.href='<?=site_url("order/view_orders/".$distributor_id)?>'">
			<input type="submit" value="Delete Order"/>
			</fieldset>
			</form>
		</div>
	</div>

</div>
<!-- end:content -->
<?=$this->load->view("footer",true)?>
