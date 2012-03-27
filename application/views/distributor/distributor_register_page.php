<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Gudang Virtual - New Distributor Registration</title>
</head>
<body>

<div id="container">
	<form method="post" action="<?=site_url("distributor/do_register")?>">
		<fieldset>
			<legend>New Distributor Registration</legend>
			<label for="distributor_name">Name</label><br/>
			<input id="distributor_name" name="distributor_name" value="john doe"/><br/>

			<label for="distributor_phone_number">Handphone No.</label><br/>
			<input id="distributor_phone_number" name="distributor_phone_number" value="082116318693"/><br/>

			<label for="distributor_email">Email</label><br/>
			<input id="distributor_email" name="distributor_email" value="me@email.com"/><br/>

			<label for="distributor_password">Password</label><br/>
			<input id="distributor_password" name="distributor_password" type="password"/><br/>

			<label for="distributor_password_confirmed">Re-Type Password</label><br/>
			<input id="distributor_password_confirmed" name="distributor_password_confirmed" type="password"/><br/>

			<label for="distributor_city">City</label><br/>
			<select id="distributor_city" name="distributor_city">
			<?php
				foreach($cities as $city){
			?>
				<option value="<?=$city["id"]?>"><?=$city["name"]?></option>
			<?php
			}
			?>
			</select><br/>

			<label for="distributor_address">Address</label><br/>
			<input id="distributor_address" name="distributor_address" value="jl.cikoko barat 2"/><br/>

			<label for="distributor_zip_code">ZIP Code</label><br/>
			<input id="distributor_zip_code" name="distributor_zip_code" value="12770"/><br/>

			<label for="distributor_description">Please briefly explain what is your business is about</label><br/>
			<textarea id="distributor_description" name="distributor_description" cols="100" rows="10">
Kami menjual berbagai macam barang yang langka baik legal maupun ilegal.
Kami jamin barang yang kami jual orisinil dan mematikan, jika pelanggan kecewa kami akan ganti uang 100%.
Saat ini kami hanya menangani pesanan yang besar tanpa batas.

Cabang toko kami telah dibuka dimana-mana dengan lokasi rahasia agar terhindar dari pihak yang berwajib.
Barang kami terdiri dari kain-kain import ilegal juga terdapat pahatan yang langka dari berbagai negara.
Kami sangat membutuhkan agen ataupun reseller yang berdedikasi tinggi dan suka resiko, komisi untuk agen/reseller
dapat mencapai 40%.
			</textarea>
			<br/>
			<input type="submit" value="Register"/>
			<input type="button" value="Cancel" onclick="javascript:location.href='<?=site_url("distributor/login");?>'"/>
		</fieldset>
	</form>
</div>

</body>
</html>