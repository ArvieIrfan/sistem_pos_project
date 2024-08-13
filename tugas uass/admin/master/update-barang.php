<div class="pagetitle">
  <h1>Data Barang</h1>
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
          <h5 class="card-title text-center mb-5" style="font-size: 30px; padding: 40px;">Update Data Barang</h5>

          <?php

          $kode = $_GET['kodebrg'];
          $sql = mysqli_query($koneksi, "SELECT barang.*, satuan.satuan FROM barang LEFT JOIN satuan ON 
                                         barang.kode_satuan = satuan.kode_satuan WHERE kode_barang = '$kode'");
          $data = mysqli_fetch_array($sql);

          ?>

          <form method="post" action="proses.php?module=master&act=updatebrg">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="kode_barang" id="floatingkode" value="<?= $kode; ?>" readonly>
                <label for="floatingkode">Kode Barang</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="nama_barang" id="floatingnama" placeholder="nama barang" required value="<?= $data['nama_barang']; ?>">
                <label for="floatingnama">Nama Barang</label>
              </div>                    
              <div class="form-floating mb-3">
                <textarea class="form-control" name="deskripsi" placeholder="Leave a comment here" id="floatingtextarea" style="height: 100px;" required><?= $data['deskripsi']; ?></textarea>
                <label for="floatingtextarea">Deskripsi</label>
              </div>
              <div class="form-floating mb-3">
                <select class="form-select" id="floatingSatuan" aria-label="Floating label select example" 
                name="satuan">
                  <option selected value="<?= $data['kode_satuan']; ?>"><?= $data['satuan']; ?></option>
                <?php
                $st = $data['kode_satuan'];
                $query = mysqli_query($koneksi, "SELECT * FROM satuan WHERE kode_satuan NOT IN ('$st')");
                while ($data1 = mysqli_fetch_assoc($query)) :
                ?>
                  <option value="<?= $data1['kode_satuan']; ?>"><?= $data1['satuan']; ?></option>
                <?php endwhile; ?>
                </select>
                <label for="floatingSatuan">Pilih Satuan</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingharga" placeholder="harga barang" 
                name="harga" required value="<?= $data['harga']; ?>">
                <label for="floatingharga">Harga</label>
              </div>
              <div class="form-floating mb-3">
                <input type="number" class="form-control" id="floatingstok" placeholder="stok barang"
                name="stok" required value="<?= $data['stock']; ?>">
                <label for="floatingstok">Stok</label>
              </div>
              <?php
              $query1 = mysqli_query($koneksi, "SELECT * FROM marginprofit WHERE status = 'Aktif'");
              $data1 = mysqli_fetch_assoc($query1);
              ?>
              <input type="hidden" name="margin" value="<?= $data1['margin']; ?>">
              <div class="d-flex justify-content-between">
                <a href="./?module=master&act=barang" class="btn btn-secondary"><i class="bi bi-skip-backward-fill"></i></a>
                <button type="submit" class="btn btn-info">Update</button>
              </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</section>