<?php

include("../database/koneksi.php");
include("../session/session.php");
include("../aset-history/add.php");
include("config.php");

if ($_SESSION['role_user'] !== 'SuperUser' && $_SESSION['role_user'] !== 'Administrator') {
  header("Location: javascript://history.go(-1)]");
}

if (isset($_POST['id'])) {
  $id = $_POST['id'];

  $aset = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM $table_name WHERE id=$id"));

  if ($aset['id'] === $id) {
    if ($aset['foto']) {
      unlink('../assets/images/' . $folder_name . '/' . $aset['foto']);
    }

    $query = mysqli_query($db, "DELETE FROM $table_name WHERE id=$id");

    if (!$query) {
      $error = 'Error: ' . mysqli_error($db);
      flash('index_error', $error, FLASH_ERROR, '../' . $folder_name);
    } else {
      delete_history($db, $aset['nama_aset'], $lokasi, $_SESSION['nama_user']);
      flash('index_success', 'Berhasil menghapus Aset!', FLASH_SUCCESS, '../' . $folder_name);
    }
  } else {
    flash('index_error', 'Gagal menghapus aset!', FLASH_ERROR, '../' . $folder_name);
  }
} else {
  flash('index_error', 'Gagal menghapus aset!', FLASH_ERROR, '../' . $folder_name);
}
