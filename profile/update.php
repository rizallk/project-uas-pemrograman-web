<?php

include("../database/koneksi.php");
include("../session/session.php");

if ($_SESSION['role_user'] !== 'SuperUser' || $_SESSION['role_user'] !== 'Administrator') {
  header("Location: javascript://history.go(-1)]");
}


function f_err($msg)
{
  flash('insert_error', $msg, FLASH_ERROR, '../profile');
}

function f_success($msg)
{
  flash('insert_success', $msg, FLASH_SUCCESS, '../profile');
}

if (isset($_POST['update-profil'])) {
  $id = $_SESSION['id_user'];

  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Konfigurasi file foto
  $ekstensi_required = array('png', 'jpg');
  $foto = $_FILES['foto']['name'];
  $x = explode('.', $foto);
  $ekstensi = strtolower(end($x));
  $ukuran  = $_FILES['foto']['size'];
  $file_tmp = $_FILES['foto']['tmp_name'];

  // Validasi
  if ($nama === '' && $username === '') {
    f_err('Nama dan Username!');
  } else if ($nama === '') {
    f_err('Nama harus diisi!');
  } else if (strlen($nama) > 30) {
    f_err('Nama tidak boleh lebih dari 30 karakter!');
  } else if ($username === '') {
    f_err('Username harus diisi!');
  } else if (strlen($username) > 25) {
    f_err('Username tidak boleh lebih dari 25 karakter!');
  } else if (strpos($username, ' ')) {
    f_err('Username tidak boleh mengandung spasi!');
  } else if ($password !== '') {
    if (strlen($password) > 25 || strlen($username) < 8) {
      f_err('Password tidak boleh kurang dari 8 dan/atau lebih dari 25 karakter!');
    } else if (strpos($password, ' ')) {
      f_err('Password tidak boleh mengandung spasi!');
    } else {
      // encrypt password
      $password = md5($password);

      if ($foto == true) {
        if (in_array($ekstensi, $ekstensi_required) == true) {
          if ($ukuran < (1044070 * 2)) {  // bytes = 2Mb	
            $dir_path = '../assets/foto-profile/';
            $foto = uniqid() . '-' . $foto;
            $foto_old = $_POST['foto-old'];

            unlink($dir_path . $foto_old);
            move_uploaded_file($file_tmp, $dir_path . $foto);

            mysqli_query($db, "UPDATE user SET nama = '$nama', username = '$username', password = '$password', foto = '$foto', updated_at = CURRENT_TIMESTAMP() WHERE id=$id");

            f_success('Berhasil memperbarui Profil!');
          } else {
            f_err('Ukuran foto terlalu besar!');
          }
        } else {
          f_err('Ekstensi foto yang diupload tidak diperbolehkan!');
        }
      } else {
        mysqli_query($db, "UPDATE user SET nama = '$nama', username = '$username', password = '$password', updated_at = CURRENT_TIMESTAMP() WHERE id=$id");

        f_success('Berhasil memperbarui Profil!');
      }
    }
  } else {
    if ($foto == true) {
      if (in_array($ekstensi, $ekstensi_required) == true) {
        if ($ukuran < (1044070 * 2)) {  // bytes = 2Mb		
          $dir_path = '../assets/foto-profile/';
          $foto = uniqid() . '-' . $foto;
          $foto_old = $_POST['foto-old'];

          unlink($dir_path . $foto_old);
          move_uploaded_file($file_tmp, $dir_path . $foto);

          mysqli_query($db, "UPDATE user SET nama = '$nama', username = '$username', foto = '$foto', updated_at = CURRENT_TIMESTAMP() WHERE id=$id");

          f_success('Berhasil memperbarui Profil!');
        } else {
          f_err('Ukuran foto terlalu besar!');
        }
      } else {
        f_err('Ekstensi foto yang diupload tidak diperbolehkan!');
      }
    } else {
      $query = mysqli_query($db, "UPDATE user SET nama = '$nama', username = '$username', updated_at = CURRENT_TIMESTAMP() WHERE id=$id");

      f_success('Berhasil memperbarui Profil!');
    }
  }
}
