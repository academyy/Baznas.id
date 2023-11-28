<div class="page-header">
    <h1>Tambah Crips</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if ($_POST) include 'aksi.php' ?>
        <form method="post">
            <div class="form-group">
                <label>Kriteria <span class="text-danger">*</span></label>
                <select class="form-control" name="kode_kriteria"><?= get_kriteria_option(set_value('kode_kriteria')) ?></select>
            </div>
            <div class="form-group">
                <label>Nama <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="keterangan" value="<?= set_value('keterangan') ?>" />
            </div>
            <div class="form-group">
                <label>Nilai L <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nilai_l" value="<?= set_value('nilai_l') ?>" />
            </div>
            <div class="form-group">
                <label>Nilai M <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nilai_m" value="<?= set_value('nilai_m') ?>" />
            </div>
            <div class="form-group">
                <label>Nilai U <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nilai_u" value="<?= set_value('nilai_u') ?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=crips&kode_kriteria"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>