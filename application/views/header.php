<?=doctype("html4-strict")?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual</title>
	<link rel="stylesheet" href="<?=base_url()?>/resources/css/reset.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?=base_url()?>/resources/css/960.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?=base_url()?>/resources/css/text.css" type="text/css" media="screen, projection" />
	<!-- <link href='http://fonts.googleapis.com/css?family=Pontano+Sans' rel='stylesheet' type='text/css'> -->
	<link rel="stylesheet" href="<?=base_url()?>/resources/css/style.css" type="text/css" media="screen, projection" />
</head>
<body>
<!-- begin:header -->
<div id="header">
	<div id="site_title" style="margin-left:15px;float:left">
		<a href="<?=base_url()?>">
			<h1>Gudang Virtual</h1>
		</a>
		<span>A Virtual Warehouse</span>
	</div>
	<div id="top_menu">
		<ul>
			<?php
			$logged_in = $this->session->userdata("logged_in");
			if($logged_in){
				$personal_url = $this->session->userdata("personal_url");
				$profile_url = $this->session->userdata("profile_url");
				$account_url = $this->session->userdata("account_url");
				$log_out_url = $this->session->userdata("log_out_url");
				$name = $this->session->userdata("name");
			?>
			<li>Hi, <a href="<?=$personal_url?>"><?=$name?></a> welcome back!</li>
			<li><a href="<?=$profile_url?>">Profile</a></li>
			<li><a href="<?=$account_url?>">Account</a></li>
			<li><a href="<?=$log_out_url?>">Log Out</a></li>
			<?php
			}
			?>
		</ul>
	</div>
</div>	
<!-- end:header -->
