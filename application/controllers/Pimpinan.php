<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pimpinan extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role');
        if (!$this->data['email'] || ($this->data['id_role'] != 2)) {
            $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> Anda harus masuk terlebih dahulu', 'danger');
            redirect('masuk');
            exit;
        }

        $this->load->model('Pengguna_m');
        $this->load->model('Bobot_m');
        $this->load->model('Kriteria_m');
        $this->load->model('Karyawan_m');
        $this->load->model('Penilaian_m');
        $this->load->model('Bonus_m');
        $this->load->model('Laporan_m');
        $this->load->model('DLaporan_m');
        $this->load->model('Jabatan_m');
        $this->load->model('PenilaianKaryawan_m');
        $this->load->model('Indikator_m');
        $this->load->model('Absensi_m');
        $this->load->model('DAbsensi_m');

        $this->data['profil'] = $this->Pengguna_m->get_row(['email' => $this->data['email']]);

        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {

        //$saw = $this->Lokasi_m->saw();

        //$this->data['list_lokasi'] = $saw['hasil_akhir'];
        $this->data['title']  = 'Dashboard';
        $this->data['index'] = 1;
        $this->data['content'] = 'pimpinan/dashboard';
        $this->template($this->data, 'pimpinan');
    }

    public function spk()
    {

        $saw = $this->Lokasi_m->saw();

        $this->data['list_laptop'] = $saw['hasil_akhir'];
        $this->data['title']  = 'Hasil SPK. Metode SAW';
        $this->data['index'] = 1;
        $this->data['content'] = 'pimpinan/spk';
        $this->template($this->data, 'pimpinan');
    }

    public function detailspk()
    {

        $saw = $this->Lokasi_m->saw();

        $this->data['list_kriteria'] = $this->Kriteria_m->get();
        $this->data['nilai_awal'] = $saw['nilai_awal'];
        $this->data['matrik_r'] = $saw['matrik_r'];
        $this->data['list_lokasi'] = $saw['hasil'];
        $this->data['list_lokasi2'] = $saw['hasil_akhir'];
        $this->data['title']  = 'Detail Hasil SPK. Metode SAW';
        $this->data['index'] = 1;
        $this->data['content'] = 'pimpinan/detailspk';
        $this->template($this->data, 'pimpinan');
    }

    public function bonus()
    {


        if ($this->POST('simpanverifikasi')) {

            $list_karyawan = $this->Karyawan_m->get();
            $kd_bonus = $this->POST('kd_bonus');
            foreach ($list_karyawan as $kar) {
                if ($this->POST('laporan_'.$kar->id_karyawan)) {
                    $this->Laporan_m->update_where(['id_karyawan' => $kar->id_karyawan, 'kd_bonus' => $kd_bonus], ['status' => 1]);
                }else{
                    $this->Laporan_m->update_where(['id_karyawan' => $kar->id_karyawan, 'kd_bonus' => $kd_bonus], ['status' => 0]);
                }
            }

            $this->flashmsg('Data berhasil disimpan', 'success');
            redirect('pimpinan/bonus/' . $kd_bonus . '?konten=verifikasi');
            exit();
        }

         if ($this->POST('selesaiverifikasi')) {
 
            $kd_bonus = $this->POST('kd_bonus');
            $this->Bonus_m->update($kd_bonus, ['status' => 3]);

            $this->flashmsg('Pemberian bonus selesai', 'success');
            redirect('pimpinan/laporan/' . $kd_bonus);
            exit();
        }


        if ($this->uri->segment(3)) {
            $kd = $this->uri->segment(3);

            if ($this->Bonus_m->get_num_row(['kd_bonus' => $kd]) == 0) {
                $this->flashmsg('Data bonus tidak tersedia', 'warning');
                redirect('pimpinan/bonus');
                exit;
            }

            $this->data['bonus'] = $this->Bonus_m->get_row(['kd_bonus' => $kd]);
            $this->data['list_kriteria'] = $this->Kriteria_m->get();
            $this->data['list_karyawan'] = $this->Karyawan_m->get();
            $this->data['title']  = $this->data['bonus']->kd_bonus;
            $this->data['index'] = 2;
            $this->data['content'] = 'pimpinan/detailbonus';
            $this->template($this->data, 'pimpinan');
        } else {
            $this->data['list_bonus'] = $this->Bonus_m->get_by_order('tgl_buat', 'desc', ['status' => 2]);
            $this->data['title']  = 'Verifikasi Pemberian Bonus Karyawan';
            $this->data['index'] = 2;
            $this->data['content'] = 'pimpinan/bonus';
            $this->template($this->data, 'pimpinan');
        }
    }

    public function laporan()
    {

        if ($this->uri->segment(3)) {
            $kd = $this->uri->segment(3);

            if ($this->Bonus_m->get_num_row(['kd_bonus' => $kd]) == 0) {
                $this->flashmsg('Data bonus tidak tersedia', 'warning');
                redirect('pimpinan/bonus');
                exit;
            }

            $this->data['bonus'] = $this->Bonus_m->get_row(['kd_bonus' => $kd]);
            $this->data['list_kriteria'] = $this->Kriteria_m->get();
            $this->data['list_karyawan'] = $this->Karyawan_m->get();
            $this->data['title']  = $this->data['bonus']->kd_bonus;
            $this->data['index'] = 3;
            $this->data['content'] = 'pimpinan/detaillaporan';
            $this->template($this->data, 'pimpinan');
        } else {
            $this->data['list_bonus'] = $this->Bonus_m->get_by_order('tgl_buat', 'desc', ['status' => 3]);
            $this->data['title']  = 'Laporan Pemberian Bonus';
            $this->data['index'] = 3;
            $this->data['content'] = 'pimpinan/laporan';
            $this->template($this->data, 'pimpinan');
        }
    }


    public function penilaian()
    {
        if ($this->POST('input')) {
            $list_kriteria = $this->Kriteria_m->get();
            $kd_bonus = $this->POST('kd_bonus');
            $id_karyawan = $this->POST('id_karyawan');
            foreach ($list_kriteria as $v) {

                $d = $this->Bobot_m->get_row(['id_bobot' => $this->POST('kriteria_' . $v->id_kriteria)]);


                $data = [
                    'id_kriteria' => $v->id_kriteria,
                    'kd_bonus' => $kd_bonus,
                    'id_karyawan' => $id_karyawan,
                    'id_bobot' => $this->POST('kriteria_' . $v->id_kriteria),
                    'keterangan' => $d->keterangan
                ];
                $this->Penilaian_m->insert($data);
            }

            $this->flashmsg('NILAI BERHASIL DIINPUT!', 'success');
            redirect('pimpinan/bonus/' . $kd_bonus);
            exit();
        } elseif ($this->POST('edit')) {
            $list_kriteria = $this->Kriteria_m->get();
            $kd_bonus = $this->POST('kd_bonus');
            $id_karyawan = $this->POST('id_karyawan');
            $this->Penilaian_m->delete_by(['kd_bonus' => $kd_bonus, 'id_karyawan' => $id_karyawan]);

            foreach ($list_kriteria as $v) {

                $d = $this->Bobot_m->get_row(['id_bobot' => $this->POST('kriteria_' . $v->id_kriteria)]);

                $data = [
                    'id_kriteria' => $v->id_kriteria,
                    'kd_bonus' => $kd_bonus,
                    'id_karyawan' => $id_karyawan,
                    'id_bobot' => $this->POST('kriteria_' . $v->id_kriteria),
                    'keterangan' => $d->keterangan
                ];
                $this->Penilaian_m->insert($data);
            }

            $this->flashmsg('NILAI BERHASIL DIEDIT!', 'success');
            redirect('pimpinan/bonus/' . $kd_bonus);
            exit();
        } elseif ($this->POST('hapus')) {
            $kd_bonus = $this->POST('kd_bonus');
            $id_karyawan = $this->POST('id_karyawan');
            $this->Penilaian_m->delete_by(['kd_bonus' => $kd_bonus, 'id_karyawan' => $id_karyawan]);
            $this->flashmsg('NILAI BERHASIL DIHAPUS!', 'success');
            redirect('pimpinan/bonus/' . $kd_bonus);
            exit();
        } else {
            redirect('pimpinan/bonus');
            exit();
        }
    }


    public function pengguna()
    {

        if ($this->POST('tambah')) {

            if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0) {
                $this->flashmsg('Email telah digunakan!', 'warning');
                redirect('pimpinan/pengguna');
                exit();
            }

            $data = [
                'email' => $this->POST('email'),
                'password' => md5($this->POST('password')),
                'nama_lengkap' => $this->POST('nama_lengkap'),
                'jk' => $this->POST('jk'),
                'tanggal_lahir' => $this->POST('tanggal_lahir'),
                'no_telp' => $this->POST('no_telp'),
                'foto' => 'foto/default.jpg',
                'role' => $this->POST('role')
            ];
            $this->Pengguna_m->insert($data);
            $id = $this->db->insert_id();

            $this->flashmsg('Data Pengguna berhasil ditambah!', 'success');
            redirect('pimpinan/pengguna/' . $id);
            exit();
        } elseif ($this->POST('edit')) {

            if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) {
                $this->flashmsg('Email telah digunakan!', 'warning');
                redirect('pimpinan/pengguna/' . $this->POST('id_pengguna'));
                exit();
            }

            $data = [
                'email' => $this->POST('email'),
                'password' => md5($this->POST('password')),
                'nama_lengkap' => $this->POST('nama_lengkap'),
                'jk' => $this->POST('jk'),
                'tanggal_lahir' => $this->POST('tanggal_lahir'),
                'no_telp' => $this->POST('no_telp'),
                'foto' => 'foto/default.jpg',
                'role' => $this->POST('role')
            ];
            $this->Pengguna_m->update($this->POST('email'), $data);

            $this->flashmsg('Data Pengguna berhasil disimpan!', 'success');
            redirect('pimpinan/pengguna/' . $this->POST('id_pengguna'));
            exit();
        } elseif ($this->POST('uploadfoto')) {
            $profils = $this->Pengguna_m->get_row(['id_pengguna' => $this->POST('id_pengguna')]);

            if ($_FILES['foto']['name'] !== '') {
                $files = $_FILES['foto'];
                $_FILES['foto']['name'] = $files['name'];
                $_FILES['foto']['type'] = $files['type'];
                $_FILES['foto']['tmp_name'] = $files['tmp_name'];
                $_FILES['foto']['size'] = $files['size'];

                $id_foto = rand(1, 9);
                for ($j = 1; $j <= 6; $j++) {
                    $id_foto .= rand(0, 9);
                }

                if ($profils->foto != 'foto/default.jpg' && $profils->foto != 'foto/default-l.jpg' && $profils->foto != 'foto/default-p.jpg') {
                    @unlink(realpath(APPPATH . '../assets/' . $profils->foto));
                }
                $this->upload($id_foto, 'foto/', 'foto');
                $this->Pengguna_m->update($profils->email, ['foto' => 'foto/' . $id_foto . '.jpg']);
                $this->flashmsg('Foto Profil berhasil diupload!', 'success');


                redirect('pimpinan/pengguna/' . $this->POST('id_pengguna'));
                exit();
            } else {
                redirect('pimpinan/pengguna/' . $this->POST('id_pengguna'));
                exit();
            }
        } elseif ($this->POST('hapusfoto')) {
            $profils = $this->Pengguna_m->get_row(['id_pengguna' => $this->POST('id_pengguna')]);

            @unlink(realpath(APPPATH . '../assets/' . $profils->foto));
            $this->Pengguna_m->update($profils->email, ['foto' => 'foto/default.jpg']);
            $this->flashmsg('Foto Profil berhasil dihapus!', 'success');
            redirect('pimpinan/pengguna/' . $this->POST('id_pengguna'));
            exit();
        } elseif ($this->POST('edit2')) {
            $profils = $this->Pengguna_m->get_row(['id_pengguna' => $this->POST('id_pengguna')]);
            $data = [
                'password' => md5($this->POST('pass1'))
            ];

            $this->Pengguna_m->update($profils->email, $data);

            $this->flashmsg('Password baru telah tersimpan!', 'success');
            redirect('pimpinan/pengguna/' . $this->POST('id_pengguna'));
            exit();
        } elseif ($this->POST('hapus')) {
            $profils = $this->Pengguna_m->get_row(['id_pengguna' => $this->POST('id_pengguna')]);

            $this->Pengguna_m->delete($profils->email);
            $this->flashmsg('Data Pengguna berhasil dihapus!', 'success');
            redirect('pimpinan/pengguna/');
            exit();
        } else if ($this->uri->segment(3)) {

            if ($this->Pengguna_m->get_num_row(['id_pengguna' => $this->uri->segment(3)]) == 0) {
                $this->flashmsg('Data pengguna tidak ditemukan!', 'danger');
                redirect('pimpinan/pengguna');
                exit();
            }

            $this->data['pengguna'] = $this->Pengguna_m->get_row(['id_pengguna' => $this->uri->segment(3)]);
            $this->data['title']  = 'Detail Data Pengguna - ' . $this->data['pengguna']->nama_lengkap;
            $this->data['index'] = 5;
            $this->data['content'] = 'pimpinan/detailpengguna';
            $this->template($this->data, 'pimpinan');
        } else {
            $this->data['list_pengguna'] = $this->Pengguna_m->get(['email !=' => $this->data['email'], 'role !=' => 3]);
            $this->data['title']  = 'Kelola Data Pengguna';
            $this->data['index'] = 5;
            $this->data['content'] = 'pimpinan/pengguna';
            $this->template($this->data, 'pimpinan');
        }
    }

    public function profil()
    {

        $this->data['title']  = 'Account';
        $this->data['index'] = 6;
        $this->data['content'] = 'pimpinan/profil';
        $this->template($this->data, 'pimpinan');
    }

    public function proses_edit_profil()
    {
        if ($this->POST('edit')) {

            if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) {
                $this->flashmsg('Email telah digunakan!', 'warning');
                redirect('pimpinan/profil');
                exit();
            }

            $data = [
                'email' => $this->POST('email')
            ];

            $this->Pengguna_m->update($this->POST('email_x'), $data);


            $user_session = [
                'email' => $this->POST('email'),
            ];
            $this->session->set_userdata($user_session);


            $this->flashmsg('PROFIL BERHASIL DISIMPAN!', 'success');
            redirect('pimpinan/profil');
            exit();
        } elseif ($this->POST('uploadfoto')) {
            if ($_FILES['foto']['name'] !== '') {
                $files = $_FILES['foto'];
                $_FILES['foto']['name'] = $files['name'];
                $_FILES['foto']['type'] = $files['type'];
                $_FILES['foto']['tmp_name'] = $files['tmp_name'];
                $_FILES['foto']['size'] = $files['size'];

                $id_foto = rand(1, 9);
                for ($j = 1; $j <= 6; $j++) {
                    $id_foto .= rand(0, 9);
                }

                if ($this->data['profil']->foto != 'foto/default.jpg' && $this->data['profil']->foto != 'foto/default-l.jpg' && $this->data['profil']->foto != 'foto/default-p.jpg') {
                    @unlink(realpath(APPPATH . '../assets/' . $this->data['profil']->foto));
                }
                $this->upload($id_foto, 'foto/', 'foto');
                $this->Pengguna_m->update($this->data['profil']->email, ['foto' => 'foto/' . $id_foto . '.jpg']);
                $this->flashmsg('Foto Profil berhasil diupload!', 'success');
                redirect('pimpinan/profil');
                exit();
            } else {
                redirect('pimpinan/profil');
                exit();
            }
        } elseif ($this->POST('hapusfoto')) {

            @unlink(realpath(APPPATH . '../assets/' . $this->data['profil']->foto));
            $this->Pengguna_m->update($this->data['profil']->email, ['foto' => 'foto/default.jpg']);
            $this->flashmsg('Foto Profil berhasil dihapus!', 'success');
            redirect('pimpinan/profil');
            exit();
        } elseif ($this->POST('edit2')) {
            $data = [
                'password' => md5($this->POST('pass1'))
            ];

            $this->Pengguna_m->update($this->data['email'], $data);

            $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
            redirect('pimpinan/profil');
            exit();
        } else {

            redirect('pimpinan/profil');
            exit();
        }
    }



    public function cekpasslama()
    {
        echo $this->Pengguna_m->cekpasslama($this->data['email'], $this->input->post('pass'));
    }
    public function cekpass()
    {
    }
    public function cekpass2()
    {
        echo $this->Pengguna_m->cek_passwords($this->input->post('pass1'), $this->input->post('pass2'));
    }
}
