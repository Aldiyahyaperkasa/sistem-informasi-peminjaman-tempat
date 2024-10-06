<?= $this->extend('admin/layout'); ?>

<?= $this->section('judul'); ?>
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
Data Peminjaman
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>

<?php if (session()->getFlashdata('sukses')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('sukses'); ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
<?php endif; ?>

<table class="table table-striped table-bordered text-capitalize" style="font-size: 12px;">
    <thead>
        <tr>
            <th>ID Peminjaman</th>
            <th>Peminjam</th>
            <th>Ruangan Dipinjam</th>
            <th>Keterangan</th>
            <th>PDF File</th>
            <th>Status Peminjaman</th>
            <th>Waktu Peminjaman</th>
            <th>Waktu Pengembalian</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($peminjaman as $p): ?>
            <tr>
                <td><?= $p['id_peminjaman']; ?></td>
                <td><?= $p['peminjam']; ?></td>
                <td><?= $p['nama_ruangan']; ?></td>
                <td><?= $p['keterangan']; ?></td>
                <td>
                    <a href="<?= base_url('uploads/' . $p['pdf_file']) ?>" target="_blank">
                        <i class="fa-solid fa-arrow-circle-right"></i> Lihat disini
                    </a>
                </td>
                <td>
                    <?php if ($p['status_pinjam'] == 'menunggu'): ?>
                        Menunggu
                    <?php elseif ($p['status_pinjam'] == 'disetujui'): ?>
                        Disetujui
                    <?php elseif ($p['status_pinjam'] == 'ditolak'): ?>
                        <span>Ditolak</span>
                        <br>
                        <a href="#" data-toggle="modal" data-target="#alasanModal<?= $p['id_peminjaman']; ?>">Lihat Alasan Penolakan</a>
                    <?php elseif ($p['status_pinjam'] == 'selesai'): ?>
                        Selesai
                    <?php endif; ?>
                </td>
                <td><?= $p['waktu_peminjaman']; ?></td>
                <td><?= $p['waktu_pengembalian']; ?></td>
                <td>
                    <?php if ($p['status_pinjam'] == 'menunggu'): ?>
                        <a href="<?= site_url('admin_data_peminjaman/acc/' . $p['id_peminjaman']); ?>" class="btn btn-success btn-sm mr-1">Setujui</a>
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#tolakModal<?= $p['id_peminjaman']; ?>">
                            Tolak
                        </button>

                        <!-- Modal for rejection reason input -->
                        <div class="modal fade" id="tolakModal<?= $p['id_peminjaman']; ?>" tabindex="-1" role="dialog" aria-labelledby="tolakModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="<?= site_url('admin_data_peminjaman/tolak/' . $p['id_peminjaman']); ?>" method="post">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tolakModalLabel">Alasan Penolakan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="alasan_penolakan">Masukkan Alasan Penolakan</label>
                                                <textarea class="form-control" id="alasan_penolakan" name="alasan_penolakan" rows="3" required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php elseif ($p['status_pinjam'] == 'disetujui'): ?>
                        <a href="<?= site_url('admin_data_peminjaman/selesai/' . $p['id_peminjaman']); ?>" class="btn btn-primary btn-sm">Selesai</a>
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

<?= $this->endSection('isi'); ?>
