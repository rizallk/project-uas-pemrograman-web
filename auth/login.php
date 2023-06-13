<?php

session_start();

include("../function/flash_message.php");
include("../database/koneksi.php");

if (isset($_POST['cek-login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($username === '' && $password === '') {
    flash('login_error', 'Username dan Password harus diisi!', FLASH_ERROR, '../auth');
  } else if ($username === '') {
    flash('login_error', 'Username harus diisi!', FLASH_ERROR, '../auth');
  } else if ($password === '') {
    flash('login_error', 'Password harus diisi!', FLASH_ERROR, '../auth');
  } else {
    $password = md5($password);

    $query = mysqli_query($db, "SELECT * FROM user WHERE username='$username' AND password='$password'");

    $user = mysqli_fetch_array($query);

    if ($user != NULL) {
      if ($user['role'] == 'SuperUser') {
        $_SESSION['id_user'] =  $user['id'];
        $_SESSION['nama_user'] =  $user['nama'];
        $_SESSION['role_user'] =  $user['role'];
        $_SESSION['status_login'] = true;
        $_SESSION['sesi_login'] = time();

        header("Location: ../dashboard");
      } else if ($user['role'] == 'Administrator') {
        $_SESSION['id_user'] =  $user['id'];
        $_SESSION['nama_user'] =  $user['nama'];
        $_SESSION['role_user'] =  $user['role'];
        $_SESSION['status_login'] = true;
        $_SESSION['sesi_login'] = time();

        header("Location: ../dashboard");
      } else if ($user['role'] == 'Guest') {
        $_SESSION['id_user'] =  $user['id'];
        $_SESSION['nama_user'] =  $user['nama'];
        $_SESSION['role_user'] =  $user['role'];
        $_SESSION['status_login'] = true;
        $_SESSION['sesi_login'] = time();

        header("Location: ../dashboard");
      } else {
        flash('login_error', 'Role tidak ditemukan!', FLASH_ERROR, '../auth');
      }
    } else {
      flash('login_error', 'Username atau Password salah!', FLASH_ERROR, '../auth');
    }
  }
}
