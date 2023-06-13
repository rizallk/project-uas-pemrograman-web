<?php

include("../database/koneksi.php");
include('../session/session.php');
include("../function/format_rp.php");
include("config.php");

$data = mysqli_query($db, "SELECT * FROM $table_name ORDER BY id DESC")

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Aplikasi Inventaris</title>

  <!-- Style CSS -->
  <link rel="stylesheet" href="../assets/css/main.css" />
</head>

<body>
  <div class="cetak-wrapper">
    <div class="title">
      <h1>Laporan <?= $breadcrumb ?></h1>
    </div>
    <table class="asset-table" style="white-space: normal;">
      <thead>
        <tr>
          <th class="center">No</th>
          <th>Nama Aset</th>
          <th class="center">Qty</th>
          <th>Foto / Gambar</th>
          <th>Harga per-Barang</th>
          <th>Tanggal Pembelian</th>
          <th>Nama Pemeriksa</th>
          <th>Tanggal Diperiksa</th>
          <th>Catatan</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($data as $d) {
        ?>
          <tr>
            <td class="center"><?= $no++ ?></td>
            <td><?= $d['nama_aset'] ?></td>
            <td class="center"><?= $d['kuantitas'] ?></td>
            <td class="img"><img class="img-responsive" src="../assets/images/<?= $folder_name ?>/<?= $d['foto'] ?>" alt="<?= $d['foto'] ?>"></td>
            <td style="white-space: nowrap;"><?= format_rp($d['harga']) ?></td>
            <td><?= $d['tgl_pembelian'] === '0000-00-00' ? '' : $d['tgl_pembelian'] ?></td>
            <td><?= $d['nama_pemeriksa'] ?></td>
            <td style="white-space: nowrap;"><?= $d['tgl_diperiksa'] === '0000-00-00' ? '' : $d['tgl_diperiksa'] ?></td>
            <td><?= $d['catatan'] ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <div id="waktu"></div>
  </div>

  <!-- Script JS -->
  <script src=" ../assets/js/script.js">
  </script>
</body>

</html>