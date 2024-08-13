<?php
session_start();
session_destroy();
session_start();
$_SESSION['pesan'] = "berhasil logout";
header("location:./?module=login");
?>