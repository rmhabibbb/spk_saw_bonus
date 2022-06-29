<header class="page-header page-header-dark bg-success pb-10">
  <div class="container-xl px-4">
    <div class="page-header-content pt-4">
      <div class="row align-items-center justify-content-between">
        <div class="col-auto mt-4">
          <h1 class="page-header-title">
            <div class="page-header-icon"><i class="fa fa-address-book"></i></div>
            Kelola Data Jabatan
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
      <button type="button" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-success">Tambah Jabatan</button>
      <table id="datatablesSimple">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Jabatan</th> 
            <th>Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php $i = 1;
          foreach ($list_jabatan as $row) : ?>
            <tr>
              <td><?= $i++ ?> </td>
              <td><?= $row->nama_jabatan ?> </td>
             
              <td>

                <a href="<?= base_url('adminsistem/jabatan/' . $row->id_jabatan) ?>">
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
        <h5 class="modal-title">Form Tambah Jabatan</h5>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('adminsistem/jabatan') ?>" method="Post">

          <table class="table table-bordered">
            <tr>
              <th>Nama Jabatan</th>
              <th>
                <input type="text" class="form-control" name="nama_jabatan" placeholder="Masukkan Nama Jabatan" required autofocus>
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

 