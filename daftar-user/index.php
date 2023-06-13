<?php include("../layout/head.php") ?>
<?php include("../layout/sidebar.php") ?>
<?php include("../layout/navbar.php") ?>

<?php

if ($_SESSION['role_user'] !== 'SuperUser') {
  header("Location: javascript://history.go(-1)]");
}

$all_user = mysqli_query($db, "SELECT * FROM user ORDER BY id DESC")

?>

<!-- Content -->
<div class="content">
  <div class="breadcrumb">Daftar User</div>

  <div class="content-inner">
    <?php
    flash('index_error');
    flash('index_success');
    ?>
    <!-- Tabel -->
    <div class="responsive-table asset-table">
      <table>
        <thead>
          <tr>
            <th class="center">No</th>
            <th>Nama Lengkap</th>
            <th>Role</th>
            <th>Username</th>
            <th class="center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach ($all_user as $data) { ?>
            <tr>
              <td class="center"><?= $no++ ?></td>
              <td><?= $data['nama'] ?></td>
              <td><?= $data['role'] ?></td>
              <td><?= $data['username'] ?></td>
              <td>
                <div class="td-action">
                  <a class="btn btn-warning btn-action" href="edit.php?id=<?= $data['id'] ?>"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg>
                  </a>
                  <form id="del-form" action="delete.php" method="post">
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <button name="delete" id="delete" class="btn btn-danger btn-action"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                      </svg>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include("../layout/footer.php") ?>