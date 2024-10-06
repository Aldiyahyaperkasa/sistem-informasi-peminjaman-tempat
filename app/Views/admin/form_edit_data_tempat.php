<?= $this->extend('admin/layout'); ?>

<?= $this->section('judul'); ?>
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
Form Edit Data Tempat
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>

<?= form_open_multipart('/admin_data_tempat/updatedata') ?>
    
    <div class="form-group">
        <label for="id_ruangan">ID Tempat</label>
        <?= form_input('id_ruangan', $id_ruangan, [
            'class' => 'form-control',
            'id' => 'id_ruangan',
            'autofocus' => true,
            'readonly' => true // ID Tempat tidak boleh diubah
        ]); ?>
    </div>
    <div class="form-group">
        <label for="nama_ruangan">Nama Tempat</label>
        <?= form_input('nama_ruangan', $nama_ruangan, [
            'class' => 'form-control',
            'id' => 'nama_ruangan',
        ]); ?>
    </div>
    <div class="form-group">
        <label for="gambar_ruangan">Gambar Ruangan</label><br>
        <?php if ($gambar_ruangan): ?>
            <img src="<?= base_url('uploads/image/' . $gambar_ruangan); ?>" alt="Gambar Ruangan" width="100"><br><br>
        <?php endif; ?>
        <input type="file" name="gambar_ruangan" class="form-control-file" id="gambar_ruangan">
    </div>
  
    <div class="form-group">
        <button type="button" class="btn btn-danger m-1" onclick="location.href=('/admin_data_tempat/index')">
            Kembali
        </button>
        <?= form_submit('', 'Update', [
            'class' => 'btn btn-success'
        ]); ?>
    </div>

<?= form_close(); ?>

<?= $this->endSection('isi'); ?>
