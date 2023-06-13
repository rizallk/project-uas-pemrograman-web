<?php include("../layout/head.php") ?>
<?php include("../layout/sidebar.php") ?>
<?php include("../layout/navbar.php") ?>

<?php

if ($_SESSION['role_user'] !== 'SuperUser' && $_SESSION['role_user'] !== 'Administrator') {
  header("Location: javascript://history.go(-1)]");
}

?>

<div class="content">
  <div class="breadcrumb">Profil</div>

  <form action="update.php" method="post" enctype="multipart/form-data">
    <div class="content-inner">
      <?php
      flash('insert_error');
      flash('insert_success');
      ?>
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input name="nama" placeholder="Masukkan Nama Lengkap User" type="text" value="<?= $user['nama'] ?>" required />
          </div>
          <div class="form-group">
            <label>Role</label>
            <input name="role" type="text" value="<?= $user['role'] ?>" readonly />
          </div>
          <div class="form-group">
            <label>Foto</label>
            <input name="foto" id="file" type="file" />
            <input name="foto-old" type="text" value="<?= $user['foto'] ?>" hidden />
            <div class="info">Foto harus berekstensi JPG atau PNG, dengan ukuran file maks. 2MB.</div>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label>Username</label>
            <input name="username" placeholder="Masukkan Username" type="text" value="<?= $user['username'] ?>" required />
          </div>
          <div class="form-group">
            <label>Password Baru</label>
            <input id="password" name="password" placeholder="Masukkan Password Baru" type="password" />
            <div class="info">Password tidak boleh mengandung spasi.<br>Password tidak boleh kurang dari 8 dan/atau lebih dari 25 karakter.</div>
            <div class="checkbox-group">
              <input type="checkbox" name="show-pw" id="show-pw">
              <label for="show-pw">Show Password</label>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="btn-wrapper">
      <button name="update-profil" type="submit" class="btn btn-success">
        Update
      </button>
    </div>
  </form>
</div>

<?php include("../layout/footer.php") ?>