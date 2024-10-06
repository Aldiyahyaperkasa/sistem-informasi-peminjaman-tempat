<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?= base_url() ?>img/dispopar-logo.png" type="image/png">
    <title>Register SIPT</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url('tambahan/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?= base_url('tambahan/css/login.css') ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="icon" href="<?= base_url('assets/img/form.png') ?>">
	<script src="<?= base_url('tambahan/js/jquery-3.3.1.min.js') ?>"></script>
	<script src="<?= base_url('tambahan/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('tambahan/js/login.js') ?>"></script>
</head>
<body>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-8 mt-5">
				<div class="login-form p-5">
					<img src="<?= base_url('img/pemkot-bontang.png') ?>">
					<h3 class="p-4">REGISTER</h3>
					<?= form_open('register/proses') ?>

                        <?php if(session()->getFlashdata('message')): ?>
						    <div class="alert alert-danger">
							    <?= session()->getFlashdata('message'); ?>
						    </div>
					    <?php endif; ?>
                        
						<div class="input-group mb-3">
							<div class="input-group-append">
								<div class="input-group-text">						
									<span class="fas fa-pen"></span>
								</div>
							</div>
							<input type="text" id="username" name="username" class="form-control" value="<?= set_value('username') ?>" placeholder="nama pengguna">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="far fa-user"></span>
								</div>
							</div>
							<input type="text" name="fullname" class="form-control" value="<?= set_value('fullname') ?>" placeholder="Nama Lengkap">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock"></span>
								</div>
							</div>
							<input type="password" name="password" class="form-control" placeholder="Password">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock"></span>
								</div>
							</div>
							<input type="password" name="confirm_password" class="form-control" placeholder="Konfirmasi Password">
						</div>
						<div class="row">
							<div class="col-12 text-center">
								<button type="submit" name="daftar" class="btn btn-success btn-block btn-flat">REGISTER</button>
							</div>
						</div>
					<?= form_close() ?>
				</div>
			</div>
		</div>
		<div class="row baris-footer">
		</div>
	</div>
</body>
</html>
    