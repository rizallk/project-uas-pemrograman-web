<?php

if ($_SESSION['role_user'] !== 'SuperUser' && $_SESSION['role_user'] !== 'Administrator') {
  header("Location: javascript://history.go(-1)]");
}

function add_history($db, $nama_aset, $lokasi, $oleh)
{
  return mysqli_query($db, "INSERT INTO aset_history(nama_aset,lokasi,status,oleh) VALUES('$nama_aset','$lokasi','Ditambahkan','$oleh')");
}

function update_history($db, $nama_aset, $lokasi, $oleh)
{
  return mysqli_query($db, "INSERT INTO aset_history(nama_aset,lokasi,status,oleh) VALUES('$nama_aset','$lokasi','Diperbarui','$oleh')");
}

function delete_history($db, $nama_aset, $lokasi, $oleh)
{
  return mysqli_query($db, "INSERT INTO aset_history(nama_aset,lokasi,status,oleh) VALUES('$nama_aset','$lokasi','Dihapus','$oleh')");
}
