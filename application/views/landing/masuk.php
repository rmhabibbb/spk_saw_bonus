                    <section class="bg-white py-15">
                      <div class="container">
                        <div class="text-center mb-5" data-aos="fade-down">
                          <h1 style="font-size: 40px">SPK . PENENTUAN PEMBERIAN BONUS KARYAWAN </h1>
                          <hr>
                          <h1 style="font-size:30px">Masuk</h1>
                        </div>
                        <form action="<?= base_url('masuk/cek') ?>" method="POST" data-aos="fade-up">
                          <div class="row justify-content-center">
                            <div class="col-xs-12 col-sm-4">
                              <?= $this->session->flashdata('msg') ?>
                              <div class="form-group">
                                <label>Email</label>
                                <div class="input-group">
                                  <input class="form-control" type="email" name="email" required value="<?php
                                                                                                        if (isset($_COOKIE['email_temp'])) {
                                                                                                          echo $_COOKIE['email_temp'];
                                                                                                        }
                                                                                                        ?>" <?php if (empty($_COOKIE['email_temp'])) {
                                                                                                              echo 'autofocus';
                                                                                                            } ?> pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$">

                                </div>
                              </div>
                              <div class="form-group">
                                <label>Password</label>
                                <div class="input-group" id="show_hide_password">
                                  <input class="form-control" type="password" name="password" id="myInput" required>
                                  <div class="input-group-addon">
                                    <a onclick="show()" class="form-control" id="icon"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                  </div>
                                </div>
                              </div>

                              <center>
                                <input type="submit" name="login" class="btn btn-block btn-success btn-marketing rounded-pill lift lift-sm my-3" value="Masuk">

                            </div>
                          </div>
                        </form>
                      </div>
                    </section>



                    <script type="text/javascript">
                      function show() {
                        var x = document.getElementById("myInput");
                        if (x.type === "password") {
                          x.type = "text";

                          $('#icon').html('<i class="fa fa-eye" aria-hidden="true"></i>');
                        } else {
                          x.type = "password";
                          $('#icon').html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
                        }
                      }
                    </script>