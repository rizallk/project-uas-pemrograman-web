<?php include("../layout/head.php") ?>
<?php include("../layout/sidebar.php") ?>
<?php include("../layout/navbar.php") ?>

<?php

if ($_SESSION['role_user'] !== 'SuperUser' && $_SESSION['role_user'] !== 'Administrator') {
  header("Location: javascript://history.go(-1)]");
}

?>

<div class="content">
  <div id="detail-aset" class="breadcrumb">Tambah Aset</div>
  <form action="add.php" method="post" enctype="multipart/form-data">
    <div class="content-inner">
      <?php
      flash('insert_error');
      flash('insert_success');
      ?>
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label>Nama Aset</label>
            <input name="nama_aset" type="text" placeholder="Masukkan Nama Aset" required />
          </div>
          <div class="form-group">
            <label>Kuantitas</label>
            <input name="kuantitas" type="number" placeholder="Masukkan Kuantitas" required />
          </div>
          <div class="form-group">
            <label>Harga per-Barang</label>
            <input name="harga" type="number" placeholder="Masukkan Harga" />
          </div>
          <div class="form-group">
            <label>Tanggal Pembelian</label>
            <input name="tgl_pembelian" type="date" />
          </div>
          <div class="form-group">
            <label>Foto / Gambar Aset</label>
            <input name="foto" type="file" id="file" />
            <div class="info show">Foto / Gambar harus berekstensi JPG atau PNG, dengan ukuran file maks. 2MB.</div>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label>Nama Pemeriksa</label>
            <input name="nama_pemeriksa" type="text" placeholder="Masukkan Nama Pemeriksa" />
          </div>
          <div class="form-group">
            <label>Tanggal Diperiksa</label>
            <input name="tgl_diperiksa" type="date" />
          </div>
          <div class="form-group">
            <label>Alokasi Penempatan</label>
            <select name="lokasi">
              <option value="Lab">Laboratorium</option>
              <option value="Kantor">Kantor</option>
              <option value="Kelas">Kelas</option>
              <option value="Auditorium">Auditorium</option>
            </select>
          </div>
          <div class="form-group">
            <label>Catatan</label>
            <textarea name="catatan" placeholder="Masukkan Catatan (optional)"></textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="btn-wrapper">
      <button name="add-aset" type="submit" class="btn btn-success">
        Tambah
      </button>
    </div>
  </form>
</div>

<?php include("../layout/footer.php") ?>