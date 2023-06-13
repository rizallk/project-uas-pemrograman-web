<?php include("../layout/head.php") ?>
<?php include("../layout/sidebar.php") ?>
<?php include("../layout/navbar.php") ?>
<?php include("config.php") ?>

<?php

if ($_SESSION['role_user'] !== 'SuperUser' && $_SESSION['role_user'] !== 'Administrator') {
  header("Location: javascript://history.go(-1)]");
}

$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM $table_name WHERE id=$id"));

?>

<div class="content">
  <div id="detail-aset" class="breadcrumb">Edit</div>
  <form action="update.php" method="post" enctype="multipart/form-data">
    <input name="id" type="text" value="<?= $id ?>" hidden>
    <div class="content-inner">
      <?php
      flash('edit_error');
      flash('edit_success');
      ?>
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label>Nama Aset</label>
            <input name="nama_aset" type="text" value="<?= $data['nama_aset'] ?>" />
          </div>
          <div class="form-group">
            <label>Kuantitas</label>
            <input name="kuantitas" type="number" value="<?= $data['kuantitas'] ?>" />
          </div>
          <div class="form-group">
            <label>Harga per-Barang</label>
            <input name="harga" type="number" value="<?= $data['harga'] ?>" />
          </div>
          <div class="form-group">
            <label>Tanggal Pembelian</label>
            <input name="tgl_pembelian" type="date" value="<?= $data['tgl_pembelian'] ?>" />
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label>Nama Pemeriksa</label>
            <input name="nama_pemeriksa" type="text" value="<?= $data['nama_pemeriksa'] ?>" />
          </div>
          <div class="form-group">
            <label>Tanggal Diperiksa</label>
            <input name="tgl_diperiksa" type="date" value="<?= $data['tgl_diperiksa'] ?>" />
          </div>
          <div class="form-group">
            <label>Foto / Gambar Aset</label>
            <input name="foto" type="file" id="file" />
            <input name="foto-old" type="text" value="<?= $data['foto'] ?>" hidden />
            <div class="info show">Foto / Gambar harus berekstensi JPG atau PNG, dengan ukuran file maks. 2MB.</div>
          </div>
          <div class="form-group">
            <label>Catatan</label>
            <textarea name="catatan"><?= $data['catatan'] ?></textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="btn-wrapper">
      <button name="update-aset" type="submit" class="btn btn-success">
        Update
      </button>
    </div>
  </form>
</div>

<?php include("../layout/footer.php") ?>