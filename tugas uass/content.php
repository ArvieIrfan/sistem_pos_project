<?php

$module = $_GET['module'];
$act = isset($_GET['act']) ? $_GET['act'] : 'penjualan';
$hakes = $_SESSION['hakes'];

if ($hakes == 1) {

    if ($module == 'transaksi' && $act == 'penjualan'){
      include 'admin/transaksi/penjualan.php';
    }
    elseif ($module == 'transaksi' && $act == 'penjualan-rinci'){
      include 'admin/transaksi/penjualan-rinci.php';
    }
    elseif ($module == 'transaksi' && $act == 'pembelian'){
      include 'admin/transaksi/pembelian.php';
    }
    elseif ($module == 'transaksi' && $act == 'pembelian-rinci'){
      include 'admin/transaksi/pembelian-rinci.php';
    }
    elseif ($module == 'transaksi' && $act == 'stock'){
      include 'admin/transaksi/stock_barang1.php';
    }
    elseif ($module == 'laporan' && $act == 'harian'){
      include 'admin/laporan/harian1.php';
    }
    elseif ($module == 'laporan' && $act == 'bulanan'){
      include 'admin/laporan/bulanan1.php';
    }
    elseif ($module == 'laporan' && $act == 'barang'){
      include 'admin/laporan/penjualan_barang1.php';
    }
    elseif ($module == 'master' && $act == 'barang'){
      include 'admin/master/barang.php';
    }
    elseif ($module == 'master' && $act == 'updatebrg'){
      include 'admin/master/update-barang.php';
    }
    elseif ($module == 'master' && $act == 'karyawan'){
      include 'admin/master/karyawan.php';
    }
    elseif ($module == 'master' && $act == 'updatekry'){
      include 'admin/master/update-karyawan.php';
    }
    elseif ($module == 'master' && $act == 'satuan'){
      include 'admin/master/satuan.php';
    }
    elseif ($module == 'master' && $act == 'updatest'){
      include 'admin/master/update-satuan.php';
    }
    elseif ($module == 'master' && $act == 'supplier'){
      include 'admin/master/supplier.php';
    }
    elseif ($module == 'master' && $act == 'updatesup'){
      include 'admin/master/update-supplier.php';
    }
    elseif ($module == 'master' && $act == 'user'){
      include 'admin/master/users.php';
    }
    elseif ($module == 'master' && $act == 'updateuser'){
      include 'admin/master/update-users.php';
    }

}
elseif ($hakes == 2){
  ?>
  <style>
    .dadada {
      display: none;
    }
  </style>
  <?php
  if ($module == 'transaksi' && $act == 'penjualan'){
      include 'karyawan/transaksi/penjualan.php';
    }
    elseif ($module == 'transaksi' && $act == 'penjualan-rinci'){
      include 'karyawan/transaksi/penjualan-rinci.php';
    }
    elseif ($module == 'transaksi' && $act == 'pembelian'){
      include 'karyawan/transaksi/pembelian.php';
    }
    elseif ($module == 'transaksi' && $act == 'pembelian-rinci'){
      include 'karyawan/transaksi/pembelian-rinci.php';
    }
    elseif ($module == 'transaksi' && $act == 'stock'){
      include 'karyawan/transaksi/stock_barang1.php';
    }
}
else {
  header("location:./?module=login");
}

?>