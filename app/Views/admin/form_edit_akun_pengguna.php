<?= $this->extend('admin/layout'); ?>

<?= $this->section('judul'); ?>
Edit Akun
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
Form Edit Akun 
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>

<?= form_open('/akunPengguna/updatedata', '', ['id' => $id]) ?>

<div class="form-group">
    <label for="username">Username</label>
    <?= form_input('username', $username, ['class' => 'form-control', 'id' => 'username', 'autofocus' => true]); ?>
</div>

<div class="form-group">
    <label for="fullname">Fullname</label>
    <?= form_input('fullname', $fullname, ['class' => 'form-control', 'id' => 'fullname']); ?>
</div>

<div class="form-group">
    <label for="password">Password</label>
    <?= form_input('password', '', ['class' => 'form-control', 'id' => 'password']); ?>
</div>

<div class="form-group">
    <label for="level">Level Pengguna</label>
    <select name="level" id="level" class="form-control">
        <option value="Pengguna Ruangan" <?= ($level == 'Pengguna Ruangan') ? 'selected' : ''; ?>>Pengguna Ruangan</option>
        <option value="Bagian Umum" <?= ($level == 'Bagian Umum') ? 'selected' : ''; ?>>Bagian Umum</option>
    </select>
</div>

<div class="form-group">
    <button type="button" class="btn btn-danger m-1" onclick="location.href=('/akunPengguna/index')">Kembali</button>
    <?= form_submit('', 'Update', ['class' => 'btn btn-success']); ?>
</div>

<?= form_close(); ?>

<?= $this->endSection('isi'); ?>
