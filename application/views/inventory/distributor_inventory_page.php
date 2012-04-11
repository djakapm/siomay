<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="grid_1">
		<h1>Inventory</h1>
	</div>
	<div class="clear"></div>
	<div class="grid_5">
		<input type="button" value="Add New Product" onclick="javascript:location.href='<?=site_url("inventory/add_product/")?>'"/>
		<input type="button" value="Add Bulk Products" onclick="javascript:location.href='<?=site_url("inventory/add_bulk_product/")?>'"/>
	</div>
	<div class="clear"></div>
	<br/>
	<div class="grid_16">
		<table class="data_table">
		<thead>
		<tr>
			<th>&nbsp;</th>
			<th>Name</th>
			<th>Description</th>
			<th>Stock</th>
			<th>Weight(Kg)</th>
			<th>Price(Rp)</th>
			<th>Status</th>
			<th colspan="2">Action</th>
		</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($products))
		foreach($products as $product){
		?>	
		<tr>
			<td><input type="checkbox" name="selected_product_id[]" value="<?=$product["product_id"]?>"/></td>
			<td><a href="<?=site_url("inventory/view_product/".$product["product_id"])?>"><?=$product["product_name"]?></a></td>
			<td><?=word_limiter($product["product_description"],50)?></td>
			<td align="right"><?=$product["product_stock"]?></td>
			<td align="right"><?=$product["product_weight"]?></td>
			<td align="right"><?=$product["product_price"]?></td>
			<td><?=$product["product_status_desc"]?></td>
			<td>
				<input type="button" value="Edit" onclick="javascript:location.href='<?=site_url("inventory/edit_product/".$product["product_id"])?>'"/>
			</td>
			<td>
				<input type="button" value="Delete" onclick="javascript:location.href='<?=site_url("inventory/delete_product/".$product["product_id"])?>'"/>
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