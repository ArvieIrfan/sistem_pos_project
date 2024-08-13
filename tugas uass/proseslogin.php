<?php
session_start();
require 'koneksi.php';
$username   = $_POST['username'];
$password   = $_POST['password'];
// melakukan pengechekan ke database
$query  = $koneksi->query("SELECT * FROM users WHERE nama_user = '$username' and password='$password'");
$query1 = mysqli_fetch_assoc($query);
$chek = mysqli_num_rows($query);
if($chek > 0){
    // membuat session
    if ($query1['hak_akses'] == 1) {
        $_SESSION['hakes']= $query1['hak_akses'];
        $_SESSION['kode'] = $query1['kode_karyawan'];
        header("location:./?module=transaksi&act=penjualan");
    }
    else {
    $_SESSION['hakes']= $query1['hak_akses'];
    $_SESSION['kode'] = $query1['kode_karyawan'];
    header("location:./?module=transaksi&act=penjualan");
    }
}
else{
    $_SESSION['pesan'] = "email atau password salah";
    header("location:./?module=login");
}