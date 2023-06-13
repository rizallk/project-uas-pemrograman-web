<script>
  function infoLogin() {
    alert(`
    Info User Account Login :

    Username : su_johndoe34
    Password : johndoe332
    Role : SuperUser

    Username : admin_rizal
    Password : rizal12345
    Role : Administrator

    Username : guest_budi
    Password : budi_321
    Role : Guest
    `)
  }
  let stateCheck = setInterval(() => {
    if (document.readyState === 'complete') {
      clearInterval(stateCheck);
      infoLogin();
    }
  }, 100);
</script>

<?php

session_start();
include('../function/flash_message.php');

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

<body class="login">
  <div class="login-wrapper fade-in-down">
    <div class="title">
      <img src="../assets/svg/logo-black.svg" alt="Logo" />
      <span>Aplikasi Inventaris</span>
    </div>
    <hr />
    <?php flash('login_error') ?>
    <form action="login.php" method="post">
      <div class="form-group">
        <label>Username</label>
        <input id="username" placeholder="Masukkan Username" type="text" name="username" required />
      </div>
      <div class="form-group">
        <label>Password</label>
        <input id="password" placeholder="Masukkan Password" type="password" name="password" required />
      </div>
      <button class="btn btn-login" type="submit" name="cek-login">Login</button>
    </form>
    <hr />
    <p>Dibuat Oleh Kelompok 3 Kelas F Pemrograman Web</p>
    <br>
    <p onclick="infoLogin()"><a href="#" style="color: #116fad;">Lihat Info User Account Login</a></p>
  </div>
  <!-- Script JS -->
  <script src="../assets/js/script.js"></script>
</body>

</html>