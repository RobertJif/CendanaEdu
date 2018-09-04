<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistem Informasi Akademik SMA Cendana Pekanbaru</title>

	<!-- Bootstrap -->
	<link href="<?php echo base_url();?>asset/login/css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			background-color:#eee;
		}
		.row {
			margin:100px auto;
			width:300px;
			text-align:center;
		}
		.login {
			background-color:#fff;
			padding:20px;
			margin-top:20px;
		}
	</style>

</head>
<body>
	
	<div class="container" style="margin-top:-50px">
		<div class="row">
<a href="<?php echo site_url('Login_controller/index') ?>">
<img src="<?php echo base_url();?>asset/gambar/logo.gif " style="width:120px;height:120px;" alt="User Image">
			</a>
			<div class="login">
				
				
				<form role="form" action="<?php echo site_url('Login_controller/cekLogin') ?>" method="post">
					<div class="form-group">
						<input type="text" name="id" class="form-control" placeholder="NISN/NIP" required autofocus />
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password" required autofocus />
					</div>
					
					<div class="form-group">
						<input type="submit" name="login" class="btn btn-primary btn-block" value="Login" />
					</div>
				</form>
			</div>
			<br>&copy; 2018 Sistem Informasi Akademik <br> SMA Cendana Rumbai
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="<?php echo base_url();?>asset/login/js/bootstrap.min.js"></script>
</body>
</html>