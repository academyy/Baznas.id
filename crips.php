<div class="page-header">
    <h1>Nilai Crips</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="crips" />
            <div class="form-group">
                <input class="form-control" type="text" name="q" value="<?= $_GET['q'] ?>" placeholder="Pencarian...">
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=crips_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kriteria</th>
                    <th>Keterangan</th>
                    <th>L</th>
                    <th>M</th>
                    <th>U</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <?php
            $q = esc_field($_GET['q']);
            $rows = $db->get_results("SELECT * FROM tb_crips c INNER JOIN tb_kriteria k ON k.kode_kriteria=c.kode_kriteria WHERE k.nama_kriteria LIKE '%$q%' OR c.keterangan LIKE '%$q%' ORDER BY k.kode_kriteria, nilai_l, nilai_m, nilai_u");
            $no = 1;
            foreach ($rows as $row) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row->nama_kriteria ?></td>
                    <td><?= $row->keterangan ?></td>
                    <td><?= $row->nilai_l ?></td>
                    <td><?= $row->nilai_m ?></td>
                    <td><?= $row->nilai_u ?></td>
                    <td>
                        <a class="btn btn-xs btn-warning" href="?m=crips_ubah&ID=<?= $row->kode_crips ?>"><span class="glyphicon glyphicon-edit"></span></a>
                        <a class="btn btn-xs btn-danger" href="aksi.php?act=crips_hapus&ID=<?= $row->kode_crips ?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>