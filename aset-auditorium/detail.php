<?php include("../layout/head.php") ?>
<?php include("../layout/sidebar.php") ?>
<?php include("../layout/navbar.php") ?>
<?php include("config.php") ?>

<?php

$id = $_GET['id'];
$data = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM $table_name WHERE id=$id"));

?>

<div class="content">
  <div id="detail-aset" class="breadcrumb">Detail</div>
  <form action="">
    <div class="content-inner">
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label>Nama Aset</label>
            <input type="text" value="<?= $data['nama_aset'] ?>" readonly />
          </div>
          <div class="form-group">
            <label>Kuantitas</label>
            <input type="number" value="<?= $data['kuantitas'] ?>" readonly />
          </div>
          <div class="form-group">
            <label>Harga per-Barang</label>
            <input type="number" value="<?= $data['harga'] ?>" readonly />
          </div>
          <div class="form-group">
            <label>Tanggal Pembelian</label>
            <input type="date" value="<?= $data['tgl_pembelian'] ?>" readonly />
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label>Nama Pemeriksa</label>
            <input type="text" value="<?= $data['nama_pemeriksa'] ?>" readonly />
          </div>
          <div class="form-group">
            <label>Tanggal Diperiksa</label>
            <input type="date" value="<?= $data['tgl_diperiksa'] ?>" readonly />
          </div>
          <div class="form-group">
            <label>Catatan</label>
            <textarea readonly><?= $data['catatan'] ?></textarea>
          </div>
          <div class="form-group">
            <label>Foto / Gambar</label>
            <?php if ($data['foto']) {
            ?>
              <img class="img-responsive" src="../assets/images/<?= $folder_name ?>/<?= $data['foto'] ?>" alt="<?= $data['foto'] ?>">
            <?php } else { ?>
              <p>Tidak ada.</p>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

<?php include("../layout/footer.php") ?>