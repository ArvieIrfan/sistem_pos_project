<?php

$module = $_GET['module'];
$act    = $_GET['act'];

if (isset($module) && isset($act)) {
  
  if ($module == 'master' && $act == 'savebrg') {
    $kode = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $desk = $_POST['deskripsi'];
    $satuan = $_POST['satuan'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $margin = $_POST['margin'];
    $harga_jual = ($harga * ($margin/100)) + $harga;
    $query = mysqli_query($koneksi, "INSERT INTO barang VAlUES('$kode', '$nama','$desk', '$satuan', '$harga', 
             '$stok','$harga_jual')");

    if ($query) {
       echo "<script> alert('Data Berhasil di tambahkan'); </script>";
       echo "<script> window.location.href='./?module=master&act=barang' </script>";
    }
    else {
       echo "<script> alert('Gagal tambahkan'); </script>";
       echo "<script> window.location.href='./?module=master&act=barang' </script>";
    }
  }
  else if ($module == 'master' && $act == 'savekry') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $query = mysqli_query($koneksi, "INSERT INTO karyawan VALUES ('$kode','$nama','$jabatan')");
    if ($query) {
       echo "<script> alert('Data Berhasil di tambahkan'); </script>";
       echo "<script> window.location.href='./?module=master&act=karyawan' </script>";
    }
    else {
       echo "<script> alert('Gagal di tambahkan'); </script>";
       echo "<script> window.location.href='./?module=master&act=karyawan' </script>";
    }
  }
  else if ($module == 'master' && $act == 'savest') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $query = mysqli_query($koneksi, "INSERT INTO satuan VALUES ('$kode','$nama')");
    if ($query) {
       echo "<script> alert('Data Berhasil di tambahkan'); </script>";
       echo "<script> window.location.href='./?module=master&act=satuan' </script>";
    }
    else {
       echo "<script> alert('Gagal di tambahkan'); </script>";
       echo "<script> window.location.href='./?module=master&act=satuan' </script>";
    }
  }
  else if ($module == 'master' && $act == 'savesup') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $query = mysqli_query($koneksi, "INSERT INTO supplier VALUES ('$kode','$nama','$alamat')");
    if ($query) {
       echo "<script> alert('Data Berhasil di tambahkan'); </script>";
       echo "<script> window.location.href='./?module=master&act=supplier' </script>";
    }
    else {
       echo "<script> alert('Gagal di tambahkan'); </script>";
       echo "<script> window.location.href='./?module=master&act=supplier' </script>";
    }
  }
  else if ($module == 'master' && $act == 'saveuser') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $pass = $_POST['pass'];
    $hakes = $_POST['hakes'];
    $kode_k = $_POST['kode_k'];
    $query = $koneksi->query("INSERT INTO users VALUES ('$kode','$nama','$pass','$hakes','$kode_k')");
    if (!$query) {
       echo "<script> alert('Gagal di tambahkan'); </script>";
       echo "<script> window.location.href='./?module=master&act=user' </script>";
    }
    else {
       echo "<script> alert('Data Berhasil di tambahkan'); </script>";
       echo "<script> window.location.href='./?module=master&act=user' </script>";
    }
  }
  else if ($module == 'master' && $act == 'updatebrg') {
    $kode = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $desk = $_POST['deskripsi'];
    $satuan = $_POST['satuan'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $margin = $_POST['margin'];
    $harga_jual = ($harga * ($margin/100)) + $harga;
    $query = mysqli_query($koneksi, "UPDATE `barang` SET `nama_barang`='$nama',`deskripsi`='$desk',`kode_satuan`='$satuan',`harga`='$harga',`stock`='$stok',`harga_jual`='$harga_jual' WHERE `kode_barang` = '$kode'");

    if ($query) {
       echo "<script> alert('Data Berhasil di update'); </script>";
       echo "<script> window.location.href='./?module=master&act=barang' </script>";
    }
    else {
       echo "<script> alert('Gagal diupdate'); </script>";
       echo "<script> window.location.href='./?module=master&act=barang' </script>";
    }
  }
  else if ($module == 'master' && $act == 'updatekry') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $query = mysqli_query($koneksi, "UPDATE `karyawan` SET `nama_karyawan`='$nama',`jabatan`='$jabatan' 
                                     WHERE `kode_karyawan` = '$kode'");
    if ($query) {
       echo "<script> alert('Data Berhasil di update'); </script>";
       echo "<script> window.location.href='./?module=master&act=karyawan' </script>";
    }
    else {
       echo "<script> alert('Gagal di update'); </script>";
       echo "<script> window.location.href='./?module=master&act=karyawan' </script>";
    }
  }
  else if ($module == 'master' && $act == 'updatest') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $query = mysqli_query($koneksi, "UPDATE `satuan` SET `satuan`='$nama' WHERE `kode_satuan`='$kode'");

    if ($query) {
       echo "<script> alert('Data Berhasil di update'); </script>";
       echo "<script> window.location.href='./?module=master&act=satuan' </script>";
    }
    else {
       echo "<script> alert('Gagal diupdate'); </script>";
       echo "<script> window.location.href='./?module=master&act=satuan' </script>";
    }
  }
  else if ($module == 'master' && $act == 'updatesup') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $query = mysqli_query($koneksi, "UPDATE `supplier` SET `nama_supp`='$nama', `alamat` = '$alamat' 
             WHERE `kode_supp`='$kode'");

    if ($query) {
       echo "<script> alert('Data Berhasil di update'); </script>";
       echo "<script> window.location.href='./?module=master&act=supplier' </script>";
    }
    else {
       echo "<script> alert('Gagal diupdate'); </script>";
       echo "<script> window.location.href='./?module=master&act=supplier' </script>";
    }
  }
  else if ($module == 'master' && $act == 'updateuser') {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $pass = $_POST['pass'];
    $hakes = $_POST['hakes'];
    $kode_k = $_POST['kode_k'];
    $query = $koneksi->query("UPDATE `users` SET `nama_user`='$nama', `password` = '$pass', 
      `hak_akses` = '$hakes', `kode_karyawan` = '$kode_k'  WHERE `kode_user`='$kode'");

    if (!$query) {
       echo "<script> alert('Gagal di update'); </script>";
       echo "<script> window.location.href='./?module=master&act=user' </script>";
    }
    else {
       echo "<script> alert('Data Berhasil di update'); </script>";
       echo "<script> window.location.href='./?module=master&act=user' </script>";
    }
  }
  else if ($module == 'master' && $act == 'deletebrg' && isset($_GET['kodebrg'])) {
    $kode = $_GET['kodebrg'];
    $query = mysqli_query($koneksi, "DELETE FROM barang where kode_barang='$kode'");

    if ($query) {
      // code...
      echo "<script> alert('Data berhasil dihapus'); </script>";
      echo "<script> window.location.href='./?module=master&act=barang' </script>";
    }
    else {
      echo "<script> alert('Data gagal dihapus'); </script>";
      echo "<script> window.location.href='./?module=master&act=barang'; </script>";
    }
  }
  else if ($module == 'master' && $act == 'deletekry' && isset($_GET['kodekry'])) {
    $kode = $_GET['kodekry'];
    $query = mysqli_query($koneksi, "DELETE FROM karyawan where kode_karyawan='$kode'");

    if ($query) {
      // code...
      echo "<script> alert('Data berhasil dihapus'); </script>";
      echo "<script> window.location.href='./?module=master&act=karyawan' </script>";
    }
    else {
      echo "<script> alert('Data gagal dihapus'); </script>";
      echo "<script> window.location.href='./?module=master&act=karyawan'; </script>";
    }
  }
  else if ($module == 'master' && $act == 'deletest' && isset($_GET['kodest'])) {
    $kode = $_GET['kodest'];
    $query = mysqli_query($koneksi, "DELETE FROM satuan where kode_satuan='$kode'");

    if ($query) {
      // code...
      echo "<script> alert('Data berhasil dihapus'); </script>";
      echo "<script> window.location.href='./?module=master&act=satuan' </script>";
    }
    else {
      echo "<script> alert('Data gagal dihapus'); </script>";
      echo "<script> window.location.href='./?module=master&act=satuan'; </script>";
    }
  }
  else if ($module == 'master' && $act == 'deletesup' && isset($_GET['kodesup'])) {
    $kode = $_GET['kodesup'];
    $query = mysqli_query($koneksi, "DELETE FROM supplier where kode_supp ='$kode'");

    if ($query) {
      // code...
      echo "<script> alert('Data berhasil dihapus'); </script>";
      echo "<script> window.location.href='./?module=master&act=supplier' </script>";
    }
    else {
      echo "<script> alert('Data gagal dihapus'); </script>";
      echo "<script> window.location.href='./?module=master&act=supplier'; </script>";
    }
  }
  else if ($module == 'master' && $act == 'deleteuser' && isset($_GET['kodeuser'])) {
    $kode = $_GET['kodeuser'];
    $query = $koneksi->query("DELETE FROM users WHERE kode_user ='$kode'");

    if (!$query) {
      // code...
      echo "<script> alert('Gagal dihapus'); </script>";
      echo "<script> window.location.href='./?module=master&act=user' </script>";
    }
    else {
      echo "<script> alert('Data berhasil dihapus'); </script>";
      echo "<script> window.location.href='./?module=master&act=user'; </script>";
    }
  }
}