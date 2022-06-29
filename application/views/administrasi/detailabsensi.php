<header class="page-header page-header-dark bg-success pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa fa-calendar"></i></div>
                        Data Absensi - <?=$absensi->bulan?>/<?=$absensi->tahun?>
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
            <button type="button" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-success">Input Data Absensi Karyawan</button>
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th> 
                        <th>Nama Karyawan</th>
                        <th>Izin</th> 
                        <th>Sakit</th>
                        <th>Tanpa Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1;
                    foreach ($list_absensi as $row) : ?>
                    <?php 
                        $kar = $this->Karyawan_m->get_row(['id_karyawan' =>  $row->id_karyawan]);
                    ?>
                        <tr>
                            <td><?= $i++ ?> </td> 
                            <td><?= $kar->nama_karyawan ?></td>
                            <td><?= $row->izin ?></td>
                            <td><?= $row->sakit ?></td>
                            <td><?= $row->tanpa_ket ?></td>  
                            <td>
                                <a type="button" data-bs-toggle="modal" data-bs-target="#edit-<?= $row->id ?>" href="">
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i data-feather="edit"></i></button>
                                </a>
                                <a type="button" data-bs-toggle="modal" data-bs-target="#delete-<?= $row->id ?>" href="">
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="trash-2"></i></button>
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
                <h5 class="modal-title">Form Input Data Absensi</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('administrasi/absensi') ?>" method="Post">
                    <input type="hidden" class="form-control" name="id_absensi" value="<?=$absensi->id_absensi?>" >
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Karyawan</th>
                            <th>
                                <select class="form-control" name="id_karyawan" required>
                                    <option value="">Pilih Karyawan</option>
                                    <?php foreach ($list_karyawan as $j) { ?>

                                    <?php if ($this->DAbsensi_m->get_num_row(['id_absensi' => $absensi->id_absensi,'id_karyawan' => $j->id_karyawan]) == 0) { ?>
                                     
                                        <option value="<?=$j->id_karyawan?>"><?=$j->nama_karyawan?></option>
                                    <?php   } } ?>
                                </select>
                            </th>
                        </tr>

                        <tr>
                            <th>Izin</th>
                            <th>
                                <input type="number" class="form-control" name="izin" value="0" min="0" required autofocus>
                            </th>
                        </tr>
                        <tr>
                            <th>Sakit</th>
                            <th>
                                <input type="number" class="form-control" name="sakit" value="0" min="0" required autofocus>
                            </th>
                        </tr>
                        <tr>
                            <th>Tanpa Keterangan</th>
                            <th>
                                <input type="number" class="form-control" name="tanpa_ket" value="0" min="0" required autofocus>
                            </th>
                        </tr>
 

                    </table>

            </div>
            <div class="modal-footer">
                <input type="submit" class="btn bg-success text-white" name="tambah_data" value="Kirim">
            </div>

            <?php echo form_close() ?>
        </div>
    </div>
</div>


<?php foreach ($list_absensi as $row) : ?>
        <div class="modal fade" id="edit-<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Data Absensi</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('administrasi/absensi') ?>" method="Post">

                            <input type="hidden" value="<?= $row->id_absensi ?>" name="id_absensi"> 
                            <input type="hidden" value="<?= $row->id ?>" name="id">

                            <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                            <tbody>

                                <tr>
                            <th>Nama Karyawan</th>
                            <th>
                                <?=$this->Karyawan_m->get_row(['id_karyawan' => $row->id_karyawan])->nama_karyawan?>
                            </th>
                        </tr>

                        <tr>
                            <th>Izin</th>
                            <th>
                                <input type="number" class="form-control" name="izin" value="<?=$row->izin?>" min="0" required autofocus>
                            </th>
                        </tr>
                        <tr>
                            <th>Sakit</th>
                            <th>
                                <input type="number" class="form-control" name="sakit" value="<?=$row->sakit?>" min="0" required autofocus>
                            </th>
                        </tr>
                        <tr>
                            <th>Tanpa Keterangan</th>
                            <th>
                                <input type="number" class="form-control" name="tanpa_ket" value="<?=$row->tanpa_ket?>" min="0" required autofocus>
                            </th>
                        </tr>
                            </tbody> 
                        </table>


                    </div>

                    <div class="modal-footer">
                        <input type="submit" class="btn bg-success text-white" name="edit_data" value="Simpan">
                    </div>

                    <?php echo form_close() ?>
                </div>
            </div>
    </div>

    <div class="modal fade" id="delete-<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Data?</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('administrasi/absensi') ?>" method="Post">
                    <input type="hidden" value="<?= $row->id ?>" name="id">
                    <input type="hidden" value="<?= $row->id_absensi ?>" name="id_absensi">
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID Data</th>
                                <th>
                                    <?= $row->id ?>
                                </th>
                            </tr>
                            
                        </table>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success btn-block text-white " name="hapus_data" value="Hapus">
                    </div>
                    <?php echo form_close() ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
