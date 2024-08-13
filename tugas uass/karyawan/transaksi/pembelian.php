<div class="pagetitle">
  <h1>Pembelian Barang</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item active">Pembelian</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center" style="font-size: 30px; padding: 40px;">Pembelian Barang</h5>
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

          $sql = mysqli_query($koneksi, "SELECT kode_fakturbeli FROM fakturbeli ORDER BY kode_fakturbeli DESC");
          $data = mysqli_fetch_array($sql);

          if (mysqli_num_rows($sql) == 0) {
              $kd_fk = "fkb-0001";
          }
          else {
              $kode = explode("-", $data['kode_fakturbeli']);
              $kd_fk = $kode[0] . "-" . sprintf("%04s", $kode[1] + 1);
          }

          ?>


          <!-- Modal -->
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah pembelian</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="proses.php?module=transaksi&act=savefakturbeli">
                  <div class="modal-body">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="kode" id="floatingkode" value="<?= $kd_fk; ?>" readonly>
                      <label for="floatingkode">Kode Faktur</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="date" value="<?= date('Y-m-d'); ?>" class="form-control" name="tgl" id="floatingnama" placeholder="tanggal" required readonly>
                      <label for="floatingnama">Tanggal</label>
                    </div>
                    <div class="form-floating mb-3">
                      <select class="form-select" id="floatingSatuan" aria-label="Floating label select example" 
                      name="supp">
                      <?php
                      $query = mysqli_query($koneksi, "SELECT * FROM supplier");
                      while ($data1 = mysqli_fetch_assoc($query)) :
                      ?>
                        <option value="<?= $data1['kode_supp']; ?>"><?= $data1['nama_supp'].' - '. $data1['alamat']; ?></option>
                      <?php endwhile; ?>
                      </select>
                      <label for="floatingSatuan">Pilih Supplier</label>
                    </div>
                    <input type="hidden" name="karyawan" value="kry-002">
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
                <th scope="col">Supplier dan Alamat</th>
                <th scope="col">Jumlah Item</th>
                <th scope="col" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $hitung = mysqli_query($koneksi, "SELECT detail_fakturbeli.kode_fakturbeli, tanggal_beli, COUNT(detail_fakturbeli.kode_fakturbeli) as total_faktur FROM detail_fakturbeli LEFT JOIN fakturbeli ON detail_fakturbeli.kode_fakturbeli = fakturbeli.kode_fakturbeli
                WHERE date(tanggal_beli) = '$tgl' GROUP BY kode_fakturbeli ");
              $query = mysqli_query($koneksi, "SELECT `fakturbeli`.*, `supplier`.`nama_supp`, `supplier`.`alamat`
                                               FROM `fakturbeli` LEFT JOIN `supplier` ON `fakturbeli`.`kode_supp` = 
                                               `supplier`.`kode_supp` WHERE date(tanggal_beli) = '$tgl'");
              
              // Ambil semua hasil perhitungan dan simpan dalam array
              $hasil_hitung = array();
              while ($row = mysqli_fetch_assoc($hitung)) {
                  $hasil_hitung[$row['kode_fakturbeli']] = $row['total_faktur'];
              }

              while ($data1 = mysqli_fetch_array($query)) :
                  // Dapatkan nilai total_eksport berdasarkan no_eksport dari array hasil perhitungan
                  $faktur = $data1['kode_fakturbeli'];
                  $total_eksport = isset($hasil_hitung[$faktur]) ? $hasil_hitung[$faktur] : 0;
                  $tagl = date_create($data1['tanggal_beli']);
              ?>
              <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $data1['kode_fakturbeli']; ?></td>
                <td><?= date_format($tagl, "d F Y"); ?></td>
                <td><?= $data1['nama_supp']. ' - '. $data1['alamat']; ?></td>
                <td><?= $total_eksport; ?></td>
                <td align="center">
                  <a href="./?module=transaksi&act=pembelian-rinci&kodeb=<?= $data['kode_fakturbeli']; ?>" class="btn btn-outline-info btn-sm"><i class="bi bi-plus-square"></i></a>
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