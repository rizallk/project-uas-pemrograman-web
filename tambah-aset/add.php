<?php

include("../database/koneksi.php");
include("../session/session.php");
include("../aset-history/add.php");

if ($_SESSION['role_user'] !== 'SuperUser' && $_SESSION['role_user'] !== 'Administrator') {
  header("Location: javascript://history.go(-1)]");
}

function f_err($msg)
{
  flash('insert_error', $msg, FLASH_ERROR, '../tambah-aset');
}

function f_success($msg)
{
  flash('insert_success', $msg, FLASH_SUCCESS, '../tambah-aset');
}

if (isset($_POST['add-aset'])) {
  $nama_aset = $_POST['nama_aset'];
  $kuantitas = $_POST['kuantitas'];
  $harga = $_POST['harga'];
  $tgl_pembelian = $_POST['tgl_pembelian'];
  $nama_pemeriksa = $_POST['nama_pemeriksa'];
  $tgl_diperiksa = $_POST['tgl_diperiksa'];
  $lokasi = $_POST['lokasi'];
  $catatan = $_POST['catatan'];

  // Konfigurasi file foto
  $ekstensi_required = array('png', 'jpg');
  $foto = $_FILES['foto']['name'];
  $x = explode('.', $foto);
  $ekstensi = strtolower(end($x));
  $ukuran  = $_FILES['foto']['size'];
  $file_tmp = $_FILES['foto']['tmp_name'];

  // // Validasi
  if ($nama_aset === '' && $kuantitas === '') {
    f_err('Nama Aset dan Kuantitas harus diisi!');
  } else if ($nama_aset === '') {
    f_err('Nama Aset harus diisi!');
  } else if ($kuantitas === '') {
    f_err('Kuantitas harus diisi!');
  } else if ($kuantitas < 0) {
    f_err('Kuantitas tidak valid!');
  } else if ($harga < 0) {
    f_err('Harga tidak valid!');
  } else {
    if ($foto == true) {
      if (in_array($ekstensi, $ekstensi_required) == true) {
        if ($ukuran < (1044070 * 2)) {  // bytes = 2Mb		
          $foto = uniqid() . '-' . $foto;

          // Tambah Aset berdasarkan lokasi yang dipilih
          if ($lokasi === 'Lab') {
            $query = mysqli_query($db, "INSERT INTO aset_lab(nama_aset,kuantitas,harga,tgl_pembelian,foto,nama_pemeriksa,tgl_diperiksa,catatan,created_at) VALUES('$nama_aset','$kuantitas','$harga','$tgl_pembelian','$foto','$nama_pemeriksa','$tgl_diperiksa','$catatan',CURRENT_TIMESTAMP())");
          } else if ($lokasi === 'Kantor') {
            $query = mysqli_query($db, "INSERT INTO aset_kantor(nama_aset,kuantitas,harga,tgl_pembelian,foto,nama_pemeriksa,tgl_diperiksa,catatan,created_at) VALUES('$nama_aset','$kuantitas','$harga','$tgl_pembelian','$foto','$nama_pemeriksa','$tgl_diperiksa','$catatan',CURRENT_TIMESTAMP())");
          } else if ($lokasi === 'Kelas') {
            $query = mysqli_query($db, "INSERT INTO aset_kelas(nama_aset,kuantitas,harga,tgl_pembelian,foto,nama_pemeriksa,tgl_diperiksa,catatan,created_at) VALUES('$nama_aset','$kuantitas','$harga','$tgl_pembelian','$foto','$nama_pemeriksa','$tgl_diperiksa','$catatan',CURRENT_TIMESTAMP())");
          } else if ($lokasi === 'Auditorium') {
            $query = mysqli_query($db, "INSERT INTO aset_auditorium(nama_aset,kuantitas,harga,tgl_pembelian,foto,nama_pemeriksa,tgl_diperiksa,catatan,created_at) VALUES('$nama_aset','$kuantitas','$harga','$tgl_pembelian','$foto','$nama_pemeriksa','$tgl_diperiksa','$catatan',CURRENT_TIMESTAMP())");
          } else {
            f_err('Lokasi tidak ditemukan!');
          }

          if (!$query) {
            $err = 'Error : ' .  mysqli_error($db);
            f_err($err);
          } else {
            add_history($db, $nama_aset, $lokasi, $_SESSION['nama_user']);

            if ($lokasi === 'Lab') {
              move_uploaded_file($file_tmp, '../assets/images/aset-lab/' . $foto);
            } else if ($lokasi === 'Kantor') {
              move_uploaded_file($file_tmp, '../assets/images/aset-kantor/' . $foto);
            } else if ($lokasi === 'Kelas') {
              move_uploaded_file($file_tmp, '../assets/images/aset-kelas/' . $foto);
            } else if ($lokasi === 'Auditorium') {
              move_uploaded_file($file_tmp, '../assets/images/aset-auditorium/' . $foto);
            } else {
              f_success('Berhasil menambahkan Aset baru, namun terjadi kesalahan pada upload foto!');
            }

            f_success('Berhasil menambahkan Aset baru di lokasi ' . $lokasi . '!');
          }
        } else {
          f_err('Ukuran foto terlalu besar!');
        }
      } else {
        f_err('Ekstensi foto yang diupload tidak diperbolehkan!');
      }
    } else {
      // Tambah Aset berdasarkan lokasi yang dipilih
      if ($lokasi === 'Lab') {
        $query = mysqli_query($db, "INSERT INTO aset_lab(nama_aset,kuantitas,harga,tgl_pembelian,nama_pemeriksa,tgl_diperiksa,catatan,created_at) VALUES('$nama_aset','$kuantitas','$harga','$tgl_pembelian','$nama_pemeriksa','$tgl_diperiksa','$catatan',CURRENT_TIMESTAMP())");
      } else if ($lokasi === 'Kantor') {
        $query = mysqli_query($db, "INSERT INTO aset_kantor(nama_aset,kuantitas,harga,tgl_pembelian,nama_pemeriksa,tgl_diperiksa,catatan,created_at) VALUES('$nama_aset','$kuantitas','$harga','$tgl_pembelian','$nama_pemeriksa','$tgl_diperiksa',$catatan',CURRENT_TIMESTAMP())");
      } else if ($lokasi === 'Kelas') {
        $query = mysqli_query($db, "INSERT INTO aset_kelas(nama_aset,kuantitas,harga,tgl_pembelian,nama_pemeriksa,tgl_diperiksa,catatan,created_at) VALUES('$nama_aset','$kuantitas','$harga','$tgl_pembelian','$nama_pemeriksa','$tgl_diperiksa','$catatan',CURRENT_TIMESTAMP())");
      } else if ($lokasi === 'Auditorium') {
        $query = mysqli_query($db, "INSERT INTO aset_auditorium(nama_aset,kuantitas,harga,tgl_pembelian,nama_pemeriksa,tgl_diperiksa,catatan,created_at) VALUES('$nama_aset','$kuantitas','$harga','$tgl_pembelian','$nama_pemeriksa','$tgl_diperiksa','$catatan',CURRENT_TIMESTAMP())");
      } else {
        f_err('Lokasi tidak ditemukan!');
      }

      if (!$query) {
        $err = 'Error : ' .  mysqli_error($db);
        f_err($err);
      } else {
        add_history($db, $nama_aset, $lokasi, $_SESSION['nama_user']);
        f_success('Berhasil menambahkan Aset baru di lokasi ' . $lokasi . '!');
      }
    }
  }
}
