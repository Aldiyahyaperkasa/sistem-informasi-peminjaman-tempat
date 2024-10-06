<?= $this->extend('admin/layout'); ?>


<?= $this->section('judul'); ?>

<?= $this->endSection('judul'); ?>


<?= $this->section('subjudul'); ?>
Tambah Data Tempat
<?= $this->endSection('subjudul'); ?>


<?= $this->section('isi'); ?>
<?= form_open_multipart('/admin_data_tempat/simpandata') ?>


<div class="m-4">

    <div class="row mb-3 justify-content-center">
        <label for="" class="col-sm-2 col-form-label">ID Tempat</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="id_ruangan" name="id_ruangan">
        </div>
    </div>
    <div class="row mb-3 justify-content-center">
        <label for="" class="col-sm-2 col-form-label">Nama Tempat</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan">
        </div>
    </div>
    <div class="row mb-3 justify-content-center">
        <label for="" class="col-sm-2 col-form-label">Gambar Tempat</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="gambar_ruangan" name="gambar_ruangan">
        </div>
    </div>
    
    
    <div class="form-group mt-4">
        <button type="button" class="btn btn-danger" onclick="location.href=('/admin_data_tempat/index')">
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