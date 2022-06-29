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

                        <?php
                        $saw = $this->DLaporan_m->get(['id_laporan' => $laporan->id_laporan]);

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
            </div>

        </div>
    </div>
<?php  }  ?>