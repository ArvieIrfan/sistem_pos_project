<div class="pagetitle">
  <h1>Laporan Stock Barang</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item active">Stock Barang</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center" style="font-size: 30px; padding: 40px;">Laporan Stock Barang</h5>

          <table class="table table-hover datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Kode Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Stock</th>
                <th scope="col">Satuan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_POST['tampil'])) {
                $tgl = $_POST['tgl'];
              }else{
                $tgl = date('Y-m-d');
              }
              $no = 1;
              $query = $koneksi->query("SELECT `barang`.*, `satuan`.`satuan` FROM `barang` 
                                LEFT JOIN `satuan` ON `barang`.`kode_satuan` = `satuan`.`kode_satuan` 
                                ORDER BY stock");
              

              while ($data = mysqli_fetch_array($query)) :
              ?>
              <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $data['kode_barang']; ?></td>
                <td><?= $data['nama_barang']; ?></td>
                <td><?= $data['stock']; ?></td>
                <td><?= $data['satuan']; ?></td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>

        </div>
      </div>

    </div>
  </div>
</section>