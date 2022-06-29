<header class="page-header page-header-dark bg-success pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa fa-address-book"></i></div>
                        Detail Jabatan - <?= $jabatan->nama_jabatan ?>
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
                    <div class="card-header"></div>
                    <div class="card-body">
                        <?php echo form_open_multipart('adminsistem/jabatan'); ?> 
                        <input type="hidden" name="id_jabatan" value="<?= $jabatan->id_jabatan ?>" />
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmail">Nama Jabatan</label>
                            <input type="text" id="inputEmail" name="nama_jabatan" class="form-control" placeholder="Masukkan nama jabatan" value="<?= $jabatan->nama_jabatan ?>" />
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
                    <div class="card-header">Hapus Data Jabatan</div>
                    <div class="card-body text-center">

                        <button type="button" data-bs-toggle="modal" data-bs-target="#hapus" class="btn btn-warning">Hapus</button>


                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Hapus Data Jabatan</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('adminsistem/jabatan/') ?>
                <input type="hidden" name="id_jabatan" value="<?= $jabatan->id_jabatan ?>">
                Apakah kamu yakin ingin menghapus jabatan ini ?
            </div>
            <div class="modal-footer ">
                <input type="submit" class="btn btn-success" name="hapus" value="Hapus">

                <?php echo form_close() ?>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div> 