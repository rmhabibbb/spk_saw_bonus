<header class="page-header page-header-dark bg-success pb-10">
    <div class="container-xl px-4">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i class="fa fa-trophy"></i></div>
                        Penilaian Pemberian Bonus
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
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Bonus</th>
                        <th>Bulan</th>
                        <th>Tahun</th> 
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $i = 1;
                    foreach ($list_bonus as $row) : ?>
                        <tr>
                            <td><?= $i++ ?> </td>
                            <td><?= $row->kd_bonus ?> </td>
                            <td><?= $row->bulan ?></td>
                            <td><?= $row->tahun ?></td> 
                             <td>
                                <?php
                                if ($row->status == 1) {
                                    echo "Tahap Penilaian";
                                } elseif ($row->status == 2) {
                                    echo "Menunggu Verifikasi Pimpinan";
                                }elseif ($row->status == 3) {
                                    echo "Selesai";
                                }
                                ?>
                            </td>

                            <td>

                                <a href="<?= base_url('pimpinan/bonus/' . $row->kd_bonus) ?>">
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