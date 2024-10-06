<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= base_url('img/dispopar-logo.png') ?>" type="image/png">
    <title>SIPT - Akun Pengguna</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css') ?>">
    <style>
        .navbar {
            background-color: white;
        }
        .nav-item:hover .nav-link {
            background-color: #0dcaf0;
            color: #fff;
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
    <div class="container-fluid p-5">
        <div class="d-flex justify-content-between pb-3">
            <?php if ($show_tambah): ?>
                <a href="<?= site_url('pengguna_data_peminjaman/tambah') ?>" class="btn btn-primary">Tambah</a>
            <?php endif; ?>
        </div>

        <div class="card" style="font-size: 14px;">
            <div class="card-body">
                <?php if (session()->get('message')): ?>
                    <div class="alert alert-success"><?= session()->get('message') ?></div>
                <?php endif; ?>
                <?php if (session()->get('error')): ?>
                    <div class="alert alert-danger"><?= session()->get('error') ?></div>
                <?php endif; ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Peminjaman</th>
                            <th>Peminjam</th>
                            <th>Ruangan Dipinjam</th>
                            <th>Keterangan</th>
                            <th>Status Peminjaman</th>
                            <th>Waktu Peminjaman</th>
                            <th>Waktu Pengembalian</th>
                            <th>PDF File</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($peminjaman as $p): ?>
                            <tr>
                                <td><?= $p['id_peminjaman'] ?></td>
                                <td><?= $p['peminjam'] ?></td>
                                <td><?= $p['ruangan_dipinjam'] ?></td>
                                <td><?= $p['keterangan'] ?></td>
                                <td>
                                    <?= $p['status_pinjam'] ?>
                                    <?php if ($p['status_pinjam'] == 'ditolak'): ?>
                                        <br>
                                        <a href="#" data-toggle="modal" data-target="#alasanModal<?= $p['id_peminjaman']; ?>">Lihat Alasan Penolakan</a>
                                    <?php endif; ?>
                                </td>
                                <td><?= $p['waktu_peminjaman'] ?></td>
                                <td><?= $p['waktu_pengembalian'] ?></td>
                                <td>
                                    <a href="<?= base_url('uploads/' . $p['pdf_file']) ?>" target="_blank">Lihat disini</a>
                                </td>
                                <td>
                                    <?php if ($p['status_pinjam'] != 'selesai'): ?>
                                        <a href="<?= site_url('pengguna_data_peminjaman/edit/' . $p['id_peminjaman']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="<?= site_url('pengguna_data_peminjaman/delete/' . $p['id_peminjaman']) ?>" method="post" style="display:inline;">
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?')">Delete</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <!-- Modal to display rejection reason -->
                            <div class="modal fade" id="alasanModal<?= $p['id_peminjaman']; ?>" tabindex="-1" role="dialog" aria-labelledby="alasanModalLabel<?= $p['id_peminjaman']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="alasanModalLabel<?= $p['id_peminjaman']; ?>">Alasan Penolakan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><?= $p['alasan_penolakan']; ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
</body>
</html>
