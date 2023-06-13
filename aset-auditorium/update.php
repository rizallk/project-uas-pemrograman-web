<?php

include("../database/koneksi.php");
include("../session/session.php");
include("../aset-history/add.php");
include("config.php");

if ($_SESSION['role_user'] !== 'SuperUser' && $_SESSION['role_user'] !== 'Administrator') {
  header("Location: javascript://history.go(-1)]");
}

if (isset($_POST['update-aset'])) {
  $id = $_POST['id'];
  $nama_aset = $_POST['nama_aset'];
  $kuantitas = $_POST['kuantitas'];
  $harga = $_POST['harga'];
  $tgl_pembelian = $_POST['tgl_pembelian'];
  $nama_pemeriksa = $_POST['nama_pemeriksa'];
  $tgl_diperiksa = $_POST['tgl_diperiksa'];
  $catatan = $_POST['catatan'];

  // Konfigurasi file foto
  $ekstensi_required = array('png', 'jpg');
  $foto = $_FILES['foto']['name'];
  $x = explode('.', $foto);
  $ekstensi = strtolower(end($x));
  $ukuran  = $_FILES['foto']['size'];
  $file_tmp = $_FILES['foto']['tmp_name'];

  function f_err($msg, $id)
  {
    flash('edit_error', $msg, FLASH_ERROR, 'edit.php?id=' . $id);
  }

  function f_success($msg, $id)
  {
    flash('edit_success', $msg, FLASH_SUCCESS, 'edit.php?id=' . $id);
  }

  if ($foto == true) {
    if (in_array($ekstensi, $ekstensi_required) == true) {
      if ($ukuran < (1044070 * 2)) {  // bytes = 2Mb		
        $dir_path = '../assets/images/' . $folder_name . '/';
        $foto = uniqid() . '-' . $foto;
        $foto_old = $_POST['foto-old'];

        unlink($dir_path . $foto_old);
        move_uploaded_file($file_tmp, $dir_path . $foto);

        $query = mysqli_query($db, "UPDATE $table_name SET nama_aset = '$nama_aset', kuantitas = '$kuantitas', harga = '$harga', tgl_pembelian = '$tgl_pembelian', foto = '$foto', nama_pemeriksa = '$nama_pemeriksa', tgl_diperiksa = '$tgl_diperiksa', catatan = '$catatan', updated_at = CURRENT_TIMESTAMP() WHERE id=$id");

        if (!$query) {
          $error = 'Error ' . mysqli_error($db);
          f_err($error, $id);
        } else {
          update_history($db, $nama_aset, $lokasi, $_SESSION['nama_user']);
          f_success('Berhasil memperbarui Aset!', $id);
        }
      } else {
        f_err('Ukuran foto terlalu besar!');
      }
    } else {
      f_err('Ekstensi foto yang diupload tidak diperbolehkan!');
    }
  } else {
    $query = mysqli_query($db, "UPDATE $table_name SET nama_aset = '$nama_aset', kuantitas = '$kuantitas', harga = '$harga', tgl_pembelian = '$tgl_pembelian', nama_pemeriksa = '$nama_pemeriksa', tgl_diperiksa = '$tgl_diperiksa', catatan = '$catatan', updated_at = CURRENT_TIMESTAMP() WHERE id=$id");

    if (!$query) {
      $error = 'Error ' . mysqli_error($db);
      f_err($error, $id);
    } else {
      update_history($db, $nama_aset, $lokasi, $_SESSION['nama_user']);
      f_success('Berhasil memperbarui Aset!', $id);
    }
  }
}
