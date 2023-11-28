<div class="page-header">
    <h1>Perhitungan</h1>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Hasil Analisa</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <?php
                    $data = get_rel_alternatif();
                    foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $val->nama_kriteria ?></th>
                    <?php endforeach ?>
            </thead>
            <?php
            $no = 1;
            foreach ($data as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $ALTERNATIF[$key] ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= $SAW_crips[$v]->keterangan ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Nilai Fuzzy</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Kode</th>
                    <?php
                    $rel_alternatif = get_rel_alternatif();
                    foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach ?>
            </thead>
            <?php
            $no = 1;
            foreach ($rel_alternatif as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= $SAW_crips[$v]->nilai_l ?>, <?= $SAW_crips[$v]->nilai_m ?>, <?= $SAW_crips[$v]->nilai_u ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Normalisasi</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Kode</th>
                    <?php
                    $normal = get_normal($rel_alternatif);
                    foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach ?>
            </thead>
            <?php
            $no = 1;
            foreach ($normal as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= round($v['l'], 4) ?>, <?= round($v['m'], 4) ?>, <?= round($v['u'], 4) ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Terbobot</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Kode</th>
                    <?php
                    $terbobot = get_terbobot($normal);
                    foreach ($KRITERIA as $key => $val) : ?>
                        <th><?= $key ?></th>
                    <?php endforeach ?>
            </thead>
            <?php
            $no = 1;
            foreach ($terbobot as $key => $val) : ?>
                <tr>
                    <td><?= $key ?></td>
                    <?php foreach ($val as $k => $v) : ?>
                        <td><?= round($v['l'], 4) ?>, <?= round($v['m'], 4) ?>, <?= round($v['u'], 4) ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Rata-Rata</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center">Kode</th>
                    <?php
                    $rata = get_rata($terbobot);
                    foreach ($KRITERIA as $key => $val) : ?>
                        <th class="text-center"><?= $key ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($rata as $key => $val) : ?>
                    <tr>
                        <td class="text-center"><?= $key ?></td>
                        <?php foreach ($val as $k => $v) : ?>
                            <td class="text-center"><?= round($v, 4) ?></td>
                        <?php endforeach ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Perangkingan</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center">Rank</th>
                    <th class="text-center">Kode</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Total</th>
                    <!-- Hasil -->
                    <th class="text-center">Hasil</th>
                </tr>
            </thead>
            <?php
            $total = get_total($rata);
            $rank = get_rank($total);
            $sum = array_sum($total);
            foreach ($rank as $key => $val) :
                $db->query("UPDATE tb_alternatif SET total='$total[$key]', rank='$val' WHERE kode_alternatif='$key'");
            ?>
                <tr>
                    <td class="text-center"><?= $val ?></td>
                    <td class="text-center"><?= $key ?></td>
                    <td class="text-center"><?= $ALTERNATIF[$key] ?></td>
                    <td class="text-center"><?= round($total[$key], 4) ?></td>
                    <!-- Hasil -->
                    <td class="text-center">
                        <?php if ($total[$key] >= 0.8 && $total[$key] <= 1) : ?>
                            Rekomendasi
                        <?php else : ?>
                            Tidak Direkomendasikan
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
    <div class="panel-footer">
        <a class="btn btn-default" target="_blank" href="cetak.php?m=hitung"><span class="glyphicon glyphicon-print"></span> Cetak</a>
    </div>
</div>



