<header class="page-header page-header-dark bg-success pb-10">
  <div class="container-xl px-4">
    <div class="page-header-content pt-4">
      <div class="row align-items-center justify-content-between">
        <div class="col-auto mt-4">
          <h1 class="page-header-title">
            <div class="page-header-icon"><i data-feather="settings"></i></div>
            Account
          </h1>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- Main content -->
<div class="container-xl px-4 mt-n10">
  <div class="container-fluid">
    <div class="row">
      <?= $this->session->flashdata('msg') ?>
      <div class="col-xl-8">
        <!-- Account details card-->
        <div class="card mb-4">
          <div class="card-header">Account Details</div>
          <div class="card-body">
            <?php echo form_open_multipart('karyawan/proses_edit_profil'); ?>
            <input type="hidden" name="email_x" value="<?= $kar->email ?>" />
            <input type="hidden" name="id_karyawan" value="<?= $kar->id_karyawan ?>" />
            <!-- Form Group (username)-->
            <div class="mb-3">
              <label class="small mb-1" for="inputEmail">Email</label>
              <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" value="<?= $kar->email ?>" />
            </div>

            <div class="mb-3">
              <label class="small mb-1" for="inputnama_lengkap">Nama Lengkap</label>
              <input type="text" id="inputnama_lengkap" name="nama_karyawan" class="form-control" placeholder="Nama Lengkap" value="<?= $kar->nama_karyawan ?>" />
            </div>

            <div class="mb-3">
              <label class="small mb-1" for="inputjk">Jenis Kelamin</label>
              <div class="col-sm-10">
                <input name="jk" type="radio" id="jk1" <?php if ($kar->jk == "Laki - Laki") {
                                                          echo "checked";
                                                        } ?> value="Laki - Laki" required />
                <label for="jk1">Laki - Laki</label>
                <input name="jk" type="radio" id="jk2" <?php if ($kar->jk == "Perempuan") {
                                                          echo "checked";
                                                        } ?> value="Perempuan" required />
                <label for="jk2">Perempuan</label>
              </div>
            </div>


            <!-- Form Row-->
            <div class="row gx-3 mb-3">
              <!-- Form Group (phone number)-->
              <div class="col-md-6">
                <label class="small mb-1" for="inputBirthday">Tanggal Lahir</label>
                <input class="form-control" id="inputBirthday" type="date" name="tanggal_lahir" placeholder="Enter your birthday" value="<?= $kar->tanggal_lahir ?>" />
              </div>

              <div class="col-md-6">
                <label class="small mb-1" for="inputPhone">Nomor Telepon</label>
                <input class="form-control" id="inputPhone" type="text" name="no_hp" placeholder="Enter your phone number" value="<?= $kar->no_hp ?>" />
              </div>
              <!-- Form Group (birthday)-->

            </div>

            <div class="mb-3">
              <label class="small mb-1" for="alamat">Alamat</label>
              <textarea class="form-control" name="alamat"><?= $kar->alamat ?></textarea>
            </div>
            <!-- Save changes button-->
            <center>
              <input type="submit" class="btn btn-success" value="Simpan" name="edit">
            </center>
            </form>
          </div>
        </div>
      </div>
      <div class="col-xl-4">
        <!-- Profile picture card-->

        <div class="card mb-4 mb-xl-0">
          <div class="card-header">Password</div>
          <div class="card-body text-center">

            <button type="button" data-bs-toggle="modal" data-bs-target="#ganti" class="btn btn-success">Ganti Password</button>


          </div>
        </div>
      </div>

    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>


<div class="modal fade" id="uploadfoto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Upload Foto</h4>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?= form_open_multipart('karyawan/proses_edit_profil/') ?>

        <input type="file" name="foto" required>

      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" name="uploadfoto" value="Upload">

        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="hapusfoto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Foto</h4>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?= form_open_multipart('karyawan/proses_edit_profil/') ?>
        <p style="color: red">foto akan diganti dengan foto default</p>
      </div>
      <div class="modal-footer ">
        <input type="submit" class="btn btn-success" name="hapusfoto" value="Hapus">

        <?php echo form_close() ?>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="ganti" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ganti Password</h4>
        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('karyawan/proses_edit_profil') ?>" method="Post" id="editform2">

          <div class="help-info" id="pesan4_ks"> </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="passlama" id="passlama" placeholder="Password Lama" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="help-info" id="pesan2_ks"></div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="pass1" id="pass1_ks" placeholder="Password baru" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>

          <div class="help-info" id="pesan3_ks"> </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="pass2" id="pass2_ks" placeholder="Konfirmasi Password Baru" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>



      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" name="edit2" value="Simpan">

        <?php echo form_close() ?>

      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>