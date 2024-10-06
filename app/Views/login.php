<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?= base_url() ?>img/dispopar-logo.png" type="image/png">
    <title>Login SIPT</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('tambahan/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('tambahan/css/login.css'); ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="icon" href="<?php echo base_url('assets/img/form.png'); ?>">
	<script src="<?php echo base_url('tambahan/js/jquery-3.3.1.min.js'); ?>"></script>
	<script src="<?php echo base_url('tambahan/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('tambahan/js/login.js'); ?>"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-8 mt-5">
				<div class="login-form p-5">
					<img src="<?php echo base_url('img/pemkot-bontang.png') ?>" alt="">
					<h3 class="p-4">SISTEM PEMINJAMAN TEMPAT</h3>
					<?php echo form_open('login/proses'); ?>
						<form action="<?php echo base_url('') ?>" method="">
							<?php if(session()->getFlashdata('message')): ?>
								<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" >x</button>
									<?= session()->getFlashdata('message'); ?>
								</div>
							<?php endif; ?>
							<?php if(session()->getFlashdata('gagal')): ?>
								<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert" >x</button>
									<?= session()->getFlashdata('gagal'); ?>
								</div>
							<?php endif; ?>
							<div class="input-group mb-3">
								<input type="text" id="username" name="username" class="form-control" value="<?php echo set_value('username'); ?>" placeholder="nama pengguna">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fa-solid fa-user"></span>
									</div>
								</div>
							</div>
							<div class="input-group mb-3">
								<input type="password" name="password" class="form-control" placeholder="Password">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-lock"></span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-12 text-center">
									<button type="submit" name="masuk" class="btn btn-success btn-block btn-flat">LOGIN</button>
								</div>
							</div>
						</form>
					<?php echo form_close(); ?>
					<p class="text-center mt-3">Belum punya akun? <a href="<?= base_url('register') ?>">Daftar di sini</a></p>				</div>
				</div>
			</div>
		<div class="row baris-footer">
		</div>
	</div>
</body>
</html>
