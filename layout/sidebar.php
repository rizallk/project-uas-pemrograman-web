<section class="sidebar">
  <div class="logo">
    <img src="../assets/svg/logo.svg" alt="Logo" />
    <span class="title">Aplikasi Inventaris</span>
  </div>
  <div class="profile">
    <?php if ($user['foto']) { ?>
      <img class="foto-profil" src="../assets/foto-profile/<?= $user['foto'] ?>" alt="Foto Profil" />
    <?php } else { ?>
      <div class="foto-default">
        <img src="../assets/svg/foto-profil.svg" alt="Foto Profil" />
      </div>
    <?php } ?>
    <div class="detail">
      <div class="name"><?= $user['nama'] ?></div>
      <div class="role"><?= $user['role'] ?></div>
    </div>
  </div>
  <div class="menus">
    <div class="title">Menu</div>
    <ul>
      <a href="../dashboard/">
        <li>Dashboard</li>
      </a>
      <li class="menu-dropdown daftar-aset">
        Daftar Aset
        <img class="icon" src="../assets/svg/caret.svg" alt="Icon Dropdown" />
      </li>
      <ul class="submenu-dropdown">
        <a href="../aset-lab/">
          <li>Aset Lab</li>
        </a>
        <a href="../aset-kantor/">
          <li>Aset Kantor</li>
        </a>
        <a href="../aset-kelas/">
          <li>Aset Kelas</li>
        </a>
        <a href="../aset-auditorium/">
          <li>Aset Auditorium</li>
        </a>
      </ul>
      <?php if ($user['role'] === 'SuperUser' || $user['role'] === 'Administrator') { ?>
        <a href="../tambah-aset/">
          <li>Tambah Data Aset</li>
        </a>
      <?php } ?>
      <?php if ($user['role'] === 'SuperUser') { ?>
        <li class="menu-dropdown daftar-user">
          Daftar User
          <img class="icon" src="../assets/svg/caret.svg" alt="Icon Dropdown" />
        </li>
        <ul class="submenu-dropdown">
          <a href="../daftar-user/">
            <li>Users</li>
          </a>
          <a href="../daftar-user/insert.php">
            <li>Tambah User</li>
          </a>
        </ul>
      <?php } ?>
      <?php if ($user['role'] === 'SuperUser' || $user['role'] === 'Administrator') { ?>
        <a href="../aset-history/">
          <li>Aset History</li>
        </a>
      <?php } ?>
      <li>Lainnya</li>
    </ul>
  </div>
</section>