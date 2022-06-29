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

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <!-- Dashboard info widget 1-->
            <div class="card border-start-lg border-start-success h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small fw-bold text-success mb-1">Bonus</div>
                            <div class="h1"><?= $this->Bonus_m->get_num_row([]) ?></div>

                        </div>
                        <div class="ms-2"><i class="fas fa-trophy fa-2x text-gray-200"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <!-- Dashboard info widget 1-->
            <div class="card border-start-lg border-start-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small fw-bold text-primary mb-1">Pengguna</div>
                            <div class="h1"><?= $this->Pengguna_m->get_num_row([]) ?></div>

                        </div>
                        <div class="ms-2"><i class="fas fa-user fa-2x text-gray-200"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <!-- Dashboard info widget 1-->
            <div class="card border-start-lg border-start-secondary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small fw-bold text-secondary mb-1">Karyawan</div>
                            <div class="h1"><?= $this->Karyawan_m->get_num_row([]) ?></div>

                        </div>
                        <div class="ms-2"><i class="fas fa-address-card  fa-2x text-gray-200"></i></div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-xl-3 col-md-6 mb-4">
            <!-- Dashboard info widget 1-->
            <div class="card border-start-lg border-start-info  h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="small fw-bold text-info  mb-1">Kriteria</div>
                            <div class="h1"><?= $this->Kriteria_m->get_num_row([]) ?></div>

                        </div>
                        <div class="ms-2"><i class="fas fa-user fa-2x text-gray-200"></i></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>