<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="grid_1">
		<h1>Orders</h1>
	</div>
	<div class="clear"></div>
	<div class="grid_2">
		<input type="button" value="Add New Order" onclick="javascript:location.href='<?=site_url("order/add_order/")?>'"/>
	</div>
	<div class="clear"></div>
	<br/>
	<div class="grid_16">
		<table class="data_table">
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th nowrap="nowrap">Name</th>
					<th nowrap="nowrap">Product Price</th>
					<th nowrap="nowrap">Shipping Price</th>
					<th nowrap="nowrap">Total Price</th>
					<th nowrap="nowrap">From</th>
					<th nowrap="nowrap">Created Date</th>
					<th nowrap="nowrap">Updated Date</th>
					<th nowrap="nowrap">Status</th>
					<th colspan="2">Action</th>
				</tr>
			</thead>
		<tbody>
		<?php
		if(!empty($orders))
		foreach($orders as $order){
		?>	
		<tr>
			<td><input type="checkbox" name="selected_order_id[]" value="<?=$order["order_id"]?>"/></td>
			<td><a href="<?=site_url("inventory/view_product/".$order["order_product_id"])?>"><?=$order["order_product_name"]?></a></td>
			<td align="right"><?=$order["order_product_price"]?></td>
			<td align="right"><?=$order["order_shipping_price"]?></td>
			<td align="right"><?=$order["order_total_price"]?></td>
			<td><?=$order["agent_name"]?></td>
			<td><?=$order["order_created_date"]?></td>
			<td><?=$order["order_updated_date"]?></td>
			<td><?=$order["order_status_desc"]?></td>
			<td>
				<input type="button" value="Edit" onclick="javascript:location.href='<?=site_url("order/edit_order/".$order["order_id"])?>'"/>
			</td>
			<td>
				<input type="button" value="Delete" onclick="javascript:location.href='<?=site_url("order/delete_order/".$order["order_id"])?>'"/>
			</td>
		</tr>
		<?php
		}
		?>
		</tbody>
		</table>
	</div>
	<div class="clear"></div>
	<div class="grid_2">
		<input type="button" value="Back to Personal page" onclick="javascript:location.href='<?=site_url("distributor/personal/")?>'">
	</div>
</div>
<!-- end:content -->
<?=$this->load->view("footer",true)?>
