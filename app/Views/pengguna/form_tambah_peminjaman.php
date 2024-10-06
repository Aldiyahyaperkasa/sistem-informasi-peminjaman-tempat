<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= base_url() ?>img/dispopar-logo.png" type="image/png">
    <title>Tambah Peminjaman</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.0/examples/sticky-footer/sticky-footer.css" rel="stylesheet">

    <style>
        .navbar {
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
                        <a class="nav-link active" href="<?= site_url('pengguna_data_peminjaman') ?>">Data Peminjaman</a>
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
        <div class="card">
            <div class="card-body">
                <form action="<?= site_url('pengguna_data_peminjaman/simpan') ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $fullname ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="ruangan_dipinjam" class="form-label">Ruangan Dipinjam</label>
                        <select class="form-control" id="ruangan_dipinjam" name="ruangan_dipinjam" required>
                            <?php foreach ($tempat as $item): ?>
                                <option value="<?= $item['id_ruangan'] ?>"><?= $item['nama_ruangan'] ?></option>
                            <?php endforeach; ?>
                            <?php foreach ($tempat_dipinjam as $item): ?>
                                <option value="<?= $item['id_ruangan'] ?>" disabled><?= $item['nama_ruangan'] ?> (sedang dipinjam)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status_pinjam" class="form-label">Status Peminjaman</label>
                        <input type="text" class="form-control" id="status_pinjam" name="status_pinjam" value="menunggu" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="pdf_file" class="form-label">Upload File PDF</label>
                        <input type="file" class="form-control" id="pdf_file" name="pdf_file" accept=".pdf" required>
                    </div>
                    <div class="mb-3">
                        <label for="waktu_peminjaman" class="form-label">Waktu Peminjaman</label>
                        <input type="datetime-local" class="form-control" id="waktu_peminjaman" name="waktu_peminjaman" required>
                    </div>
                    <div class="mb-3">
                        <label for="waktu_pengembalian" class="form-label">Waktu Pengembalian</label>
                        <input type="datetime-local" class="form-control" id="waktu_pengembalian" name="waktu_pengembalian" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
