<?php

include("../database/koneksi.php");
include("../session/session.php");

if (isset($_POST['update-catatan'])) {
  $id = $_SESSION['id_user'];
  $catatan = $_POST['catatan'];

  mysqli_query($db, "UPDATE user SET catatan = '$catatan' WHERE id=$id");

  header("Location: ../dashboard");
}
