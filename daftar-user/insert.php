<?php include("../layout/head.php") ?>
<?php include("../layout/sidebar.php") ?>
<?php include("../layout/navbar.php") ?>

<?php

if ($_SESSION['role_user'] !== 'SuperUser') {
  header("Location: javascript://history.go(-1)]");
}

?>

<div class="content">
  <div class="breadcrumb">Tambah User</div>
  <form action="add.php" method="post" enctype="multipart/form-data">
    <div class="content-inner">
      <?php
      flash('insert_error');
      flash('insert_success');
      ?>
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" placeholder="Masukkan Nama Lengkap User" name="nama" required />
          </div>
          <div class="form-group">
            <label>Role</label>
            <select name="role">
              <option value="SuperUser">SuperUser</option>
              <option value="Administrator">Admin</option>
              <option value="Guest">Guest</option>
            </select>
          </div>
          <div class="form-group">
            <label>Foto</label>
            <input name="foto" type="file" id="file" />
            <div class="info show">Foto harus berekstensi JPG atau PNG, dengan ukuran file maks. 2MB.</div>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label>Username</label>
            <input id="username" type="text" placeholder="Masukkan Username" name="username" required />
            <div class="info">Username tidak boleh mengandung spasi.<br>Username tidak boleh kurang dari 8 dan/atau lebih dari 25 karakter.</div>
          </div>
          <div class="form-group">
            <label>Password</label>
            <input id="password" type="password" placeholder="Masukkan Password" name="password" id="password" required />
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
      <button type="submit" class="btn btn-success" name="add-user">
        Tambah User
      </button>
    </div>
  </form>
</div>

<?php include("../layout/footer.php") ?>