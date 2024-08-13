<?php

$koneksi = mysqli_connect("localhost", "root", "");
mysqli_select_db($koneksi, "db_spos");

if (!$koneksi) {
	die("Koneksi error ". mysqli_connect_error());
}
?>