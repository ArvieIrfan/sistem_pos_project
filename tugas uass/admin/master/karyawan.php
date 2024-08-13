<div class="pagetitle">
  <h1>Karyawan</h1>
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
          <h5 class="card-title text-center mb-3" style="font-size: 30px; padding: 40px;">Data Karyawan</h5>
          <?php
          require 'koneksi.php';

          $sql = mysqli_query($koneksi, "SELECT kode_karyawan FROM karyawan ORDER BY kode_karyawan DESC");
          $data = mysqli_fetch_array($sql);

          if (mysqli_num_rows($sql) == 0) {
              $kd_kry = "kry-001";
          }
          else {
              $kode = explode("-", $data['kode_karyawan']);
              $kd_kry = $kode[0] . "-" . sprintf("%03s", $kode[1] + 1);
          }

          ?>

          <!-- Modal -->
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Karyawan</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="proses.php?module=master&act=savekry">
                  <div class="modal-body">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="kode" id="floatingkode" value="<?= $kd_kry; ?>" readonly>
                      <label for="floatingkode">Kode Karyawan</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="nama" id="floatingnama" placeholder="nama barang"required>
                      <label for="floatingnama">Nama Karyawan</label>
                    </div>
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="jabatan" id="floatingnama" placeholder="nama barang" required>
                      <label for="floatingnama">Jabatan</label>
                    </div>
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
                <th scope="col">Kode Karyawan</th>
                <th scope="col">Nama Karyawan</th>
                <th scope="col">Jabatan</th>
                <th scope="col" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $query = mysqli_query($koneksi, "SELECT * FROM karyawan");
              while ($data = mysqli_fetch_assoc($query)) :
              ?>
              <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $data['kode_karyawan']; ?></td>
                <td><?= $data['nama_karyawan']; ?></td>
                <td><?= $data['jabatan']; ?></td>
                <td align="center">
                  <a href="./?module=master&act=updatekry&kodekry=<?= $data['kode_karyawan']; ?>" class="btn btn-outline-warning btn-sm"><i class="bi bi-pencil-square"></i></a>
                  <a href="proses.php?module=master&act=deletekry&kodekry=<?= $data['kode_karyawan']; ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini?');"><i class="bi bi-trash3-fill"></i></a>
                </td>
              </tr>
              <?php endwhile ?>
            </tbody>
          </table>

        </div>
      </div>

    </div>
  </div>
</section>