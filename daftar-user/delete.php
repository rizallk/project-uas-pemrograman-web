<?php

include("../database/koneksi.php");
include("../session/session.php");

if ($_SESSION['role_user'] !== 'SuperUser') {
  header("Location: javascript://history.go(-1)]");
}

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $user = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM user WHERE id=$id"));

  if ($user['id'] === $id) {
    if ($user['foto']) {
      unlink('../assets/foto-profile/' . $user['foto']);
    }

    $delete = mysqli_query($db, "DELETE FROM user WHERE id=$id");

    if (!$delete) {
      $error = 'Error: ' . mysqli_error($db);
      flash('index_error', $error, FLASH_ERROR, '../daftar-user');
    } else {

      flash('index_success', 'Berhasil menghapus User!', FLASH_SUCCESS, '../daftar-user');
    }
  } else {
    flash('index_error', 'Gagal menghapus user!', FLASH_ERROR, '../daftar-user');
  }
} else {
  flash('index_error', 'Gagal menghapus user!', FLASH_ERROR, '../daftar-user');
}
