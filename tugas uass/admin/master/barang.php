<div class="pagetitle">
  <h1>Barang</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item">Master</li>
      <li class="breadcrumb-item active">Data Barang</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center mb-3" style="font-size: 30px; padding: 40px;">Data Barang</h5>

          <?php

          $sql = mysqli_query($koneksi, "SELECT kode_barang FROM barang ORDER BY kode_barang DESC");
          $data = mysqli_fetch_array($sql);

          if (mysqli_num_rows($sql) == 0) {
              $kd_brg = "br-0001";
          }
          else {
              $kode = explode("-", $data['kode_barang']);
              $kd_brg = $kode[0] . "-" . sprintf("%04s", $kode[1] + 1);
          }

          ?>

          <!-- Modal -->
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Barang</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="proses.php?module=master&act=savebrg">
                  <div class="modal-body">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="kode_barang" id="floatingkode" value="<?= $kd_brg; ?>" readonly>
                      <label for="floatingkode">Kode Barang</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="nama_barang" id="floatingnama" placeholder="nama barang" required>
                      <label for="floatingnama">Nama Barang</label>
                    </div>                    
                    <div class="form-floating mb-3">
                      <textarea class="form-control" name="deskripsi" placeholder="Leave a comment here" id="floatingtextarea" required></textarea>
                      <label for="floatingtextarea">Deskripsi</label>
                    </div>
                    <div class="form-floating mb-3">
                      <select class="form-select" id="floatingSatuan" aria-label="Floating label select example" 
                      name="satuan">
                      <?php
                      $query = mysqli_query($koneksi, "SELECT * FROM satuan");
                      while ($data = mysqli_fetch_assoc($query)) :
                      ?>
                        <option value="<?= $data['kode_satuan']; ?>"><?= $data['satuan']; ?></option>
                      <?php endwhile; ?>
                      </select>
                      <label for="floatingSatuan">Pilih Satuan</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="number" class="form-control" id="floatingharga" placeholder="harga barang" 
                      name="harga" required>
                      <label for="floatingharga">Harga</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="number" class="form-control" id="floatingstok" placeholder="stok barang"
                      name="stok" required>
                      <label for="floatingstok">Stok</label>
                    </div>
                    <?php
                    $query1 = mysqli_query($koneksi, "SELECT * FROM marginprofit WHERE status = 'Aktif'");
                    $data1 = mysqli_fetch_assoc($query1);
                    ?>
                    <input type="hidden" name="margin" value="<?= $data1['margin']; ?>">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Button trigger modal -->
          <button type="button" class="btn btn-success mb-2 ms-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="bi bi-plus-square"></i>
          </button>

          <table class="table table-hover datatable table-sm">
            <thead class="table-warning">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Kode Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Satuan</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
                <th scope="col">Harga Jual</th>
                <th scope="col" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $query = mysqli_query($koneksi, "SELECT barang.*, satuan.satuan FROM barang LEFT JOIN satuan ON 
                                               barang.kode_satuan = satuan.kode_satuan");
              while ($data = mysqli_fetch_assoc($query)) :
              ?>
              <tr>
                <th scope="row"><?= $no++ ?></th>
                <td><?= $data['kode_barang']; ?></td>
                <td><?= $data['nama_barang']; ?></td>
                <td width="370px"><?= $data['deskripsi']; ?></td>
                <td><?= $data['satuan']; ?></td>
                <td>Rp.<?= number_format($data['harga']); ?></td>
                <td><?= $data['stock']; ?></td>
                <td>Rp.<?= number_format($data['harga_jual']); ?></td>
                <td align="center" width="90px">
                  <a href="./?module=master&act=updatebrg&kodebrg=<?= $data['kode_barang']; ?>" class="btn btn-outline-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                  <a href="proses.php?module=master&act=deletebrg&kodebrg=<?= $data['kode_barang']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="bi bi-trash3-fill"></i></a>
                </td>
              </tr>
              <?php endwhile; ?>
            </tbody>
          </table>

        </div>
      </div>

    </div>
  </div>
</section>