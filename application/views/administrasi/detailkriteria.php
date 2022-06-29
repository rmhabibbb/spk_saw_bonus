<header class="page-header page-header-dark bg-success pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="list"></i></div>
                        Data Kriteria - <?= $kriteria->nama_kriteria ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container-xl px-4 mt-n10">
    <div class="card mb-4">
        <div class="card-body">
            <?= $this->session->flashdata('msg') ?>

            <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                <tbody>

                    <tr>
                        <th style="width: 30%">
                            ID Kriteria
                        </th>
                        <td>

                            <?= $kriteria->id_kriteria ?>

                        </td>
                    </tr>
                    <tr>
                        <th style="width: 30%">
                            Nama Kriteria
                        </th>
                        <td>

                            <?= $kriteria->nama_kriteria ?>

                        </td>
                    </tr>
                    <tr>
                        <th style="width: 30%">
                            Bobot Vektor
                        </th>
                        <td>

                            <?= $kriteria->bobot_vektor ?>%

                        </td>
                    </tr>

                    <tr>
                        <th style="width: 30%">
                            Tipe
                        </th>
                        <td>

                            <?= $kriteria->tipe ?>

                        </td>
                    </tr>

                <?php if ($kriteria->id_kriteria != 1) { ?>
                    <tr>
                        <th style="width: 30%">
                            Punya Indikator?
                        </th>
                        <td>

                            <?php
                                if ($kriteria->hasIndikator == 0) {
                                    echo "Tidak";
                                }else{
                                    echo "Ya";
                                }
                             ?>

                        </td>
                    </tr>
                     <?php } ?>

                </tbody>

            </table>
            <br>
            <center>
                <button type="button" data-bs-toggle="modal" data-bs-target="#edit" class="btn btn-success">Edit Kriteria</button>

                <?php if ($kriteria->id_kriteria != 1) { ?>
                   
                    <button type="button" data-bs-toggle="modal" data-bs-target="#hapus" class="btn btn-danger">Hapus Kriteria</button>

                 <?php } ?>
            </center>
        </div>
    </div>

</div>

<div class="container-xl px-4">
    <div class="card mb-4">
        <div class="card-body">
            <div class="card-header">
                <h3 class="card-title">Data Bobot Kriteria</h3>
            </div>
            <button type="button" data-bs-toggle="modal" data-bs-target="#tambahbobot" class="btn btn-success">Tambah Bobot Kriteria</button>

            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No.</th>

                        <?php if ($kriteria->hasIndikator == 0)  { ?> 
                        <th>Keterangan</th>
                        <?php }else { ?>
                            <th>Minimal Nilai Indikator</th>
                            <th>Maksimal Nilai Indikator</th>
                        <?php } ?>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($list_sub as $row) : ?>
                        <tr>
                            <td><?= $i++ ?></td>

                            <?php if ($kriteria->hasIndikator == 0)  { ?> 
                            <th><?=$row->keterangan?></th>
                            <?php  }else { ?>
                                <th><?=$row->min?></th>
                                <th><?=$row->max?></th>
                            <?php } ?>
                            <th><?=$row->bobot?></th>
                            <td>

                                <a type="button" data-bs-toggle="modal" data-bs-target="#edit-<?= $row->id_bobot ?>" href="">
                                    <button class="btn btn-datatable btn-icon btn-transparent-dark"><i data-feather="edit"></i></button>
                                </a>
                                <a type="button" data-bs-toggle="modal" data-bs-target="#delete-<?= $row->id_bobot ?>" href="">

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




<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Kriteria</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('administrasi/kriteria') ?>" method="Post">
                    <table class="table table-bordered table-striped table-hover" style="max-height: 300px">
                        <input type="hidden" name="id_kriteria" value="<?= $kriteria->id_kriteria ?>">
                        <tbody>
                            <tr>
                                <th>Nama Kriteria</th>
                                <th>
                                    <input type="text" class="form-control" name="nama_kriteria" placeholder="Masukkan Nama Kriteria " required autofocus value="<?= $kriteria->nama_kriteria ?>">
                                </th>
                            </tr>
                            <tr>
                                <th>Bobot Vektor</th>
                                <th>
                                    <input type="number" min="1" class="form-control" name="bobot" placeholder="Masukkan Bobot Vektor Kriteria (%)" required autofocus value="<?= $kriteria->bobot_vektor ?>">
                                </th>
                            </tr>
                            <tr>
                                <th>Tipe</th>
                                <th>
                                    <input name="tipe" type="radio" id="tipe1" <?php if ($kriteria->tipe == "Benefit") {
                                                                                    echo "checked";
                                                                                } ?> value="Benefit" required />
                                    <label for="tipe1">Benefit</label>
                                    <input name="tipe" type="radio" id="tipe2" <?php if ($kriteria->tipe == "Cost") {
                                                                                    echo "checked";
                                                                                } ?> value="Cost" required />
                                    <label for="tipe2">Cost</label>
                                </th>
                            </tr>

                        <?php if ($kriteria->id_kriteria != 1) { ?>
                           <tr>
                                <th>Punya Indikator</th>
                                <th>
                                    <input name="hasIndikator" type="radio" id="hasIndikator1" value="1" <?php if ($kriteria->hasIndikator == 1) {
                                                                                    echo "checked";
                                                                                } ?> required />
                                    <label for="hasIndikator1">Ya</label>
                                    <input name="hasIndikator" type="radio" id="hasIndikator2" value="0" <?php if ($kriteria->hasIndikator == 0) {
                                                                                    echo "checked";
                                                                                } ?> required />
                                    <label for="hasIndikator2">Tidak</label>
                                </th>
                            </tr>
                        <?php  }else { ?>
                            <input type="hidden" name="hasIndikator" value="1">
                        <?php  } ?>

                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <input type="submit" class="btn bg-success text-white" name="edit" value="Simpan">
                    </div>

                    <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Kriteria?</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('administrasi/kriteria') ?>" method="Post">
                <input type="hidden" value="<?= $kriteria->id_kriteria ?>" name="id_kriteria">
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>ID Kriteria</th>
                            <th>
                                <?= $kriteria->id_kriteria ?>
                            </th>
                        </tr>
                        <tr>
                            <th>Nama Kriteria</th>
                            <th>
                                <?= $kriteria->nama_kriteria ?>
                            </th>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success btn-block text-white " name="hapus" value="Hapus">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahbobot" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Tambah Bobot Kriteria</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('administrasi/bobot') ?>" method="Post">
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="id_kriteria" required autofocus value="<?= $kriteria->id_kriteria ?>">

                    <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                        <tbody>
                            <?php if ($kriteria->hasIndikator == 0)  { ?> 
                            
                            <tr>
                                <th style="width: 30%">
                                    Keterangan
                                </th>
                                <td>  
                                    <input type="text" class="form-control" name="ket" placeholder="Keterangan" required autofocus> 
                                </td>
                            </tr>

                            <?php }else{ ?> 
                                <tr>
                                    <th style="width: 30%">
                                        Minimal Nilai Indikator
                                    </th>
                                    <td>  
                                        <input type="number" class="form-control" name="min" placeholder="..." required autofocus> 
                                    </td>
                                </tr>
                                <tr>
                                    <th style="width: 30%">
                                        Maksimal Nilai Indikator
                                    </th>
                                    <td>  
                                        <input type="number" class="form-control" name="max" placeholder="..." required autofocus> 
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Bobot</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sangat Rendah</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>Rendah</td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>Cukup</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>Tinggi</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>Sangat Tinggi</td>
                                <td>5</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                        <tbody>

                            <tr>
                                <th style="width: 30%">
                                    Nilai
                                </th>
                                <td>


                                    <input type="number" class="form-control" name="nilai" placeholder="Nilai" required autofocus min="1" max="5">
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-success btn-block text-white " name="tambah" value="Simpan">
                </div>
            </form>
        </div>
    </div>
</div>


<?php $i = 1;
foreach ($list_sub as $row) : ?>
<div class="modal fade" id="edit-<?= $row->id_bobot ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Bobot Kriteria</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('administrasi/bobot') ?>" method="Post">

                        <input type="hidden" value="<?= $kriteria->id_kriteria ?>" name="id_kriteria">
                        <input type="hidden" value="<?= $row->id_bobot ?>" name="id_bobot">

                        <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                            <tbody>
 
                                  <?php if ($kriteria->hasIndikator == 0)  { ?> 
                                        
                                        <tr>
                                            <th style="width: 30%">
                                                Keterangan
                                            </th>
                                            <td>  
                                                <input type="text" class="form-control" name="ket" placeholder="Keterangan" required autofocus value="<?= $row->keterangan ?>"> 
                                            </td>
                                        </tr>

                                        <?php }else{ ?> 
                                            <tr>
                                                <th style="width: 30%">
                                                    Minimal Nilai Indikator
                                                </th>
                                                <td>  
                                                    <input type="number" class="form-control" name="min" placeholder="..." required autofocus value="<?= $row->min ?>"> 
                                                </td>
                                            </tr>
                                            <tr>
                                                <th style="width: 30%">
                                                    Maksimal Nilai Indikator
                                                </th>
                                                <td>  
                                                    <input type="number" class="form-control" name="max" placeholder="..." required autofocus value="<?= $row->max ?>"> 
                                                </td>
                                            </tr>
                                        <?php } ?>  
                            </tbody>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Bobot</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sangat Rendah</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td>Rendah</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>Cukup</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>Tinggi</td>
                                    <td>4</td>
                                </tr>
                                <tr>
                                    <td>Sangat Tinggi</td>
                                    <td>5</td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-bordered table-striped table-hover" style="max-height: 300px">

                            <tbody>

                                <tr>
                                    <th style="width: 30%">
                                        Bobot
                                    </th>
                                    <td>


                                        <input type="number" class="form-control" name="nilai" placeholder="Nilai" required autofocus min="1" max="5" step="any" value="<?= $row->bobot ?>">
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
<?php endforeach; ?>



<?php $i = 1;
foreach ($list_sub as $row) : ?>
 <div class="modal fade" id="delete-<?= $row->id_bobot ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Bobot Kriteria?</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('administrasi/bobot') ?>" method="Post">
                    <input type="hidden" value="<?= $kriteria->id_kriteria ?>" name="id_kriteria">
                    <input type="hidden" value="<?= $row->id_bobot ?>" name="id_bobot">
                    <<div class="modal-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>ID Bobot Kriteria</th>
                                <th>
                                    <?= $row->id_bobot ?>
                                </th>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <th>
                                    <?= $row->keterangan ?>
                                </th>
                            </tr>
                        </table>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success btn-block text-white " name="hapus" value="Hapus">
            </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

