<style>
    table {
        margin-left: auto;
        margin-right: auto;
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
    }

    .tanggal {
        text-align: right;
        margin-top: 130px;
    }

    h1 {
        font-size: 28px;
        text-align: center;
    }

    h2 {
        font-size: 18px;
        margin-bottom: 10px;
        text-align: center;
    }
    .kepala-baznas {
        text-align: center;
        margin-top: 210px; /* Menggeser tulisan ke bawah sejauh 6cm (1cm = 10px) */
        font-weight: bold;
        font-size: 16px; /* Mengatur ukuran tulisan "Kepala Baznas" menjadi 24px */
    }
    
    .tanda-tangan {
        text-align: right;
        margin-top: 200px; /* Menggeser garis tanda tangan ke bawah sejauh 6cm (1cm = 10px) */
    }
    
    .tanda-tangan::before {
        content: "";
        display: block;
        width: 150px; /* Lebar tempat tanda tangan */
        height: 1px;
        border-top: 1px solid #000;
        margin-bottom: 5px;
        margin-left: auto; /* Mengatur agar garis tanda tangan berada di tengah sejajar dengan tulisan "Kepala Baznas Kota Padang" */
        margin-right: auto; /* Mengatur agar garis tanda tangan berada di tengah sejajar dengan tulisan "Kepala Baznas Kota Padang" */
    }

    .penjelasan {
        text-align: justify;
        margin-bottom: 20px;
    }
</style>
<h1>Hasil Laporan Penerima Beasiswa Baznas</h1>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Alternatif</th>
            <th>Keterangan</th>
            <th>Total</th>
            <th>Hasil</th>
        </tr>
    </thead>
    <?php
    $q = esc_field($_GET['q']);
    $rows = $db->get_results("SELECT * FROM tb_alternatif 
        WHERE 
            kode_alternatif LIKE '%$q%'
            OR nama_alternatif LIKE '%$q%'
            OR keterangan LIKE '%$q%'  
        ORDER BY rank");
    $no = 0;
    foreach ($rows as $row) : ?>
        <tr>
            <td><?= ++$no ?></td>
            <td><?= $row->kode_alternatif ?></td>
            <td style="text-align: left;"><?= $row->nama_alternatif ?></td> <!-- Menetapkan penulisan "align left" pada kolom "Nama Alternatif" -->
            <td><?= $row->keterangan ?></td>
            <td style="text-align: center;"><?= round($row->total, 4) ?></td>
            <td style="text-align: center;">
                <?php if ($row->total >= 0.8 && $row->total <= 1) : ?>
                    Rekomendasi
                <?php else : ?>
                    Tidak Direkomendasikan
                <?php endif ?>
            </td>
        </tr>
    <?php endforeach ?>
</table>

<?php if ($rows) : ?>
    <div class="penjelasan">
        Penerima Beasiswa Baznas Kota Padang adalah mereka yang telah memenuhi 
        syarat dan kriteria yang ditetapkan oleh Baznas Kota Padang. Beasiswa 
        ini diberikan sebagai dukungan untuk pendidikan dan pengembangan potensi mereka. 
        Dengan adanya beasiswa ini, diharapkan penerima dapat meraih prestasi dan 
        berkontribusi dalam pembangunan Kota Padang.
    </div>
    <p class="tanggal">
        Padang, <?php echo date('d F Y'); ?>
        <div class="kepala-baznas">Kepala Baznas</div>
        <div class="tanda-tangan"></div>
    </p>
<?php endif ?>
