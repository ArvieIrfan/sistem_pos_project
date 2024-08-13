<?php

$module = $_GET['module'];
$act    = $_GET['act'];

if (isset($module) && isset($act)) {
  
  if ($module == 'transaksi' && $act == 'savefaktur') {
    $kode = $_POST['kode'];
    $tgl = $_POST['tgl'];
    $karyawan = $_POST['karyawan'];
    $query = mysqli_query($koneksi, "INSERT INTO faktur VAlUES('$kode', '$tgl','$karyawan')");

    if ($query) {
       echo "<script> alert('Data Berhasil di tambahkan'); </script>";
       echo "<script> window.location.href='./?module=transaksi&act=penjualan' </script>";
    }
    else {
       echo "<script> alert('Gagal tambahkan'); </script>";
       echo "<script> window.location.href='./?module=transaksi&act=penjualan' </script>";
    }
  }
  elseif ($module == 'transaksi' && $act == 'savefakturbeli') {
    $kode = $_POST['kode'];
    $tgl = $_POST['tgl'];
    $supplier = $_POST['supp'];
    $karyawan = $_POST['karyawan'];
    $query = mysqli_query($koneksi, "INSERT INTO fakturbeli VAlUES('$kode', '$tgl', '$supplier', '$karyawan')");

    if ($query) {
       echo "<script> alert('Data Berhasil di tambahkan'); </script>";
       echo "<script> window.location.href='./?module=transaksi&act=pembelian' </script>";
    }
    else {
       echo "<script> alert('Gagal tambahkan'); </script>";
       echo "<script> window.location.href='./?module=transaksi&act=pembelian' </script>";
    }
  }
  else if ($module == 'transaksi' && $act == 'tambahpenjualan') {
    $sql = mysqli_query($koneksi, "SELECT kode_detail FROM detail_faktur ORDER BY kode_detail DESC");
    $data = mysqli_fetch_array($sql);

    if (mysqli_num_rows($sql) == 0) {
        $df = "df-0001";
    }
    else {
        $kode = explode("-", $data['kode_detail']);
        $df = $kode[0] . "-" . sprintf("%04s", $kode[1] + 1);
    }
    $kode = $_POST['kode'];
    $barang = explode("_", $_POST['barang']);
    $jumlah = $_POST['jumlah'];
    $sql = "INSERT INTO detail_faktur VALUES ('$df','$kode','$jumlah','$barang[0]', '$barang[1]')";
    $query = mysqli_query($koneksi, $sql);
    if ($query) {
       echo "<script> alert('Data Berhasil di tambahkan'); </script>";
       echo "<script> window.location='./?module=transaksi&act=penjualan-rinci&kodef=$kode' </script>";
    }
    else {
       echo "<script> alert('Gagal di tambahkan'); </script>";
       echo "<script> window.location='./?module=transaksi&act=penjualan-rinci&kodef=$kode' </script>";
    }
  }
  else if ($module == 'transaksi' && $act == 'tambahpembelian') {
    $sql = mysqli_query($koneksi, "SELECT kode_detailbeli FROM detail_fakturbeli ORDER BY kode_detailbeli DESC");
    $data = mysqli_fetch_array($sql);

    if (mysqli_num_rows($sql) == 0) {
        $df = "dfb-0001";
    }
    else {
        $kode = explode("-", $data['kode_detailbeli']);
        $df = $kode[0] . "-" . sprintf("%04s", $kode[1] + 1);
    }
    $kode = $_POST['kode'];
    $barang = explode("_", $_POST['barang']);
    $jumlah = $_POST['jumlah'];
    $sql = "INSERT INTO detail_fakturbeli VALUES ('$df', '$kode', '$barang[0]', '$jumlah','$barang[1]')";
    $query = mysqli_query($koneksi, $sql);
    if ($query) {
       echo "<script> alert('Data Berhasil di tambahkan'); </script>";
       echo "<script> window.location='./?module=transaksi&act=pembelian-rinci&kodeb=$kode' </script>";
    }
    else {
       echo "<script> alert('Gagal di tambahkan'); </script>";
       echo "<script> window.location='./?module=transaksi&act=pembelian-rinci&kodeb=$kode' </script>";
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
  else if ($module == 'transaksi' && $act == 'deletedetail' && isset($_GET['kodef'])) {
    $kodef = $_GET['kodef'];
    $kodebr = $_GET['kodebr'];
    $query = mysqli_query($koneksi, "DELETE FROM detail_faktur WHERE kode_faktur = '$kodef' AND kode_barang = '$kodebr'");

    if ($query) {
        echo "<script> alert('Data berhasil dihapus'); </script>";
        echo "<script> window.location.href='./?module=transaksi&act=penjualan-rinci&kodef=$kodef'; </script>";
    } else {
        $error_message = mysqli_error($koneksi);
        echo "<script> alert('Data gagal dihapus. Error: $error_message'); </script>";
        echo "<script> window.location.href='./?module=transaksi&act=penjualan-rinci&kodef=$kodef'; </script>";
    }
  }
  else if ($module == 'transaksi' && $act == 'deletedetail' && isset($_GET['kodeb'])) {
    $kodeb = $_GET['kodeb'];
    $kodebr = $_GET['kodebr'];
    $query = mysqli_query($koneksi, "DELETE FROM detail_fakturbeli WHERE kode_fakturbeli = '$kodeb' AND kode_barang = '$kodebr'");

    if ($query) {
        echo "<script> alert('Data berhasil dihapus'); </script>";
        echo "<script> window.location.href='./?module=transaksi&act=pembelian-rinci&kodeb=$kodeb'; </script>";
    } else {
        $error_message = mysqli_error($koneksi);
        echo "<script> alert('Data gagal dihapus. Error: $error_message'); </script>";
        echo "<script> window.location.href='./?module=transaksi&act=pembelian-rinci&kodeb=$kodeb'; </script>";
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
}