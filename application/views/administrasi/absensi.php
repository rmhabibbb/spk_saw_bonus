<header class="page-header page-header-dark bg-success pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa fa-calendar"></i></div>
                        Data Absensi
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
            <button type="button" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-success">Buat Absensi Baru</button>
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th> 
                        <th>Bulan</th>
                        <th>Tahun</th> 
                        <th>Tanggal Buat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1;
                    foreach ($list_absensi as $row) : ?>
                        <tr>
                            <td><?= $i++ ?> </td> 
                            <td><?= $row->bulan ?></td>
                            <td><?= $row->tahun ?></td> 
                            <td><?= date('d-m-Y', strtotime($row->tgl_buat)) ?></td> 
                            
                            <td>

                                <a href="<?= base_url('administrasi/absensi/' . $row->id_absensi) ?>">
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
                <h5 class="modal-title">Form Buat Data Absensi</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('administrasi/absensi') ?>" method="Post">

                    <table class="table table-bordered">
                        <tr>
                            <th>Bulan</th>
                            <th>
                                <input type="number" class="form-control" name="bulan" min="1" max="12" value="<?= date('m') ?>" required autofocus>
                            </th>
                        </tr>

                        <tr>
                            <th>Tahun</th>
                            <th>
                                <input type="number" class="form-control" name="tahun" value="<?= date('Y') ?>" required autofocus>
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