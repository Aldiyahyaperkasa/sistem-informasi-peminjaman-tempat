<?= $this->extend('admin/layout'); ?>

<?= $this->section('judul'); ?>
Data Tempat
<?= $this->endSection(); ?>

<?= $this->section('subjudul'); ?>
Data Tempat
<?= $this->endSection(); ?>

<?= $this->section('isi'); ?>

<div class="d-flex justify-content-between">

    <!-- !-- ketika di klik akan mengarah ke controller jadwal, method formtambah --> 
    <button type="button" class="btn btn-success mb-4" onclick="location.href=('/admin_data_tempat/formtambah')">
        Tambah Tempat
    </button>
</div>

<?php if (session()->getFlashdata('sukses')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('sukses'); ?></div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
<?php endif; ?>

<table class="table table-striped table-bordered text-capitalize" style="width: 100%;">
    <thead>
        <tr class="text-center">
            <th style="width: 1%;">No</th>
            <th style="width: 10%;">ID Tempat</th>
            <th style="width: 10%;">Nama Tempat</th>
            <th style="width: 25%;">Gambar Tempat</th>
            <th style="width: 10%;">Status</th>
            <th style="width: 10%;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nomor = 1 + (20 * ($currentPage - 1));
        foreach ($tempat as $row):
        ?>
            <tr class="text-center" style="font-size:14px;">
                <td class="text-center"><?= $nomor++; ?></td>
                <td><?= $row['id_ruangan']; ?></td>
                <td><?= $row['nama_ruangan']; ?></td>
                <td>
                    <?php if ($row['gambar_ruangan']): ?>
                        <img src="<?= base_url('uploads/image/' . $row['gambar_ruangan']); ?>" alt="Gambar Ruangan" width="100">
                    <?php else: ?>
                        <span>Tidak ada gambar</span>
                    <?php endif; ?>
                </td>
                <td id="status-<?= $row['id_ruangan']; ?>"><?= $row['status']; ?></td>
                <td class="text-center">
                    <!-- Tombol Edit -->
                    <a href="/admin_data_tempat/formedit/<?= $row['id_ruangan']; ?>" class="btn btn-primary">
                        Edit
                    </a>

                    <!-- Tombol Hapus -->
                    <form method="POST" action="/admin_data_tempat/hapus/<?= $row['id_ruangan']; ?>" style="display: inline;" onsubmit="return hapus('<?= $row['id_ruangan']; ?>');">
                        <input type="hidden" name="id_ruangan" value="<?= $row['id_ruangan']; ?>">
                        <button type="submit" class="btn btn-danger">
                            Hapus
                        </button>
                    </form>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<script>
    function hapus(kode) {
        pesan = confirm('Data Ingin Dihapus ??');

        if (pesan) {
            return true;
        } else {
            return false;
        }
    }

</script>

<?= $this->endSection(); ?>
