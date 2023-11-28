<div class="page-header">
    <h1>Nilai Bobot Alternatif</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="rel_alternatif" />
            <div class="form-group">
                <input class="form-control" type="text" name="q" value="<?= $_GET['q'] ?>" placeholder="Pencarian..." />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</button>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Alternatif</th>
                    <?php
                    $rows = $db->get_results("SELECT nama_kriteria FROM tb_kriteria");
                    foreach ($rows as $row) {
                        echo "<th>$row->nama_kriteria</th>";
                    }
                    ?>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $rows = $db->get_results("SELECT
                    	a.kode_alternatif, a.nama_alternatif, ra.kode_kriteria,	
                    	ra.kode_crips,
                        c.keterangan
                    FROM tb_rel_alternatif ra 
                    	INNER JOIN tb_alternatif a ON a.kode_alternatif = ra.kode_alternatif
                        INNER JOIN tb_kriteria k ON k.kode_kriteria=ra.kode_kriteria
                        LEFT JOIN tb_crips c ON c.kode_crips = ra.kode_crips
                    WHERE nama_alternatif LIKE '%" . esc_field($_GET['q']) . "%'
                    ORDER BY kode_alternatif, ra.kode_kriteria;");
                $data = array();
                foreach ($rows as $row) {
                    $data[$row->kode_alternatif][$row->kode_kriteria]  = $row;
                }

                $no = 0;

                foreach ($data as $key => $value) : ?>
                    <tr>
                        <td><?= $key ?></td>
                        <td><?= current($value)->nama_alternatif; ?></td>
                        <?php
                        foreach ($value as $dt) {
                            echo "<td>$dt->keterangan</td>";
                        }
                        ?>
                        <td>
                            <a class="btn btn-xs btn-warning" href="?m=rel_alternatif_ubah&ID=<?= $key ?>"><span class="glyphicon glyphicon-edit"></span> Ubah</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>