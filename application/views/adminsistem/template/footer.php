                </main>
                <footer class="footer-admin mt-auto footer-light">
                    <div class="container-xl px-4">
                        <div class="row">
                            <div class="col-md-6 small">Copyright &copy; SPK . PENENTUAN PEMBERIAN BONUS KARYAWAN </div>
                            <div class="col-md-6 text-md-end small">
                                <a href="#!">Privacy Policy</a>
                                &middot;
                                <a href="#!">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
                </div>
                </div>
                <script src="<?= base_url(); ?>assets/jquery.min.js"></script>
                <script src="<?= base_url() ?>assets/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
                <script src="<?= base_url() ?>assets/dashboard/js/scripts.js"></script>
                <script src="<?= base_url() ?>assets/simple-datatables.js" crossorigin="anonymous"></script>
                <script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>" rel="stylesheet"></script>
                <script src="<?= base_url() ?>assets/dashboard/js/datatables/datatables-simple-demo.js"></script>
                <?php if ($index == 1) { ?>
                    <script>
                        window.setTimeout("waktu()", 1000);

                        function waktu() {
                            var waktu = new Date();
                            setTimeout("waktu()", 1000);
                            document.getElementById("jam").innerHTML = waktu.getHours();
                            document.getElementById("menit").innerHTML = waktu.getMinutes();
                            document.getElementById("detik").innerHTML = waktu.getSeconds();
                        }
                    </script>
                <?php  } ?>

                <script>
                    $(document).ready(function() {
                        $("#editform2").change(function() {

                            var pass = $("#passlama").val();
                            var pass1 = $("#pass1_ks").val();
                            var pass2 = $("#pass2_ks").val();
                            var cek1 = 1;
                            var cek2 = 1;
                            var cek3 = 1;

                            $.ajax({

                                url: "<?php echo base_url(); ?>admin/cekpasslama",
                                method: "post",
                                data: {
                                    pass
                                },
                                success: function(data) {
                                    if (data != "") {
                                        cek1 = 0;
                                        $('#pesan4_ks').html(data);
                                    } else {
                                        $('#pesan4_ks').html(data);
                                        cek1 = 1;
                                    }
                                    if (cek1 == 0 || cek2 == 0 || cek3 == 0) {
                                        $(':input[name="edit2"]').prop('disabled', true);
                                    } else {
                                        $(':input[name="edit2"]').prop('disabled', false);
                                    }
                                }
                            });


                            $.ajax({

                                url: "<?php echo base_url(); ?>admin/cekpass",
                                method: "post",
                                data: {
                                    pass1: pass1
                                },
                                success: function(data) {
                                    if (data != "") {
                                        cek2 = 0;
                                        $('#pesan2_ks').html(data);
                                    } else {
                                        $('#pesan2_ks').html(data);
                                        cek2 = 1;
                                    }
                                    if (cek1 == 0 || cek2 == 0 || cek3 == 0) {
                                        $(':input[name="edit2"]').prop('disabled', true);
                                    } else {
                                        $(':input[name="edit2"]').prop('disabled', false);
                                    }
                                }
                            });

                            $.ajax({

                                url: "<?php echo base_url(); ?>admin/cekpass2",
                                method: "post",
                                data: {
                                    pass1: pass1,
                                    pass2: pass2
                                },
                                success: function(data) {
                                    if (data != "") {
                                        cek3 = 0;
                                        $('#pesan3_ks').html(data);
                                    } else {
                                        $('#pesan3_ks').html(data);
                                        cek3 = 1;
                                    }
                                    if (cek1 == 0 || cek2 == 0 || cek3 == 0) {
                                        $(':input[name="edit2"]').prop('disabled', true);
                                    } else {
                                        $(':input[name="edit2"]').prop('disabled', false);
                                    }

                                }
                            });






                        });


                    });
                </script>
                <script>
                    // Replace the <textarea id="editor1"> with a CKEditor 4
                    // instance, using default configuration.
                    CKEDITOR.replace('editor1');
                    CKEDITOR.replace('editor2');
                </script>
                </body>

                </html>