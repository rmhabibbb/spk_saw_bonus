<header class="page-header page-header-dark bg-success pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="list"></i></div>
                        Kelola Data Indikator
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
            <button type="button" data-bs-toggle="modal" data-bs-target="#tambah" class="btn btn-success">Tambah Indikator</button>
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Indikator</th>
                        <th>Kriteria</th>
                        <th>Jabatan</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1;
                    foreach ($list_indikator as $row) : ?>
                        <tr>
                            <td><?= $i++ ?> </td>
                            <td><?= $row->nama_indikator ?> </td>
                            <td><?= $this->Kriteria_m->get_row(['id_kriteria' => $row->id_kriteria])->nama_kriteria ?> </td>
                            <td><?= $this->Jabatan_m->get_row(['id_jabatan' => $row->id_jabatan])->nama_jabatan ?> </td>
                            <td> <?= $row->nilai_indikator ?></td> 
                            <td>

                               <a type="button" data-bs-toggle="modal" data-bs-target="#edit-<?= $row->id_indikator ?>" href="">
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"><i data-feather="edit"></i></button>
                                </a>
                                <a type="button" data-bs-toggle="modal" data-bs-target="#delete-<?= $row->id_indikator ?>" href="">
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
                <h5 class="modal-title">Form Tambah Indikator</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('administrasi/indikator') ?>" method="Post">

                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Indikator</th>
                            <th>
                                <input type="text" class="form-control" name="nama_indikator" placeholder="Masukkan Nama Indikator" required autofocus>
                            </th>
                        </tr>
                        <tr>
                            <th>Kriteria</th>
                            <th>
                               <select class="form-control" name="id_kriteria" required>
                                    <option>Pilih Kriteria</option>
                                    <?php foreach ($list_kriteria as $j) { ?>
                                        <option value="<?=$j->id_kriteria?>"><?=$j->nama_kriteria?></option>
                                    <?php   } ?>
                                </select>
                            </th>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <th>
                                <select class="form-control" name="id_jabatan" required>
                                    <option>Pilih Jabatan</option>
                                    <?php foreach ($list_jabatan as $j) { ?>
                                        <option value="<?=$j->id_jabatan?>"><?=$j->nama_jabatan?></option>
                                    <?php   } ?>
                                </select>
                            </th>
                        </tr>

                        <tr>
                            <th>Nilai</th>
                            <th>
                                 <input type="number" class="form-control" name="nilai_indikator" placeholder="Nilai Indikator" required min="1">
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
foreach ($list_indikator as $row) : ?>
    <!-- Modal -->

    <div class="modal fade" id="edit-<?= $row->id_indikator ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Indikator</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('administrasi/indikator') ?>" method="Post">

                            <input type="hidden" value="<?= $row->id_kriteria ?>" name="id_kriteria">
                            <input type="hidden" value="<?= $row->id_indikator ?>" name="id_indikator">

                            <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                            <tbody>

                                <tr>
                                    <th style="width: 30%">
                                        Nama Indikator
                                    </th>
                                    <td>


                                        <input type="text" class="form-control" name="nama_indikator" placeholder="Nama Indikator" required autofocus value="<?=$row->nama_indikator?>">

                                    </td>
                                </tr>
                                <tr>
                                    <th>Kriteria</th>
                                    <th>
                                       <select class="form-control" name="id_kriteria" required>
                                            <option value="<?=$row->id_kriteria?>" ><?=$this->Kriteria_m->get_row(['id_kriteria' => $row->id_kriteria])->nama_kriteria?></option>
                                            
                                            <?php foreach ($list_kriteria as $j) {
                                                if ($j->kriteria != $row->id_kriteria) {
                                             ?>
                                                <option value="<?=$j->id_kriteria?>"><?=$j->nama_kriteria?></option>
                                            <?php  }  } ?>
                                        </select>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Jabatan</th>
                                    <th>
                                        <select class="form-control" name="id_jabatan" required>
                                            <option value="<?=$row->id_jabatan?>" ><?=$this->Jabatan_m->get_row(['id_jabatan' => $row->id_jabatan])->nama_jabatan?></option>

                                            <?php foreach ($list_jabatan as $j) {
                                                if ($j->jabatan != $row->id_jabatan) {
                                             ?>
                                                <option value="<?=$j->id_jabatan?>"><?=$j->nama_jabatan?></option>
                                            <?php  }  } ?>
                                        </select>
                                    </th>
                                </tr>

                                <tr>
                                    <th style="width: 30%">
                                        Nilai
                                    </th>
                                    <td>


                                        <input type="number" class="form-control" name="nilai_indikator" placeholder="Nilai Indikator" required min="1" value="<?=$row->nilai_indikator?>">

                                    </td>
                                </tr>
                            </tbody> 
                        </table>


                    </div>

                    <div class="modal-footer">
                        <input type="submit" class="btn bg-success text-white" name="edit" value="Simpan">
                    </div>

                    <?php echo form_close() ?>
                </div>
            </div>
    </div>

    <div class="modal fade" id="delete-<?= $row->id_indikator ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Indikator?</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('administrasi/indikator') ?>" method="Post">
                    <input type="hidden" value="<?= $row->id_indikator ?>" name="id_indikator">
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID Indikator</th>
                                <th>
                                    <?= $row->id_indikator ?>
                                </th>
                            </tr>
                            <tr>
                                <th>Nama Indikator</th>
                                <th>
                                    <?= $row->nama_indikator ?>
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