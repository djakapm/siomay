<?=$this->load->view("header",true)?>
<!-- begin:content -->
<div class="container_16">
	<div class="grid_1">
		<h1>Inbox</h1>
	</div>
	<div class="clear"></div>
	<div class="grid_16">
		<ul style="list-style:none">
			<?php
			if(!empty($inbox_items))
			foreach($inbox_items as $inbox_item){
			?>	
			<li style="background-color:<?=($inbox_item["status"] == "READ" ? "#fff" : "#EBEEF4")?>;border-top:1px solid #DCE2EC;height:50px;border-bottom:1px solid #DCE2EC;height:50px;margin-bottom:5px;padding: 10px 10px 0 10px">
				<a href="<?=site_url("agent/view_inbox_item/".$inbox_item["id"])?>">
					<div style="display:block;height:100%;float:left;width:50%">
						<?=$inbox_item["from_name"]?>
						<p><?=word_limiter($inbox_item["message"],10)?></p>
					</div>
					<div style="display:block;height:100%;float:right;width:50%;text-align:right">
						<p><?=date("F j, Y, g:i a",strtotime($inbox_item["sent_date"]))?></p>
					</div>
				</a>
			</li>
			<?php
			}
			?>			
		</ul>
	</div>
	<input type="button" value="Back to Personal page" onclick="javascript:location.href='<?=site_url("agent/personal/".$agent_id)?>'">
</div>
<!-- end:content -->
<?=$this->load->view("footer",true)?>
