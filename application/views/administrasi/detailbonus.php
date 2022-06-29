<?php if ($bonus->status == 1 || $bonus->status == 2) { ?>
    <header class="page-header page-header-dark bg-success pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-user-plus"></i></div>
                            Data bonus - <?= $bonus->kd_bonus ?>
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

                <nav class="nav nav-borders">

                    <a class="nav-link 
                    <?php
                    if ((isset($_GET['konten']) && ($_GET['konten'] == ''  || $_GET['konten'] == 'penilaian')) || empty($_GET['konten'])) {
                        echo "active ms-0";
                    }
                    ?> 
                    " href="<?= base_url('administrasi/bonus/' . $bonus->kd_bonus . '?konten=penilaian') ?>">Penilaian</a>


                    
                    <a class="nav-link 
                    <?php
                    if (isset($_GET['konten']) && ($_GET['konten'] == 'pengaturan')) {
                        echo "active active ms-0";
                    }
                    ?> 
                    
                    " href="<?= base_url('administrasi/bonus/' . $bonus->kd_bonus . '?konten=pengaturan') ?>">Pengaturan</a>

                </nav>

                <hr>
                <?php if ((isset($_GET['konten']) && ($_GET['konten'] == ''  || $_GET['konten'] == 'penilaian')) || empty($_GET['konten'])) { ?>


                    <?php if (isset($_GET['id_karyawan'])) {
                        if ($this->Karyawan_m->get_num_row(['id_karyawan' => $_GET['id_karyawan']]) == 0) {
                            redirect('administrasi/bonus/'.$bonus->kd_bonus);
                            exit();
                        } 
                        $karyawan = $this->Karyawan_m->get_row(['id_karyawan' => $_GET['id_karyawan']]);
                        $jabatan = $this->Jabatan_m->get_row(['id_jabatan' => $karyawan->id_jabatan]);
                        ?>

                        <form action="<?= base_url('administrasi/bonus') ?>" method="Post">
                        <input type="hidden" name="id_karyawan" value="<?=$karyawan->id_karyawan?>">
                        <input type="hidden" name="kd_bonus" value="<?=$bonus->kd_bonus?>">
                         <table class="table table-bordered">
                            <tr>
                                <th style="width: 30%">ID Karyawan</th>
                                <td>
                                    <?=$karyawan->id_karyawan?>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Karyawan</th>
                                <td>
                                    <?=$karyawan->nama_karyawan?>
                                </td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>
                                    <?=$karyawan->jk?>
                                </td>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <td>
                                    <?=$jabatan->nama_jabatan?>
                                </td>
                            </tr>
                        </table>
                           
                        <table class="table table-bordered">
                            <tr>
                                <th colspan="2"><center>Nilai Kriteria</center></th> 
                            </tr> 

                            <?php foreach ($list_kriteria as $k) : ?>
                                <tr>
                                    <th style="width: 30%"><?=$k->nama_kriteria?></th> 
                                    <td>
                                        <?php if ($k->hasIndikator == 0 || $k->id_kriteria == 1) { ?>
                                            <?php if ($bonus->status == 1) { ?>
                                                <?php if ($k->id_kriteria != 1) { ?>
                                                <select class="form-control"  name="kriteria_<?= $k->id_kriteria ?>">

                                                    <?php if ($this->Penilaian_m->get_num_row(['id_kriteria' => $k->id_kriteria, 'kd_bonus' => $bonus->kd_bonus, 'id_karyawan' => $karyawan->id_karyawan]) == 0) { ?>
                                                       <option value="">- Pilih -</option>
                                                        <?php $list_param = $this->Bobot_m->get(['id_kriteria' => $k->id_kriteria]); ?>
                                                        <?php foreach ($list_param as $param) : ?>
                                                            <option value="<?= $param->id_bobot ?>"> [<?= $param->bobot ?>] <?= $param->keterangan ?> 
                                                            </option>
                                                        <?php endforeach; ?>
                                                    <?php }else{ ?>
                                                          <?php $nilaix = $this->Penilaian_m->get_row(['id_kriteria' => $k->id_kriteria, 'kd_bonus' => $bonus->kd_bonus, 'id_karyawan' => $karyawan->id_karyawan])->id_bobot; ?>


                                                                    <option value="<?= $nilaix ?>"> [<?= $this->Bobot_m->get_row(['id_bobot' => $nilaix])->bobot ?>] <?= $this->Bobot_m->get_row(['id_bobot' => $nilaix])->keterangan ?></option>
                                                                    <?php $list_param = $this->Bobot_m->get(['id_kriteria' => $k->id_kriteria]); ?>
                                                                    <?php foreach ($list_param as $row3) : ?>
                                                                        <?php if ($row3->id_bobot != $nilaix) { ?>
                                                                            <option value="<?= $row3->id_bobot ?>"> [<?= $row3->bobot ?>] <?= $row3->keterangan ?> </option>
                                                                    <?php }
                                                                    endforeach; ?>
                                                    <?php } ?>

                                                    
                                                </select>
                                                <?php }else{ 
                                                     if ($this->Absensi_m->get_num_row(['bulan' => $bonus->bulan, 'tahun' => $bonus->tahun]) == 0) {
                                                        echo "Tidak ada data";
                                                    }else{
                                                        $absen = $this->Absensi_m->get_row(['bulan' => $bonus->bulan, 'tahun' => $bonus->tahun]);

                                                        if ($this->DAbsensi_m->get_num_row(['id_absensi' => $absen->id_absensi, 'id_karyawan' => $karyawan->id_karyawan]) == 0) {
                                                            echo "Tidak ada data";
                                                        }else{
                                                            $dt = $this->DAbsensi_m->get_row(['id_absensi' => $absen->id_absensi, 'id_karyawan' => $karyawan->id_karyawan]);
                                                            echo "Izin : " . $dt->izin . "<br>";
                                                            echo "Sakit : " . $dt->sakit . "<br>";
                                                            echo "Tanpa Keterangan : " . $dt->tanpa_ket . "<br>";
                                                        }  
                                                    }
                                                ?>

                                                <?php } ?>



                                            <?php } ?>



                                            <?php  if ($bonus->status == 2) { ?>

                                                <?php if ($k->id_kriteria != 1) { ?>

                                                 <?php if ($this->Penilaian_m->get_num_row(['id_kriteria' => $k->id_kriteria, 'kd_bonus' => $bonus->kd_bonus, 'id_karyawan' => $karyawan->id_karyawan]) == 0) { ?>
                                                        -
                                                    <?php }else{ ?>
                                                          <?php $nilaix = $this->Penilaian_m->get_row(['id_kriteria' => $k->id_kriteria, 'kd_bonus' => $bonus->kd_bonus, 'id_karyawan' => $karyawan->id_karyawan])->id_bobot; ?>
                                                        <?= $this->Bobot_m->get_row(['id_bobot' => $nilaix])->keterangan ?>
                                                    <?php } ?>
                                                <?php }else{ 
                                                    if ($this->Absensi_m->get_num_row(['bulan' => $bonus->bulan, 'tahun' => $bonus->tahun]) == 0) {
                                                        echo "Tidak ada data";
                                                    }else{
                                                        $absen = $this->Absensi_m->get_row(['bulan' => $bonus->bulan, 'tahun' => $bonus->tahun]);

                                                        if ($this->DAbsensi_m->get_num_row(['id_absensi' => $absen->id_absensi, 'id_karyawan' => $karyawan->id_karyawan]) == 0) {
                                                            echo "Tidak ada data";
                                                        }else{
                                                            $dt = $this->DAbsensi_m->get_row(['id_absensi' => $absen->id_absensi, 'id_karyawan' => $karyawan->id_karyawan]);
                                                            echo "Izin : " . $dt->izin . "<br>";
                                                            echo "Sakit : " . $dt->sakit . "<br>";
                                                            echo "Tanpa Keterangan : " . $dt->tanpa_ket . "<br>";
                                                            
                                                        }  
                                                    }
                                                ?>

                                                <?php } ?>

                                            <?php } ?> 
                                              



                                            <?php }else { 
                                                $list_indikator = $this->Indikator_m->get(['id_jabatan' => $jabatan->id_jabatan , 'id_kriteria' => $k->id_kriteria]);
                                            ?>
                                            <table class="table table-bordered">
                                                <?php foreach ($list_indikator as $ind) : ?>
                                                    <tr>
                                                        <td><?=$ind->nama_indikator?></td>
                                                        <td style="width: 20%; text-align: center;">
                                                             <?php  if ($bonus->status == 1) { ?>
                                                            <input type="checkbox" name="indikator_<?=$ind->id_indikator?>" id="indikator" 
                                                            <?php 
                                                                if($this->PenilaianKaryawan_m->get_num_row(['id_karyawan' => $karyawan->id_karyawan, 'id_indikator' => $ind->id_indikator, 'kd_bonus' => $bonus->kd_bonus]) != 0) {
                                                                    echo "checked";
                                                                }
                                                            ?>
                                                            >
                                                             <?php } ?> 

                                                            <?php  if ($bonus->status == 2) { ?>

                                                                <?php if($this->PenilaianKaryawan_m->get_num_row(['id_karyawan' => $karyawan->id_karyawan, 'id_indikator' => $ind->id_indikator, 'kd_bonus' => $bonus->kd_bonus]) != 0) { ?>
                                                                    <div class="badge bg-success text-white rounded-pill"><i class="fa fa-check-circle" aria-hidden="true"></i>
                                                                <?php }else { ?>

                                                                    <div class="badge bg-danger text-white rounded-pill"><i class="fa fa-times-circle" aria-hidden="true"></i>
                                                                <?php } ?>


                                                           


                                                            <?php } ?> 
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>  
                                            </table>
                                            <?php } ?> 
                                    </td>
                                </tr> 
                            <?php endforeach; ?>   
                        </table>

                        <center>
                            <input type="submit" name="simpannilai" class="btn btn-block btn-primary" value="Simpan">
                        </center>
                    </form>

                    <?php }else {  ?>
                        <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>ID Karyawan</th>
                                <th>Nama Karyawan</th>

                                <?php foreach ($list_kriteria as $k) : ?>
                                    <th><?= $k->nama_kriteria ?></th>
                                <?php endforeach; ?>
 
                                <th>Aksi</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $i = 1;
                            foreach ($list_karyawan as $row) : ?>
                     
                                    <tr>
                                        <td><?= $row->id_karyawan ?></td>
                                        <td><?= $row->nama_karyawan ?></td>
                                        <?php foreach ($list_kriteria as $k) : ?>
                                            <td>
                                            <?php

                                            if ($k->id_kriteria != 1) { 

                                                if ($this->Penilaian_m->get_num_row(['id_karyawan' => $row->id_karyawan, 'kd_bonus' => $bonus->kd_bonus, 'id_kriteria' => $k->id_kriteria]) == 0) {
                                                    echo "-";
                                                }else{
                                                    echo  $this->Penilaian_m->get_row(['id_karyawan' => $row->id_karyawan, 'kd_bonus' => $bonus->kd_bonus, 'id_kriteria' => $k->id_kriteria])->keterangan;
                                                }
                                            }else{
                                                if ($this->Absensi_m->get_num_row(['bulan' => $bonus->bulan, 'tahun' => $bonus->tahun]) == 0) {
                                                    echo "Tidak ada data";
                                                }else{
                                                    $absen = $this->Absensi_m->get_row(['bulan' => $bonus->bulan, 'tahun' => $bonus->tahun]);

                                                    if ($this->DAbsensi_m->get_num_row(['id_absensi' => $absen->id_absensi, 'id_karyawan' => $row->id_karyawan]) == 0) {
                                                        echo "Tidak ada data";
                                                    }else{
                                                        $dt = $this->DAbsensi_m->get_row(['id_absensi' => $absen->id_absensi, 'id_karyawan' => $row->id_karyawan]);
                                                        echo "Izin : " . $dt->izin . "<br>";
                                                        echo "Sakit : " . $dt->sakit . "<br>";
                                                        echo "Tanpa Keterangan : " . $dt->tanpa_ket . "<br>";
                                                    }
                                                }
                                                
                                            }

                                            

                                            ?>
                                            </td>
                                        <?php endforeach; ?>
                                        <?php if ($bonus->status == 1) { ?> 
                                        <td>
                                            <a href="<?= base_url('administrasi/bonus/' . $bonus->kd_bonus . '?konten=penilaian&id_karyawan='.$row->id_karyawan) ?>">
                                                <button class="btn btn-primary">
                                                    Edit Nilai
                                                </button>
                                            </a>
                                        </td>
                                        <?php   } ?>
                                        <?php if ($bonus->status == 2) { ?> 
                                        <td>
                                            <a href="<?= base_url('administrasi/bonus/' . $bonus->kd_bonus . '?konten=penilaian&id_karyawan='.$row->id_karyawan) ?>">
                                                <button class="btn btn-primary">
                                                    Lihat Detail
                                                </button>
                                            </a>
                                        </td>
                                        <?php   } ?>
                                    </tr>
                            <?php   endforeach; ?>
                        </tbody>
                    </table>

                    <?php } ?>

                  

                    



                <?php } elseif (isset($_GET['konten']) && ($_GET['konten'] == 'hasilpenilaian')) { ?>

                    <?php
                    $saw = $this->Penilaian_m->saw($bonus->kd_bonus);

                    ?>


                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Peringkat</th>
                                <th>ID Karyawan</th>
                                <th>Nama Lengkap</th>
                                <th>Nilai Akhir</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 1;

                            $list_calon = $this->Karyawan_m->get();

                            $list_kriteria = $this->Kriteria_m->get();

                            foreach ($saw['hasil_akhir'] as $row) : ?>

                                <?php $karyawan = $this->Karyawan_m->get_row(['id_karyawan' => $row['id_karyawan']]); ?>
                                <?php $pcg = $this->Pengguna_m->get_row(['email' => $karyawan->email]); ?>

                                
                                    <tr> 

                                    <th><?= $i++ ?></th>
                                    <td><?= $karyawan->id_karyawan ?> </td>
                                    <td>
                                        <?= $karyawan->nama_karyawan ?> </td>

                                    <th><?= number_format($row['nilai_akhir'], 3) ?></th>


                                    </tr>
                                <?php endforeach; ?>

                        </tbody>
                    </table>
                <?php } elseif (isset($_GET['konten']) && ($_GET['konten'] == 'saw')) { ?>
                    <?php
                    $saw = $this->Penilaian_m->saw($bonus->kd_bonus);

                    ?>
                    <h3>1. Nilai Awal</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Karyawan </th>

                                    <?php $i = 1;
                                    foreach ($list_kriteria as $row) : ?>
                                        <th><?= $row->nama_kriteria ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($saw['nilai_awal'] as $row) : ?>
                                    <?php $karyawan = $this->Karyawan_m->get_row(['id_karyawan' => $row['id_karyawan']]); ?>
                                    <?php $pcg = $this->Pengguna_m->get_row(['email' => $karyawan->email]); ?>
                                    <tr>
                                        <td><?= $karyawan->nama_karyawan ?> </td>

                                        <?php
                                        for ($i = 0; $i < sizeof($row['nilai']); $i++) {
                                            echo '<td>' .  $row['nilai'][$i] . '</td>  ';
                                        }
                                        ?>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <hr>

                    <h3>2. Normalisasi Matrik R</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Karyawan </th>
                                    <?php $i = 1;
                                    foreach ($list_kriteria as $row) : ?>
                                        <th><?= $row->nama_kriteria ?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($saw['matrik_r']  as $row) : ?>
                                    <?php $karyawan = $this->Karyawan_m->get_row(['id_karyawan' => $row['id_karyawan']]); ?>
                                    <?php $pcg = $this->Pengguna_m->get_row(['email' => $karyawan->email]); ?>

                                    <tr>
                                        <td><?= $karyawan->nama_karyawan ?> </td>
                                        <?php
                                        for ($i = 0; $i < sizeof($row['nilai']); $i++) {
                                            echo '<td>' .  $row['nilai'][$i] . '</td>  ';
                                        }
                                        ?>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <h3>3. Hasil Akhir </h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID Karyawan </th>
                                    <th>Nama Karyawan </th>
                                    <th>Nilai Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($saw['hasil'] as $row) : ?>
                                    <?php $karyawan = $this->Karyawan_m->get_row(['id_karyawan' => $row['id_karyawan']]); ?>
                                    <?php $pcg = $this->Pengguna_m->get_row(['email' => $karyawan->email]); ?>
                                    <tr>

                                        <td><?= $karyawan->id_karyawan ?> </td>
                                        <td><?= $karyawan->nama_karyawan ?> </td>
                                        <td><?= $row['nilai_akhir'] ?> </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <h3>4. Perangkingan</h3>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Peringkat</th>
                                    <th>ID Karyawan </th>
                                    <th>Nama Karyawan </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($saw['hasil_akhir'] as $row) : ?>
                                    <?php $karyawan = $this->Karyawan_m->get_row(['id_karyawan' => $row['id_karyawan']]); ?>
                                    <?php $pcg = $this->Pengguna_m->get_row(['email' => $karyawan->email]); ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $karyawan->id_karyawan ?> </td>
                                        <td><?= $karyawan->nama_karyawan ?> </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php } elseif (isset($_GET['konten']) && ($_GET['konten'] == 'pengaturan')) { ?>
                    <?php if ($bonus->status == 1) { ?> 
                    <button type="button" data-bs-toggle="modal" data-bs-target="#mulai5" class="btn btn-success">Minta Verifikasi Pimpinan</button>

                    <div class="modal fade" id="mulai5" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Penilaian selesai, minta verifikasi pimpinan? </h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?= base_url('administrasi/bonus') ?>" method="Post">
                                    <input type="hidden" value="<?= $bonus->kd_bonus ?>" name="kd_bonus">
                                    <div class="modal-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Kode bonus</th>
                                                <th>
                                                    <?= $bonus->kd_bonus ?>
                                                </th>
                                            </tr>

                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-success btn-block text-white " name="selesai" value="Selesai">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php }  ?>

                    <?php if ($bonus->status == 2) { ?> 
                        Penilaian selesai, menunggu verifikasi pimpinan
                    <?php }  ?>
                <?php }  ?>



            </div>

        </div>
    </div>
<?php  } elseif ($bonus->status == 3) { ?>
    <header class="page-header page-header-dark bg-success pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-user-plus"></i></div>
                            Data bonus - <?= $bonus->kd_bonus ?>
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

                <nav class="nav nav-borders">
                    <a class="nav-link 
                    <?php
                    if ((isset($_GET['konten']) && ($_GET['konten'] == ''  || $_GET['konten'] == 'laporan')) || empty($_GET['konten'])) {
                        echo "active ms-0";
                    }
                    ?> 
                    " href="<?= base_url('administrasi/bonus/' . $bonus->kd_bonus . '?konten=laporan') ?>">Laporan</a>


                </nav>

                <hr>
                <?php
                if ((isset($_GET['konten']) && ($_GET['konten'] == ''  || $_GET['konten'] == 'laporan')) || empty($_GET['konten'])) { ?>
                    <?php if (isset($_GET['detail'])) { ?>

                        <?php
                        $saw = $this->DLaporan_m->get(['id_laporan' => $_GET['detail']]);

                        ?>


                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Kriteria</th>
                                    <th>Presentase</th>
                                    <th>Nilai </th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;


                                foreach ($saw as $row) : ?>


                                    <tr>

                                        <td><?= $row->kriteria ?> </td>
                                        <td><?= $row->presentase ?>% </td>
                                        <td><?= $row->nilai ?> </td>


                                    </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    <?php } else {   ?>

                        <?php
                        $saw = $this->Laporan_m->get(['kd_bonus' => $bonus->kd_bonus]);

                        ?>


                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Peringkat</th>
                                    <th>ID Karyawan</th>
                                    <th>Nama Lengkap</th>
                                    <th>Nilai Akhir</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;


                                foreach ($saw as $row) : ?>

                                    <?php $karyawan = $this->Karyawan_m->get_row(['id_karyawan' => $row->id_karyawan]); ?>
                                    <?php $pcg = $this->Pengguna_m->get_row(['email' => $karyawan->email]); ?>

                                        <?php if ($row->status == 1) { ?>
                                        <tr style="background-color:chartreuse; ">
                                        <?php } else { ?>
                                        <tr>
                                        <?php } ?>

                                        <th><?= $i++ ?></th>
                                        <td><?= $karyawan->id_karyawan ?> </td>
                                        <td> <?= $karyawan->nama_karyawan ?> </td>

                                        <th> <?= $row->nilai_akhir?></th>


                                        </tr>
                                    <?php endforeach; ?>

                            </tbody>
                        </table>
                    <?php }  ?>
                <?php }  ?>



            </div>

        </div>
    </div>
<?php  }  ?>