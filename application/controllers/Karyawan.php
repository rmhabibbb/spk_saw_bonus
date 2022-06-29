<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->data['email'] = $this->session->userdata('email');
        $this->data['id_role']  = $this->session->userdata('id_role');
        if (!$this->data['email'] || ($this->data['id_role'] != 3)) {
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

        $this->data['profil'] = $this->Pengguna_m->get_row(['email' => $this->data['email']]);
        $this->data['kar'] = $this->Karyawan_m->get_row(['email' => $this->data['email']]);

        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {

        $this->data['list_laporan'] = $this->Laporan_m->get(['id_karyawan' => $this->data['kar']->id_karyawan]);
        $this->data['title']  = 'Dashboard';
        $this->data['index'] = 1;
        $this->data['content'] = 'karyawan/dashboard';
        $this->template($this->data, 'karyawan');
    }



    public function laporan()
    {

        if ($this->uri->segment(3)) {
            $kd = $this->uri->segment(3);

            if ($this->Bonus_m->get_num_row(['kd_bonus' => $kd]) == 0) {
                $this->flashmsg('Data bonus tidak tersedia', 'warning');
                redirect('karyawan/');
                exit;
            }

            $this->data['bonus'] = $this->Bonus_m->get_row(['kd_bonus' => $kd]);
            $this->data['laporan'] = $this->Laporan_m->get_row(['kd_bonus' => $kd, 'id_karyawan' => $this->data['kar']->id_karyawan]);
            $this->data['list_kriteria'] = $this->Kriteria_m->get(); 
            $this->data['title']  = $this->data['bonus']->kd_bonus;
            $this->data['index'] = 1;
            $this->data['content'] = 'karyawan/detaillaporan';
            $this->template($this->data, 'karyawan');
        } else {
           redirect('karyawan');
           exit();
        }
    }


    public function profil()
    {

        $this->data['title']  = 'Account';
        $this->data['index'] = 6;
        $this->data['content'] = 'karyawan/profil';
        $this->template($this->data, 'karyawan');
    }

    public function proses_edit_profil()
    {
        if ($this->POST('edit')) {

            if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) {
                $this->flashmsg('Email telah digunakan!', 'warning');
                redirect('karyawan/profil');
                exit();
            }
            $data = [
                'email' => $this->POST('email')
            ];
            $this->Pengguna_m->update($this->POST('email_x'), $data);
            $data = [
                'nama_karyawan' => $this->POST('nama_karyawan'),
                'jk' => $this->POST('jk'),
                'no_hp' => $this->POST('no_hp'),
                'alamat' => $this->POST('alamat'),
                'tanggal_lahir' => $this->POST('tanggal_lahir')
            ];

            $this->Karyawan_m->update($this->POST('id_karyawan'), $data);


            $user_session = [
                'email' => $this->POST('email'),
            ];
            $this->session->set_userdata($user_session);


            $this->flashmsg('PROFIL BERHASIL DISIMPAN!', 'success');
            redirect('karyawan/profil');
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
                redirect('karyawan/profil');
                exit();
            } else {
                redirect('karyawan/profil');
                exit();
            }
        } elseif ($this->POST('hapusfoto')) {

            @unlink(realpath(APPPATH . '../assets/' . $this->data['profil']->foto));
            $this->Pengguna_m->update($this->data['profil']->email, ['foto' => 'foto/default.jpg']);
            $this->flashmsg('Foto Profil berhasil dihapus!', 'success');
            redirect('karyawan/profil');
            exit();
        } elseif ($this->POST('edit2')) {
            $data = [
                'password' => md5($this->POST('pass1'))
            ];

            $this->Pengguna_m->update($this->data['email'], $data);

            $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
            redirect('karyawan/profil');
            exit();
        } else {

            redirect('karyawan/profil');
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
