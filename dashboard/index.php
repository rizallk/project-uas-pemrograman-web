<?php include("../layout/head.php") ?>
<?php include("../layout/sidebar.php") ?>
<?php include("../layout/navbar.php") ?>

<?php

$aset_lab = mysqli_num_rows(mysqli_query($db, "SELECT * FROM aset_lab"));
$aset_kantor = mysqli_num_rows(mysqli_query($db, "SELECT * FROM aset_kantor"));
$aset_kelas = mysqli_num_rows(mysqli_query($db, "SELECT * FROM aset_kelas"));
$aset_auditorium = mysqli_num_rows(mysqli_query($db, "SELECT * FROM aset_auditorium"));
$aset_history = mysqli_query($db, "SELECT * FROM aset_history ORDER BY id DESC LIMIT 3");

?>

<div class="content">
  <div class="breadcrumb">Dashboard</div>
  <!-- Cards -->
  <div class="cards">
    <div class="card">
      <div class="head">Aset Lab</div>
      <div class="body">
        <div class="left">
          <?= $aset_lab ?>
        </div>
        <div class="right">
          <svg viewBox="0 0 16 16" class="bi bi-box-seam aset-card-1-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
          </svg>
        </div>
      </div>
      <div class="footer">
        <div class="left">Total seluruh aset</div>
        <div class="right">
          <a href="../aset-lab/" class="btn-sm btn-info">Lihat</a>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="head">Aset Kantor</div>
      <div class="body">
        <div class="left">
          <?= $aset_kantor ?>
        </div>
        <div class="right">
          <svg viewBox="0 0 16 16" class="bi bi-box-seam aset-card-2-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
          </svg>
        </div>
      </div>
      <div class="footer">
        <div class="left">Total seluruh aset</div>
        <div class="right">
          <a href="../aset-kantor/" class="btn-sm btn-info">Lihat</a>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="head">Aset Kelas</div>
      <div class="body">
        <div class="left">
          <?= $aset_kelas ?>
        </div>
        <div class="right">
          <svg viewBox="0 0 16 16" class="bi bi-box-seam aset-card-3-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
          </svg>
        </div>
      </div>
      <div class="footer">
        <div class="left">Total seluruh aset</div>
        <div class="right">
          <a href="../aset-kelas/" class="btn-sm btn-info">Lihat</a>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="head">Aset Auditorium</div>
      <div class="body">
        <div class="left">
          <?= $aset_auditorium ?>
        </div>
        <div class="right">
          <svg viewBox="0 0 16 16" class="bi bi-box-seam aset-card-4-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
          </svg>
        </div>
      </div>
      <div class="footer">
        <div class="left">Total seluruh aset</div>
        <div class="right">
          <a href="../aset-auditorium/" class="btn-sm btn-info">Lihat</a>
        </div>
      </div>
    </div>
  </div>
  <hr class="hr-1" />
  <!-- Welcome Message -->
  <div class="welcome-message">
    <p>Selamat Datang di halaman Dashboard!</p>
    <p>
      Halo, <span><?= $user['nama'] ?></span>! Kamu berhasil memasuki halaman utama.
      Kamu sedang berada di tampilan halaman Dashboard Aplikasi
      Inventaris.
    </p>
    <hr />
    <p>Enjoy dengan tampilan ini! :)</p>
  </div>
  <!-- Note & Data terkini -->
  <?php if ($user['role'] === 'SuperUser' || $user['role'] === 'Administrator') { ?>
    <hr class="hr-2" />
    <div class="content-footer">
      <div class="note-wrapper">
        <div class="title">Catatan</div>
        <form action="update_note.php" method="post">
          <textarea name="catatan" class="note" placeholder="Isikan text apa saja :)"><?= $user['catatan'] ?></textarea>
          <button name="update-catatan" type="submit" class="btn-sm btn-success">
            Update Note
          </button>
        </form>
      </div>
      <div class="recent-data">
        <div class="title">Recent Data</div>
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
                foreach ($aset_history as $d) {
              ?>
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
        <a href="../aset-history/"><button class="btn-sm btn-info">
            Selengkapnya
          </button></a>
      </div>
    </div>
  <?php } ?>
</div>

<?php include("../layout/footer.php") ?>