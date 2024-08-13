<div class="pagetitle">
  <h1>Data Satuan</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item">Master</li>
      <li class="breadcrumb-item active">Data Satuan</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center mb-5" style="font-size: 30px; padding: 40px;">Data Satuan</h5>
          <?php
          require 'koneksi.php';

          $kode = $_GET['kodest'];
          $sql = mysqli_query($koneksi, "SELECT * FROM satuan WHERE kode_satuan = '$kode'");
          $data = mysqli_fetch_array($sql);

          ?>

          <form method="post" action="proses.php?module=master&act=updatest">
            <div class="modal-body">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="kode" id="floatingkode" value="<?= $kode; ?>" readonly>
                <label for="floatingkode">Kode Satuan</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="nama" id="floatingnama" placeholder="nama barang" required value="<?= $data['satuan']; ?>">
                <label for="floatingnama">Nama Satuan</label>
              </div>
            </div>
            <div class="d-flex justify-content-between">
              <a href="./?module=master&act=satuan" class="btn btn-secondary" ><i class="bi bi-skip-backward-fill"></i></a>
              <button type="submit" class="btn btn-info">Update</button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</seSatuan