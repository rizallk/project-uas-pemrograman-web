<?php

include('../database/koneksi.php');
include('../session/session.php');

$id_user = $_SESSION['id_user'];

$user = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM user WHERE id='$id_user'"));

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Style CSS -->
  <link rel="stylesheet" href="../assets/css/main.css" />
  <link rel="stylesheet" href="../assets/css/animation.css" />

  <title>Aplikasi Inventaris</title>
</head>

<body>
  <div class="bg-overlay"></div>
  <div class="container">