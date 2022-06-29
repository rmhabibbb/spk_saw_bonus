<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">

                    <!-- Sidenav Menu Heading (Core)-->
                    <div class="sidenav-menu-heading">Menu</div>
                    <!-- Sidenav Accordion (Dashboard)-->

                    <?php if ($index == 1) { ?>
                        <a class="nav-link active text-success" href="<?= base_url('pimpinan') ?>">
                        <?php } else { ?>
                            <a class="nav-link" href="<?= base_url('pimpinan') ?>">
                            <?php } ?>
                            <div class="nav-link-icon"><i data-feather="activity"></i></div>
                            Dashboards
                            </a>


                            <?php if ($index == 2) { ?>
                                <a class="nav-link active text-success" href="<?= base_url('pimpinan/bonus') ?>">
                                <?php } else { ?>
                                    <a class="nav-link" href="<?= base_url('pimpinan/bonus') ?>">
                                    <?php } ?>
                                    <div class="nav-link-icon"><i class="fa fa-trophy"></i></div>
                                    Verifikasi Pemberian Bonus
                                    </a>
                                    <?php if ($index == 3) { ?>
                                        <a class="nav-link active text-success" href="<?= base_url('pimpinan/laporan') ?>">
                                        <?php } else { ?>
                                            <a class="nav-link" href="<?= base_url('pimpinan/laporan') ?>">
                                            <?php } ?>
                                            <div class="nav-link-icon"><i class="fa fa-book"></i></div>
                                            Laporan Pemberian Bonus
                                            </a>


                                            <div class="sidenav-menu-heading">Pengaturan</div>
                                            <?php if ($index == 6) { ?>
                                                <a class="nav-link active text-success" href="<?= base_url('pimpinan/profil') ?>">
                                                <?php } else { ?>
                                                    <a class="nav-link" href="<?= base_url('pimpinan/profil') ?>">
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