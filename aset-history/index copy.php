<?php include("../layout/head.php") ?>
<?php include("../layout/sidebar.php") ?>
<?php include("../layout/navbar.php") ?>

<?php

if ($_SESSION['role_user'] !== 'SuperUser' && $_SESSION['role_user'] !== 'Administrator') {
  header("Location: javascript://history.go(-1)]");
}

$aset_history = mysqli_query($db, "SELECT * FROM aset_history ORDER BY id DESC")

?>

<!-- Content -->
<div class="content">
  <div class="breadcrumb">Aset History</div>

  <div class="content-inner">
    <!-- Tabel -->
    <div class="responsive-table">
      <table>
        <thead>
          <tr>
            <th class="center">No</th>
            <th>Nama Aset</th>
            <th>Lokasi</th>
            <th>Waktu</th>
            <th>Status</th>
            <th>Oleh</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (mysqli_fetch_array($aset_history)) {
            $no = 1;
            foreach ($aset_history as $d) { ?>
              <tr>
                <td class="center"><?= $no++ ?></td>
                <td><?= $d['nama_aset'] ?></td>
                <td><?= $d['lokasi'] ?></td>
                <td><?= $d['waktu'] ?></td>
                <td><?= $d['status'] ?></td>
                <td><?= $d['oleh'] ?></td>
              </tr>
            <?php }
          } else { ?>
            <tr>
              <td class="center" colspan="6">
                <p>Tidak ada history aset.</p>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include("../layout/footer.php") ?>