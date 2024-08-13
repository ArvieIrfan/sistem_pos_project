<div class="pagetitle">
  <h1>Data Supplier</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item">Master</li>
      <li class="breadcrumb-item active">Data Supplier</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center mb-5" style="font-size: 30px; padding: 40px;">Data Supplier</h5>
          <?php
          require 'koneksi.php';

          $kode = $_GET['kodesup'];
          $sql = mysqli_query($koneksi, "SELECT * FROM supplier WHERE kode_supp = '$kode'");
          $data = mysqli_fetch_array($sql);

          ?>

          <form method="post" action="proses.php?module=master&act=updatesup">
            <div class="modal-body">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="kode" id="floatingkode" value="<?= $kode; ?>" readonly>
                <label for="floatingkode">Kode Supplier</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="nama" id="floatingnama" placeholder="nama barang" required value="<?= $data['nama_supp']; ?>">
                <label for="floatingnama">Nama Supplier</label>
              </div>
              <div class="form-floating mb-3">
                <textarea class="form-control" name="alamat" placeholder="Leave a comment here" id="floatingtextarea" required><?= $data['alamat']; ?></textarea>
                <label for="floatingtextarea">Alamat</label>
              </div>
            </div>
            <div class="d-flex justify-content-between">
              <a href="./?module=master&act=supplier" class="btn btn-secondary" ><i class="bi bi-skip-backward-fill"></i></a>
              <button type="submit" class="btn btn-info">Update</button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</seSatuan