<?php

include("../database/koneksi.php");
include("../session/session.php");

if ($_SESSION['role_user'] !== 'SuperUser') {
  header("Location: javascript://history.go(-1)]");
}

function f_err($msg)
{
  flash('insert_error', $msg, FLASH_ERROR, 'insert.php');
}

function f_success($msg)
{
  flash('insert_success', $msg, FLASH_SUCCESS, 'insert.php');
}

if (isset($_POST['add-user'])) {
  $nama = $_POST['nama'];
  $role = $_POST['role'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Konfigurasi file foto
  $ekstensi_required = array('png', 'jpg');
  $foto = $_FILES['foto']['name'];
  $x = explode('.', $foto);
  $ekstensi = strtolower(end($x));
  $ukuran  = $_FILES['foto']['size'];
  $file_tmp = $_FILES['foto']['tmp_name'];

  // Cek user apakah sudah pernah ditambahkan atau belum
  $cek_user = mysqli_num_rows(mysqli_query($db, "SELECT username FROM user WHERE username = '$username'"));

  // Validasi
  if ($nama === '' && $username === '' && $password === '') {
    f_err('Nama, Username dan Password harus diisi!');
  } else if ($nama === '') {
    f_err('Nama harus diisi!');
  } else if (strlen($nama) > 30) {
    f_err('Nama tidak boleh lebih dari 30 karakter!');
  } else if ($username === '') {
    f_err('Username harus diisi!');
  } else if (strlen($username) > 25 || strlen($username) < 8) {
    f_err('Username tidak boleh kurang dari 8 dan/atau lebih dari 25 karakter!');
  } else if (strpos($username, ' ')) {
    f_err('Username tidak boleh mengandung spasi!');
  } else if ($password === '') {
    f_err('Password harus diisi!');
  } else if (strlen($password) > 25 || strlen($username) < 8) {
    f_err('Password tidak boleh kurang dari 8 dan/atau lebih dari 25 karakter!');
  } else if (strpos($password, ' ')) {
    f_err('Password tidak boleh mengandung spasi!');
  } else if ($cek_user > 0) {
    f_err('Username telah ada, gunakan Username yang lain!');
  } else {
    // encrypt password
    $password = md5($password);

    if ($foto == true) {
      if (in_array($ekstensi, $ekstensi_required) == true) {
        if ($ukuran < (1044070 * 2)) {  // bytes = 2Mb		
          $foto = uniqid() . '-' . $foto;

          move_uploaded_file($file_tmp, '../assets/foto-profile/' . $foto);

          $query = mysqli_query($db, "INSERT INTO user(nama,role,username,password,foto,created_at) VALUES('$nama','$role','$username','$password','$foto',CURRENT_TIMESTAMP())");

          if (!$query) {
            f_err('Error : ' . mysqli_error($db));
          } else {
            f_success('Berhasil menambahkan User!');
          }
        } else {
          f_err('Ukuran foto terlalu besar!');
        }
      } else {
        f_err('Ekstensi foto yang diupload tidak diperbolehkan!');
      }
    } else {
      $query = mysqli_query($db, "INSERT INTO user(nama,role,username,password,created_at) VALUES('$nama','$role','$username','$password',CURRENT_TIMESTAMP())");

      if (!$query) {
        f_err('Error : ' . mysqli_error($db));
      } else {
        f_success('Berhasil menambahkan User!');
      }
    }
  }
}
