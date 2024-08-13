<div class="pagetitle">
  <h1>Data Users</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html"><i class="bi bi-house-door"></i></a></li>
      <li class="breadcrumb-item">Master</li>
      <li class="breadcrumb-item active">Data Users</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title text-center mb-5" style="font-size: 30px; padding: 40px;">Data Users</h5>
          <?php
          require 'koneksi.php';

          $kode = $_GET['kodeuser'];
          $sql = mysqli_query($koneksi, "SELECT users.*, nama_karyawan FROM users 
            LEFT JOIN karyawan ON users.kode_karyawan = karyawan.kode_karyawan WHERE kode_user = '$kode'");
          $data = mysqli_fetch_array($sql);
          if($data['hak_akses'] == '1'){
            $hakes = 2;
            $hak = 1;
          }else{
            $hakes = 1;
            $hak = 2;
          }

          ?>

          <form method="post" action="proses.php?module=master&act=updateuser">
            <div class="modal-body">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="kode" id="floatingkode" value="<?= $kode; ?>" readonly>
                <label for="floatingkode">Kode Users</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="nama" id="floatingnama" placeholder="nama barang" required value="<?= $data['nama_user']; ?>">
                <label for="floatingnama">Nama Users</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="pass" id="floatingnama" placeholder="nama barang"required value="<?= $data['password'] ?>">
                <label for="floatingnama">Password</label>
              </div>
              <div class="form-floating mb-3">
                <select class="form-select" id="floatingSatuan" aria-label="Floating label select example" 
                name="hakes">
                    <option value="<?= $hak; ?>"><?= $hak; ?></option>
                    <option value="<?= $hakes; ?>"><?= $hakes; ?></option>
                </select>
                <label for="floatingSatuan">Pilih Hak Akses</label>
              </div>
              <div class="form-floating mb-3">
                <select class="form-select" id="floatingSatuan" aria-label="Floating label select example" 
                name="kode_k">
                  <option value="<?= $data['kode_karyawan']; ?>"><?= $data['nama_karyawan']; ?></option>
                <?php
                $kode_k = $data['kode_karyawan'];
                $query = $koneksi->query("SELECT * FROM karyawan WHERE kode_karyawan NOT IN ('$kode_k')");
                while ($data = mysqli_fetch_assoc($query)) :
                ?>
                  <option value="<?= $data['kode_karyawan']; ?>"><?= $data['nama_karyawan']; ?></option>
                <?php endwhile; ?>
                </select>
                <label for="floatingSatuan">Pilih Karyawan</label>
              </div>
            </div>
            <div class="d-flex justify-content-between">
              <a href="./?module=master&act=user" class="btn btn-secondary" ><i class="bi bi-skip-backward-fill"></i></a>
              <button type="submit" class="btn btn-info">Update</button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</section>