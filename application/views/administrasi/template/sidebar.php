<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">

                    <!-- Sidenav Menu Heading (Core)-->
                    <div class="sidenav-menu-heading">Menu</div>
                    <!-- Sidenav Accordion (Dashboard)-->

                    <?php if ($index == 1) { ?>
                        <a class="nav-link active text-success" href="<?= base_url('administrasi') ?>">
                        <?php } else { ?>
                            <a class="nav-link" href="<?= base_url('administrasi') ?>">
                            <?php } ?>
                            <div class="nav-link-icon"><i data-feather="activity"></i></div>
                            Dashboards
                            </a>


                            <?php if ($index == 2) { ?>
                                <a class="nav-link active text-success" href="<?= base_url('administrasi/bonus') ?>">
                                <?php } else { ?>
                                    <a class="nav-link" href="<?= base_url('administrasi/bonus') ?>">
                                    <?php } ?>
                                    <div class="nav-link-icon"><i class="fa fa-trophy"></i></div>
                                    Bonus
                                    </a>
                                     <?php if ($index == 9) { ?>
                                    <a class="nav-link active text-success" href="<?= base_url('administrasi/absensi') ?>">
                                    <?php } else { ?>
                                        <a class="nav-link" href="<?= base_url('administrasi/absensi') ?>">
                                        <?php } ?>
                                        <div class="nav-link-icon"><i class="fa fa-calendar"></i></div>
                                        Absensi
                                        </a>

 
                               

                                                    <?php if ($index == 3) { ?>
                                                        <a class="nav-link active text-success" href="<?= base_url('administrasi/kriteria') ?>">
                                                        <?php } else { ?>
                                                            <a class="nav-link" href="<?= base_url('administrasi/kriteria') ?>">
                                                            <?php } ?>
                                                            <div class="nav-link-icon"><i class="fa fa-list"></i></div>
                                                            Kriteria
                                                            </a>

                                                     <?php if ($index == 4) { ?>
                                                        <a class="nav-link active text-success" href="<?= base_url('administrasi/indikator') ?>">
                                                        <?php } else { ?>
                                                            <a class="nav-link" href="<?= base_url('administrasi/indikator') ?>">
                                                            <?php } ?>
                                                            <div class="nav-link-icon"><i class="fa fa-list"></i></div>
                                                            Indikator
                                                            </a>




                                                            <div class="sidenav-menu-heading">Pengaturan</div>
                                                            <?php if ($index == 6) { ?>
                                                                <a class="nav-link active text-success" href="<?= base_url('administrasi/profil') ?>">
                                                                <?php } else { ?>
                                                                    <a class="nav-link" href="<?= base_url('administrasi/profil') ?>">
                                                                    <?php } ?>
                                                                    <div class="nav-link-icon"><i data-feather="settings"></i></div>
                                                                    Account
                                                                    </a>

                                                                    <a class="nav-link" href="<?= base_url('keluar') ?>">

                                                                        <div class="nav-link-icon"><i data-feather="log-out"></i></div>
                                                                        Logout
                                                                    </a>


                </div>
            </div>
            <!-- Sidenav Footer-->
            <div class="sidenav-footer">
                <div class="sidenav-footer-content">
                    <div class="sidenav-footer-subtitle">Logged in as:</div>
                    <div class="sidenav-footer-title"><?= $profil->email ?></div>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>