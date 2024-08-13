<?php

require 'koneksi.php';
session_start();
$module = $_GET['module'];
if ($_SESSION['hakes'] == 1) {
	if ($module == 'master') {
		include 'admin/master/act-master.php';
	}
	elseif ($module == 'transaksi') {
		include 'admin/transaksi/act-transaksi.php';
	}
	elseif ($module == 'laporan') {
		include 'admin/laporan/act-laporan.php';
	}
}
else {
	if ($module == 'transaksi') {
		include 'karyawan/transaksi/act-transaksi.php';
	}
}