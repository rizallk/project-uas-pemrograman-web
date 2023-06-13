<?php include("../layout/head.php") ?>
<?php include("../layout/sidebar.php") ?>
<?php include("../layout/navbar.php") ?>
<?php include("../function/format_rp.php") ?>
<?php include("config.php") ?>

<div class="content">
  <div class="breadcrumb"><?= $breadcrumb ?></div>
  <div class="content-inner">
    <?php
    flash('index_error');
    flash('index_success');
    ?>
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
            <th class="center">Qty</th>
            <th>Foto / Gambar</th>
            <th>Harga per-Barang</th>
            <th>Nama Pemeriksa</th>
            <th class="center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $cek = mysqli_query($db, "SELECT * FROM $table_name");

          if (mysqli_fetch_array($cek)) {
            if (isset($_GET['nama-aset'])) {
              $nama_aset = $_GET['nama-aset'];
              $data_search = mysqli_query($db, "SELECT * FROM $table_name WHERE nama_aset LIKE '%$nama_aset%'");

              $no = 1;

              if (mysqli_num_rows($data_search) > 0) {
                foreach ($data_search as $data) { ?>
                  <tr>
                    <td class="center"><?= $no++ ?></td>
                    <td><?= $data['nama_aset'] ?></td>
                    <td class="center"><?= $data['kuantitas'] ?></td>
                    <td class="img"><img src="../assets/images/<?= $folder_name ?>/<?= $data['foto'] ?>" alt="<?= $data['foto'] ?>"></td>
                    <td><?= format_rp($data['harga']) ?></td>
                    <td><?= $data['nama_pemeriksa'] ?></td>
                    <td>
                      <div class="td-action">
                        <a class="btn btn-info btn-action" href="detail.php?id=<?= $data['id'] ?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                            <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                          </svg>
                        </a>
                        <?php
                        if ($_SESSION['role_user'] === 'SuperUser' || $_SESSION['role_user'] === 'Administrator') {
                        ?>
                          <a class="btn btn-warning btn-action" href="edit.php?id=<?= $data['id'] ?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                          </a>
                          <form id="del-form" action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                            <button name="delete" id="delete" class="btn btn-danger btn-action"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                              </svg>
                            </button>
                          </form>
                        <?php } ?>
                      </div>
                    </td>
                    </td>
                  </tr>
                <?php }
              } else { ?>
                <tr>
                  <td class="center" colspan="7">
                    <p>Aset tidak ditemukan.</p>
                  </td>
                </tr>
              <?php
              }
            } else {
              $batas = 10;
              $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
              $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

              $previous = $halaman - 1;
              $next = $halaman + 1;

              $data = mysqli_query($db, "SELECT * FROM $table_name");
              $jumlah_data = mysqli_num_rows($data);
              $total_halaman = ceil($jumlah_data / $batas);

              $data_aset = mysqli_query($db, "SELECT * FROM $table_name ORDER BY id DESC LIMIT $halaman_awal, $batas");
              $no = $halaman_awal + 1;
              foreach ($data_aset as $data) { ?>
                <tr>
                  <td class="center"><?= $no++ ?></td>
                  <td><?= $data['nama_aset'] ?></td>
                  <td class="center"><?= $data['kuantitas'] ?></td>
                  <td class="img"><img src="../assets/images/<?= $folder_name ?>/<?= $data['foto'] ?>" alt="<?= $data['foto'] ?>"></td>
                  <td><?= format_rp($data['harga']) ?></td>
                  <td><?= $data['nama_pemeriksa'] ?></td>
                  <td>
                    <div class="td-action">
                      <a class="btn btn-info btn-action" href="detail.php?id=<?= $data['id'] ?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                          <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                        </svg>
                      </a>
                      <?php
                      if ($_SESSION['role_user'] === 'SuperUser' || $_SESSION['role_user'] === 'Administrator') {
                      ?>
                        <a class="btn btn-warning btn-action" href="edit.php?id=<?= $data['id'] ?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                          </svg>
                        </a>
                        <form id="del-form" action="delete.php" method="post">
                          <input type="hidden" name="id" value="<?= $data['id'] ?>">
                          <button name="delete" id="delete" class="btn btn-danger btn-action"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                            </svg>
                          </button>
                        </form>
                      <?php } ?>
                    </div>
                  </td>
                  </td>
                </tr>
            <?php }
            }
          } else { ?>
            <tr>
              <td class="center" colspan="7">
                <p>Tidak ada aset.</p>
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
    ?>
    <div class="btn-wrapper">
      <a href="cetak.php" target="_blank" class="btn btn-info btn-cetak">
        Cetak
      </a>
    </div>
  <?php } ?>
</div>

<?php include("../layout/footer.php") ?>