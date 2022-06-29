                    <div class="container-xl px-4 mt-5">
                        <!-- Custom page header alternative example-->
                        <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
                            <div class="me-4 mb-3 mb-sm-0">
                                <h1 class="mb-0">Dashboard</h1>
                                <div class="small">
                                    <span class="fw-500 text-primary"><?= date('l') ?></span>
                                    &middot; <?= date('F j, Y') ?> &middot;

                                    <span id="jam"></span> :
                                    <span id="menit"></span> :
                                    <span id="detik"></span>
                                </div>
                            </div>

                        </div>
                        <!-- Illustration dashboard card example-->
                        <div class="card   mb-4 mt-5">
                            <div class="card-body ">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Bonus</th>
                                            <th>Bulan</th>
                                            <th>Tahun</th> 
                                            <th>Nilai</th>
                                            <th>Bonus</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($list_laporan as $rw) : ?>
                                            <?php $row = $this->Bonus_m->get_row(['kd_bonus' => $rw->kd_bonus]) ?>
                                            <tr>
                                                <td><?= $i++ ?> </td>
                                                <td><?= $row->kd_bonus ?> </td>
                                                <td><?= $row->bulan ?></td>
                                                <td><?= $row->tahun ?></td> 
                                                <td>
                                                    <?= $rw->nilai_akhir ?>
                                                </td>

                                                <td style="text-align: center;">

                                                    <?php if ($rw->status == 1) { ?>
                                                        <div class="badge bg-success text-white rounded-pill"><i class="fa fa-check-circle" aria-hidden="true"></i></div>
                                                    <?php  } else { ?>

                                                        <div class="badge bg-danger text-white rounded-pill"><i class="fa fa-times-circle" aria-hidden="true"></i></div>

                                                    <?php }  ?>

                                                </td>
                                                <td style="text-align: center;">

                                                    <a href="<?= base_url('karyawan/laporan/' . $row->kd_bonus) ?>">
                                                        <button class="btn btn-primary">Lihat Detail</i></button>
                                                    </a>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>