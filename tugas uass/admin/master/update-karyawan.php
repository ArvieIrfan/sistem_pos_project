<div class="pagetitle">
  <h1>Data Karyawan</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item">Master</li>
      <li class="breadcrumb-item active">Data Karyawan</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center mb-5" style="font-size: 30px; padding: 40px;">Update Data Karyawan</h5>
          <?php
          require 'koneksi.php';

          $kode = $_GET['kodekry'];
          $sql = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE kode_karyawan = '$kode'");
          $data = mysqli_fetch_array($sql);

          ?>

          <form method="post" action="proses.php?module=master&act=updatekry">
            <div class="modal-body">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="kode" id="floatingkode" value="<?= $kode; ?>" readonly>
                <label for="floatingkode">Kode Karyawan</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="nama" id="floatingnama" placeholder="nama barang"required value="<?= $data['nama_karyawan']; ?>">
                <label for="floatingnama">Nama Karyawan</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="jabatan" id="floatingnama" placeholder="nama barang" required value="<?= $data['jabatan']; ?>">
                <label for="floatingnama">Jabatan</label>
              </div>
            </div>
            <div class="d-flex justify-content-between">
              <a href="./?module=master&act=karyawan" class="btn btn-secondary"><i class="bi bi-skip-backward-fill"></i></a>
              <button type="submit" class="btn btn-info">Update</button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</section>