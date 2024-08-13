<div class="pagetitle">
  <h1>Penjualan Barang</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item active">Penjualan</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center" style="font-size: 30px; padding: 40px;">Penjualan Barang</h5>
          <form method="post">
            <div class="row g-3 align-items-center mt-3">
              <div class="col-auto">
                <label for="tgl" class="form-label" style="font-size: 14px;">Tanggal Faktur</label>
                <input type="date" id="tgl" name="tgl" class="form-control" aria-describedby="passwordHelpInline" value="<?= date('Y-m-d'); ?>">
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-secondary" style="margin-top: 30px;" name="tampil">Tampil Faktur</button>
              </div>
            </div>
          </form>

          <?php

          $sql = mysqli_query($koneksi, "SELECT kode_faktur FROM faktur ORDER BY kode_faktur DESC");
          $data = mysqli_fetch_array($sql);

          if (mysqli_num_rows($sql) == 0) {
              $kd_fk = "fk-0001";
          }
          else {
              $kode = explode("-", $data['kode_faktur']);
              $kd_fk = $kode[0] . "-" . sprintf("%04s", $kode[1] + 1);
          }

          ?>


          <!-- Modal -->
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Penjualan</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="proses.php?module=transaksi&act=savefaktur">
                  <div class="modal-body">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="kode" id="floatingkode" value="<?= $kd_fk; ?>" readonly>
                      <label for="floatingkode">Kode Faktur</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="date" value="<?= date('Y-m-d'); ?>" class="form-control" name="tgl" id="floatingnama" placeholder="tanggal" required readonly>
                      <label for="floatingnama">Tanggal</label>
                    </div>
                    <input type="hidden" name="karyawan" value="kry-001">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <?php
          if (isset($_POST['tampil'])) :
            $tgl = $_POST['tgl'];
          ?>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-success mt-4" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="bi bi-plus-square"></i>
          </button>

          <table class="table table-hover table-sm mt-3">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Kode Faktur</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Jumlah Item</th>
                <th scope="col" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $hitung = mysqli_query($koneksi, "SELECT detail_faktur.kode_faktur, tgl_faktur, COUNT(detail_faktur.kode_faktur) as total_faktur FROM detail_faktur LEFT JOIN faktur ON detail_faktur.kode_faktur = faktur.kode_faktur
                WHERE tgl_faktur = '$tgl' GROUP BY kode_faktur ");
              $query = mysqli_query($koneksi, "SELECT * FROM faktur WHERE tgl_faktur = '$tgl'");
              
              // Ambil semua hasil perhitungan dan simpan dalam array
              $hasil_hitung = array();
              while ($row = mysqli_fetch_assoc($hitung)) {
                  $hasil_hitung[$row['kode_faktur']] = $row['total_faktur'];
              }

              while ($data = mysqli_fetch_array($query)) :
                  // Dapatkan nilai total_eksport berdasarkan no_eksport dari array hasil perhitungan
                  $faktur = $data['kode_faktur'];
                  $total_eksport = isset($hasil_hitung[$faktur]) ? $hasil_hitung[$faktur] : 0;
                  $tgl = date_create($data['tgl_faktur']);
              ?>
              <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $data['kode_faktur']; ?></td>
                <td><?= date_format($tgl, "d F Y"); ?></td>
                <td><?= $total_eksport; ?></td>
                <td align="center">
                  <a href="./?module=transaksi&act=penjualan-rinci&kodef=<?= $data['kode_faktur']; ?>" class="btn btn-outline-info btn-sm"><i class="bi bi-plus-square"></i></a>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>

          <?php endif; ?>

        </div>
      </div>

    </div>
  </div>
</section>