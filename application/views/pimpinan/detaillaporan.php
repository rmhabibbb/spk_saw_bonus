<?php if ($bonus->status == 3) { ?>
    <header class="page-header page-header-dark bg-success pb-10">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-book"></i></div>
                            Laporan Pemberian Bonus - <?= $bonus->kd_bonus ?>
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
                    " href="<?= base_url('pimpinan/laporan/' . $bonus->kd_bonus . '?konten=laporan') ?>">Laporan</a>


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
                                    <th>Keterangan</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;


                                foreach ($saw as $row) : ?>


                                    <tr>

                                        <td><?= $row->kriteria ?> </td>
                                        <td><?= $row->presentase ?>% </td>
                                        <td><?= $row->nilai ?> </td>
                                        <td><?= $row->keterangan ?> </td>


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

                                        <th><a style="text-decoration: underline;text-decoration-color:black;" href="<?= base_url('pimpinan/laporan/' . $bonus->kd_bonus . '?konten=laporan&detail=' . $row->id_laporan) ?>"><?= number_format($row->nilai_akhir, 3) ?></a></th>


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