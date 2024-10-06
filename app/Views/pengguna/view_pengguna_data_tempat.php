<?php

use App\Controllers\Main;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= base_url() ?>img/dispopar-logo.png" type="image/png">
    <title>SIPT - Akun Pengguna</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">

    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.0/examples/sticky-footer/sticky-footer.css" rel="stylesheet">

    <style>
        .navbar{
            background-color: white;
        }

        .nav-item:hover .nav-link {
            background-color: #0dcaf0;
            color: #fff; /* Ubah warna teks menjadi putih saat mouse di atasnya */
        }

        .card-body {
            background-color: white;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid mx-5 my-2 px-5">
            <div class="collapse navbar-collapse justify-content-start" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?= site_url('pengguna/index') ?>">Beranda</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?= site_url('pengguna_data_tempat') ?>">Data Tempat</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?= site_url('pengguna_data_peminjaman') ?>">Data Peminjaman</a>
                </li>
            </ul>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('login/logout') ?>">LOGOUT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
<div class="card-body m-5 p-5">
    <div class="row justify-content-center">
        <?php foreach ($tempat as $row): ?>
            <div class="col-md-5 d-flex flex-row bd-highlight mb-3 justify-content-center">
                <div class="card" style="width: 20rem;">
                    <div class="card-body bg-primary text-white">
                        <?php if ($row['gambar_ruangan']): ?>
                            <figure>
                                <img src="<?= base_url('uploads/image/' . $row['gambar_ruangan']); ?>" alt="Gambar Ruangan" width="100">
                                <figcaption><?= $row['nama_ruangan']; ?></figcaption>
                            </figure>
                        <?php else: ?>
                            <span>Tidak ada gambar</span>
                        <?php endif; ?>
                        <p align="start">Status : <?= $row['status']; ?></p>

                        <!-- Tampilkan Waktu Peminjaman dan Pengembalian -->
                        <?php foreach ($peminjaman as $pinjam): ?>
                            <?php if ($pinjam['ruangan_dipinjam'] == $row['id_ruangan']): ?>
                                <?php 
                                    $waktuPeminjaman = date('Y-m-d-s H:i:s', strtotime($pinjam['waktu_peminjaman']));
                                    $waktuPengembalian = date('Y-m-d H:i:s', strtotime($pinjam['waktu_pengembalian']));
                                ?>
                                <p align="start">Waktu Peminjaman: <?= $waktuPeminjaman ?></p>
                                <p align="start">Waktu Pengembalian: <?= $waktuPengembalian ?></p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>					
                </div>			
            </div>
        <?php endforeach; ?>
    </div>
</div>



</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>