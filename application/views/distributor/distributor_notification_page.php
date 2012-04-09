<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="prefix_4 grid_8">
		<div style="padding: 5px 5px 5px 15px;background-color:#F2F2F2;border-bottom:1px solid #aaa;">
		<p><?=$message?></p>
		<input type="button" value="<?=$action_label?>" onclick="javascript:location.href='<?=$action_url?>'"/>
	</div>
</div>
<!-- end:content -->
<?=$this->load->view("footer",true)?>
