<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">

                    <!-- Sidenav Menu Heading (Core)-->
                    <div class="sidenav-menu-heading"></div>
                    <!-- Sidenav Accordion (Dashboard)-->

                    <?php if ($index == 1) { ?>
                        <a class="nav-link active text-success" href="<?= base_url('adminsistem') ?>">
                        <?php } else { ?>
                            <a class="nav-link" href="<?= base_url('adminsistem') ?>">
                            <?php } ?>
                            <div class="nav-link-icon"><i data-feather="activity"></i></div>
                            Dashboards
                            </a>
 

                                    <div class="sidenav-menu-heading">Kelola Data</div>

                                    <?php if ($index == 5) { ?>
                                        <a class="nav-link active text-success" href="<?= base_url('adminsistem/pengguna') ?>">
                                        <?php } else { ?>
                                            <a class="nav-link" href="<?= base_url('adminsistem/pengguna') ?>">
                                            <?php } ?>
                                            <div class="nav-link-icon"><i class="fa fa-user"></i></div>
                                            Pengguna
                                            </a>
                                            <?php if ($index == 4) { ?>
                                                <a class="nav-link active text-success" href="<?= base_url('adminsistem/karyawan') ?>">
                                                <?php } else { ?>
                                                    <a class="nav-link" href="<?= base_url('adminsistem/karyawan') ?>">
                                                    <?php } ?>
                                                    <div class="nav-link-icon"><i class="fa fa-address-card "></i></div>
                                                    Karyawan
                                                    </a>

                                                    <?php if ($index == 3) { ?>
                                                        <a class="nav-link active text-success" href="<?= base_url('adminsistem/jabatan') ?>">
                                                        <?php } else { ?>
                                                            <a class="nav-link" href="<?= base_url('adminsistem/jabatan') ?>">
                                                            <?php } ?>
                                                            <div class="nav-link-icon"><i class="fa fa-address-book"></i></div>
                                                            Jabatan
                                                            </a>

                                                            <div class="sidenav-menu-heading">Pengaturan</div>
                                                            <?php if ($index == 6) { ?>
                                                                <a class="nav-link active text-success" href="<?= base_url('adminsistem/profil') ?>">
                                                                <?php } else { ?>
                                                                    <a class="nav-link" href="<?= base_url('adminsistem/profil') ?>">
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