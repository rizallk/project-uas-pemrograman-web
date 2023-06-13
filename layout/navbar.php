<section class="content-wrapper">
  <!-- Navbar -->
  <nav class="navbar">
    <div class="left">
      <div class="sidebar-toggle-open">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div class="message">Hai, <?= $user['nama'] ?>! Selamat datang.</div>
    </div>
    <div class="buttons">
      <?php
      if ($_SESSION['role_user'] === 'SuperUser' || $_SESSION['role_user'] === 'Administrator') {
      ?>
        <a href="../profile/">
          <button class="btn btn-profile">
            <div class="flex">
              <span>Profil</span>
              <img src="../assets/svg/profil.svg" alt="Profile" />
            </div>
          </button>
        </a>
      <?php } ?>
      <a href="../auth/logout.php"><button id="logout" class="btn btn-danger">Keluar</button></a>
    </div>
  </nav>