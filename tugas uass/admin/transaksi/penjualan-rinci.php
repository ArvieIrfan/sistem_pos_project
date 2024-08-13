<?php

  $kodef = $_GET['kodef'];

  $sql = mysqli_query($koneksi, "SELECT * FROM faktur WHERE kode_faktur = '$kodef'");
  $data = mysqli_fetch_array($sql);
  $tgl = date_create($data['tgl_faktur']);

?>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Penjualan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="proses.php?module=transaksi&act=tambahpenjualan" method="post">
        <div class="modal-body">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="kode" id="floatingInput" placeholder="kode_faktur" value="<?= $kodef; ?>" readonly>
            <label for="floatingInput">Kode Faktur</label>
          </div>
          <div class="form-floating mb-3">
            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="barang">
            <?php
            $query = mysqli_query($koneksi, "SELECT barang.*, satuan.satuan FROM barang
                                             LEFT JOIN satuan ON barang.kode_satuan = satuan.kode_satuan ");
            while ($data1 = mysqli_fetch_assoc($query)) :
            ?>
              <option value="<?= $data1['kode_barang'].'_'.$data1['harga_jual']; ?>"><?= $data1['nama_barang']. ' - '. $data1['stock']. ' '. 
              $data1['satuan']. ' - Rp.'. number_format($data1['harga_jual']); ?></option>
            <?php endwhile ?>
            </select>
            <label for="floatingSelect">Pilih Barang</label>
          </div>
          <div class="form-floating mb-3">
            <input type="number" min="1" name="jumlah" class="form-control" id="floatingInput" placeholder="kode_faktur">
            <label for="floatingInput">Jumlah</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="card mt-5">
  <div class="card-header">
    <div class="d-flex justify-content-between text-dark">
      <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success me-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          <i class="bi bi-plus-circle"></i>
        </button>
        No Faktur : <?= $kodef; ?></div>
      <div class="p-2">Tanggal : <?= date_format($tgl, "d F Y") ?></div>
    </div>
  </div>
  <div class="card-body text-center">
    <h5 class="card-title mt-3" style="font-size: 30px;">Penjualan Detail</h5>
    <table class="table table-hover table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Kode Barang</th>
          <th scope="col">Nama Barang</th>
          <th scope="col">Deskripsi</th>
          <th scope="col">Jumlah</th>
          <th scope="col">Satuan</th>
          <th scope="col">Harga</th>
          <th scope="col">Sub Total</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $jumlah = 0;
        $jumlah_qty = 0;
        $jumlah_har = 0;
        $query = mysqli_query($koneksi, "SELECT detail_faktur.*, barang.nama_barang, barang.deskripsi, satuan.satuan,
                                         barang.harga_jual
                                         FROM detail_faktur
                                         LEFT JOIN barang ON detail_faktur.kode_barang = barang.kode_barang
                                         LEFT JOIN satuan ON barang.kode_satuan = satuan.kode_satuan
                                         WHERE kode_faktur = '$kodef'");
        while ($data2 = mysqli_fetch_assoc($query)) :
        $jumlah_qty += $data2['quantity'];
        $jumlah_har += $data2['harga_jual'];
        $subtotal = $data2['harga_jual'] * $data2['quantity'];
        $jumlah += $subtotal;
        ?>
        <tr>
          <th scope="row"><?= $no++; ?></th>
          <td><?= $data2['kode_barang']; ?></td>
          <td><?= $data2['nama_barang']; ?></td>
          <td width="300"><?= $data2['deskripsi']; ?></td>
          <td><?= $data2['quantity']; ?></td>
          <td><?= $data2['satuan']; ?></td>
          <td>Rp.<?= number_format($data2['harga_jual']); ?></td>
          <td>Rp.<?= number_format($subtotal); ?></td>
          <td>
            <a href="proses.php?module=transaksi&act=deletedetail&kodef=<?= $kodef; ?>&kodebr=<?= $data2['kode_barang']; ?>" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash3"></i></a>
          </td>
        </tr>
        <?php endwhile; ?>
        <tr>
          <th colspan="4" align="right">Total Penjualan</th>
          <td><?= $jumlah_qty; ?></td>
          <td></td>
          <td>Rp.<?= number_format($jumlah_har); ?></td>
          <td>Rp.<?= number_format($jumlah); ?></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="card-footer text-body-secondary">
    <a href="./?module=transaksi&act=penjualan" class="btn btn-secondary"><i class="bi bi-backspace"></i></a>
  </div>
</div>