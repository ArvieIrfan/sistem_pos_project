<style>
  .search-bar {
    display: none;
  }
</style>
<div class="pagetitle">
  <h1>Laporan Bulanan</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item active">Bulanan</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center" style="font-size: 30px; padding: 40px;">Laporan Bulanan</h5>

          <form method="post">
            <div class="row g-3 align-items-center mt-3 mb-4">
              <div class="col-auto">
                <label for="tgl" class="form-label" style="font-size: 14px;">Pilih Bulan</label>
                <input type="month" id="tgl" name="bulan" class="form-control" aria-describedby="passwordHelpInline" value="<?= date('Y-m'); ?>">
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-light" style="margin-top: 30px;" name="tampil">Tampil</button>
              </div>
            </div>
          </form>

          <table class="table table-hover datatable table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Kode Faktur</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Kode Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Harga</th>
                <th scope="col">Subtotal</th>
                <th scope="col">Karyawan</th>
                <th scope="col">Jabatan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_POST['tampil'])) {
                $tgl = $_POST['bulan'];
              }else{
                $tgl = date('Y-m');
              }
              $no = 1;
              $query = mysqli_query($koneksi, "SELECT `detail_faktur`.*, `faktur`.`tgl_faktur`, `faktur`.
                `kode_karyawan`, `karyawan`.`nama_karyawan`, `karyawan`.`jabatan`, `barang`.`nama_barang`
                FROM `detail_faktur` 
                    LEFT JOIN `faktur` ON `detail_faktur`.`kode_faktur` = `faktur`.`kode_faktur` 
                    LEFT JOIN `karyawan` ON `faktur`.`kode_karyawan` = `karyawan`.`kode_karyawan` 
                    LEFT JOIN `barang` ON `detail_faktur`.`kode_barang` = `barang`.`kode_barang`
                    WHERE date_format(`faktur`.`tgl_faktur`, '%Y-%m' ) = '$tgl'");
              

              while ($data = mysqli_fetch_array($query)) :
                  $tgl = date_create($data['tgl_faktur']);
                  $subtotal = $data['quantity'] * $data['harga'];
              ?>
              <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $data['kode_faktur']; ?></td>
                <td><?= date_format($tgl, "M Y"); ?></td>
                <td><?= $data['kode_barang']; ?></td>
                <td><?= $data['nama_barang']; ?></td>
                <td><?= $data['quantity']; ?></td>
                <td>Rp.<?= number_format($data['harga']); ?></td>
                <td>Rp.<?= number_format($subtotal); ?></td>
                <td><?= $data['nama_karyawan']; ?></td>
                <td><?= $data['jabatan']; ?></td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>

        </div>
      </div>

    </div>
  </div>
</section>