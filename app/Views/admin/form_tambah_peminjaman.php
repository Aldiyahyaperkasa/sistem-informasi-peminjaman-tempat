<?= $this->extend('admin/layout'); ?>


<?= $this->section('judul'); ?>

<?= $this->endSection('judul'); ?>


<?= $this->section('subjudul'); ?>
Tambah Data Peminjaman
<?= $this->endSection('subjudul'); ?>


<?= $this->section('isi'); ?>
<?= form_open('/admin_data_peminjaman/simpandata') ?>

<div class="row mb-3 justify-content-center">
    <label for="" class="col-sm-2 col-form-label">ID Peminjaman</label>
    <div class="col-sm-4">
            <input type="text" class="form-control" id="id_peminjaman" name="id_peminjaman">
        </div>
        <label for="" class="col-sm-2 col-form-label">Nama Peminjam</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="peminjam" name="peminjam">
        </div>
    </div>
    
    <div class="row mb-3 justify-content-center">
        <label for="" class="col-sm-2 col-form-label">Tempat dipinjam</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="ruangan_dipinjam" name="ruangan_dipinjam">
        </div>
        <label for="" class="col-sm-2 col-form-label">Keterangan</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="keterangan" name="keterangan">
        </div>
    </div>
    
    <div class="row mb-3 justify-content-start">
        <label for="" class="col-sm-2 col-form-label">Status Pinjam</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="status_pinjam" name="status_pinjam">
        </div>
        <label for="file_pdf" class="col-sm-2 col-form-label">Upload File PDF</label>
        <div class="col-sm-4">
            <input type="file" class="form-control" id="file_pdf" name="file_pdf" accept=".pdf">
        </div>
    </div>


    <div class="form-group">
        <button type="button" class="btn btn-danger" onclick="location.href=('/admin_data_peminjaman/index')">
            Kembali
        </button>
        <?= form_submit('', 'simpan', [
            'class' => 'btn btn-success'
        ]); ?>
    </div>
</div>

    <style>
        textarea:hover {
            border-color: rgb(118, 118, 118);
        }
    </style>

<?= form_close(); ?>

<?= $this->endSection('isi'); ?>