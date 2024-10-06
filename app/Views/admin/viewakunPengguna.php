<?= $this->extend('admin/layout'); ?>

<?= $this->section('judul'); ?>
<?= $this->endSection('judul'); ?>

<?= $this->section('subjudul'); ?>
KELOLA AKUN
<?= $this->endSection('subjudul'); ?>

<?= $this->section('isi'); ?>
<section class="d-flex justify-content-between align-items-center mb-2">
    <form method="get" action="/akunPengguna">
        <div class="form-group">
            <label for="level">Filter berdasarkan Level:</label>
            <select name="level" id="level" class="form-control" onchange="this.form.submit()">
                <option value="">--Pilih Level--</option>
                <option value="bagian umum" <?= $selectedLevel == 'bagian umum' ? 'selected' : '' ?>>Bagian Umum</option>
                <option value="pengguna ruangan" <?= $selectedLevel == 'pengguna ruangan' ? 'selected' : '' ?>>Pengguna Ruangan</option>
            </select>
        </div>
    </form>
    
    <div class="">
        <button type="button" class="btn btn-success text-end" onclick="location.href=('/akunPengguna/formtambah')">
            Tambah Data 
        </button>
    </div>
</section>


<?php if (session()->getFlashdata('sukses')): ?>
    <?= session()->getFlashdata('sukses'); ?>
<?php endif; ?>


<table class="table table-striped table-bordered text-capitalize" style="width: 100%;">
    <tr>
        <th>No.</th>
        <th>Username</th>        
        <th>Nama Lengkap</th>
        <th>Level</th>
        <th>Password</th>
        <th style="width: 15%;">Aksi</th>
    </tr>
    
    <tbody>
        <?php
        $nomor = 1;
        foreach ($tampildata as $row) :
        ?>

            <tr>
                <td><?= $nomor++; ?></td>
                <td><?= $row->username; ?></td>
                <td><?= $row->fullname; ?></td>
                <td><?= $row->level; ?></td>
                <td><?= $row->password; ?></td>

                <td>
                    <a href="/akunPengguna/formedit/<?= $row->username; ?>" class="btn btn-primary">
                        <i>Edit</i>
                    </a>

                    <form method="POST" action="/akunPengguna/hapus/<?= $row->username; ?>" style="display: inline;" onsubmit="return hapus();">
                        <input type="hidden" value="Hapus" name="_method">
                        <button type="submit" class="btn btn-danger">
                            <i>Hapus</i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    function edit(id) {
        window.location = ('/admin/form_edit_akun_pengguna/' + id);
    }
    
    function hapus () {
        pesan = confirm('yakin data ingin dihapus ?');
        
        if (pesan) {
            return true;
        } else {
            return false;
        }
    }
</script>

<?= $this->endSection('isi'); ?>
