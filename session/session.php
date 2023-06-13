<?php

session_start();

include('../function/flash_message.php');

// Sesi login expired
$timeout = 7200; // 7200 detik = 2 jam

if ($_SESSION['sesi_login']) {
  $elapsed_time = time() - $_SESSION['sesi_login'];
  if ($elapsed_time >= $timeout) {
    session_destroy();
    header('Location: ../auth');
  }
}

if ($_SESSION['status_login'] != true) {
  flash('login_error', 'Anda harus login terlebih dahulu!', FLASH_ERROR);
  header('Location: ../auth');
}
