
<div class="pagetitle">
  <h1>Rekap Penjualan Barang</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item active">Rekap Penjualan Barang</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center" style="font-size: 30px; padding: 40px;">Rekap Penjualan Barang</h5>

          <table class="table table-hover datatable table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Kode Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Jumlah terjual</th>
                <th scope="col">Harga</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $hitung = mysqli_query($koneksi, "SELECT `detail_faktur`.*,SUM(detail_faktur.quantity) as total_barang, `barang`.`nama_barang`, 
                `barang`.`stock` FROM `detail_faktur` 
              LEFT JOIN `barang` ON `detail_faktur`.`kode_barang` = `barang`.`kode_barang`
              GROUP BY kode_barang;");
              $query = $koneksi->query("SELECT `detail_faktur`.*, `barang`.`nama_barang`, `barang`.`stock`
                                        FROM `detail_faktur` 
              LEFT JOIN `barang` ON `detail_faktur`.`kode_barang` = `barang`.`kode_barang`;");
              $hasil_hitung = array();
              while ($row = mysqli_fetch_assoc($hitung)) {
                  $hasil_hitung[$row['kode_barang']] = $row['total_barang'];
              }

              while ($data = mysqli_fetch_array($query)) :
                $barang = $data['kode_barang'];
                $total_barang = isset($hasil_hitung[$barang]) ? $hasil_hitung[$barang] : 0;
              ?>
              <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $data['kode_barang']; ?></td>
                <td><?= $data['nama_barang']; ?></td>
                <td><?= $total_barang; ?></td>
                <td>Rp.<?= number_format($data['harga']*$total_barang); ?></td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>

        </div>
      </div>

    </div>
  </div>
</section>