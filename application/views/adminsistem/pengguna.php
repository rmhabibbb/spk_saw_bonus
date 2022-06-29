<header class="page-header page-header-dark bg-success pb-10">
  <div class="container-xl px-4">
    <div class="page-header-content pt-4">
      <div class="row align-items-center justify-content-between">
        <div class="col-auto mt-4">
          <h1 class="page-header-title">
            <div class="page-header-icon"><i data-feather="user"></i></div>
            Kelola Data Pengguna
          </h1>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- Main page content-->
<div class="container-xl px-4 mt-n10">
  <div class="card mb-4">
    <div class="card-body">
      <?= $this->session->flashdata('msg') ?>
      <button type="button" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-success">Tambah Pengguna</button>
      <table id="datatablesSimple">
        <thead>
          <tr>
            <th>No</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php $i = 1;
          foreach ($list_pengguna as $row) : ?>
            <tr>
              <td><?= $i++ ?> </td>
              <td><?= $row->email ?> </td>
              <td>
                <?php if ($row->role == 1) {
                  echo "Admin";
                } elseif ($row->role == 2) {
                  echo "Pimpinan";
                } elseif ($row->role == 3) {
                  echo "Karyawan";
                }
                ?>
              </td>
              <td>

                <a href="<?= base_url('adminsistem/pengguna/' . $row->id_pengguna) ?>">
                  <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i data-feather="edit"></i></button>
                </a>

              </td>
            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>
    </div>
  </div>

</div>

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Form Tambah Pengguna</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('adminsistem/pengguna') ?>" method="Post">

          <table class="table table-bordered">
            <tr>
              <th>Email</th>
              <th>
                <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required autofocus>
              </th>
            </tr>
            <tr>
              <th>Password</th>
              <th>
                <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required autofocus>
              </th>
            </tr>
            <tr>
              <th>Role</th>
              <th>
                <input name="role" type="radio" id="role1" value="1" required />
                <label for="role1">Admin</label>
                <input name="role" type="radio" id="role2" value="2" required />
                <label for="role2">Pimpinan</label>
              </th>
            </tr>
          </table>

      </div>
      <div class="modal-footer">
        <input type="submit" class="btn bg-success text-white" name="tambah" value="Tambah">
      </div>

      <?php echo form_close() ?>
    </div>
  </div>
</div>


<?php $i = 1;
foreach ($list_pengguna as $row) : ?>
  <!-- Modal -->
  <div class="modal fade" id="delete-<?= $i++ ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Pengguna?</h5>
          <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('adminsistem/pengguna') ?>" method="Post">
          <input type="hidden" value="<?= $row->email ?>" name="email">
          <div class="modal-body">
            <table class="table table-bordered">
              <tr>
                <th>Email</th>
                <th>
                  <?= $row->email ?>
                </th>
              </tr>
              <tr>
                <th>Nama Lengkap</th>
                <th>
                  <?= $row->nama_lengkap ?>
                </th>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <input type="submit" class="btn btn-success btn-block text-white " name="hapus" value="Hapus">
          </div>
          <?php echo form_close() ?>
      </div>
    </div>
  </div>
<?php endforeach; ?>