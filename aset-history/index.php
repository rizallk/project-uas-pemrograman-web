<?php include("../layout/head.php") ?>
<?php include("../layout/sidebar.php") ?>
<?php include("../layout/navbar.php") ?>

<?php

if ($_SESSION['role_user'] !== 'SuperUser' && $_SESSION['role_user'] !== 'Administrator') {
  header("Location: javascript://history.go(-1)]");
}

?>

<!-- Content -->
<div class="content">
  <div class="breadcrumb">Aset History</div>

  <div class="content-inner">
    <!-- Tabel -->
    <form action="index.php" method="get">
      <div class="search-wrapper">
        <div class="search-content">
          <input name="nama-aset" type="text" placeholder="Cari nama aset ...">
          <button class="btn btn-success" type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
          </button>
        </div>
      </div>
    </form>
    <?php if (isset($_GET['nama-aset'])) {
    ?>
      <p class="search-info">Hasil pencarian yang mirip dengan <b><?= $_GET['nama-aset'] ?></b></p>
    <?php } ?>
    <!-- Tabel -->
    <div class="responsive-table">
      <table class="asset-table">
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
          $cek = mysqli_query($db, "SELECT * FROM aset_history");

          if (mysqli_fetch_array($cek)) {
            if (isset($_GET['nama-aset'])) {
              $nama_aset = $_GET['nama-aset'];
              $data_search = mysqli_query($db, "SELECT * FROM aset_history WHERE nama_aset LIKE '%$nama_aset%'");

              $no = 1;

              if (mysqli_num_rows($data_search) > 0) {
                foreach ($data_search as $d) { ?>
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
                  <td class="center" colspan="7">
                    <p>History tidak ditemukan.</p>
                  </td>
                </tr>
              <?php
              }
            } else {
              $batas = 15;
              $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
              $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

              $previous = $halaman - 1;
              $next = $halaman + 1;

              $data = mysqli_query($db, "SELECT * FROM aset_history");
              $jumlah_data = mysqli_num_rows($data);
              $total_halaman = ceil($jumlah_data / $batas);

              $data_history = mysqli_query($db, "SELECT * FROM aset_history ORDER BY id DESC LIMIT $halaman_awal, $batas");
              $no = $halaman_awal + 1;
              foreach ($data_history as $d) { ?>
                <tr>
                  <td class="center"><?= $no++ ?></td>
                  <td><?= $d['nama_aset'] ?></td>
                  <td><?= $d['lokasi'] ?></td>
                  <td><?= $d['waktu'] ?></td>
                  <td><?= $d['status'] ?></td>
                  <td><?= $d['oleh'] ?></td>
                </tr>
            <?php }
            }
          } else { ?>
            <tr>
              <td class="center" colspan="7">
                <p>Tidak ada history aset.</p>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php if (!isset($_GET['nama-aset'])) {
    if (mysqli_fetch_array($cek)) {
      if ($jumlah_data > 10) {
  ?>
        <div class="pagination">
          <a class="page-item" <?php if ($halaman > 1) {
                                  echo "href='?halaman=$previous'";
                                } ?>>Previous</a>
          <?php
          for ($x = 1; $x <= $total_halaman; $x++) {
          ?>
            <a class="page-item" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a>
          <?php
          }
          ?>
          <a class="page-item" <?php if ($halaman < $total_halaman) {
                                  echo "href='?halaman=$next'";
                                } ?>>Next</a>
        </div>
  <?php }
    }
  } ?>
</div>

<?php include("../layout/footer.php") ?>