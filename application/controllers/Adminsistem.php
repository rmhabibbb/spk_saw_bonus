<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Adminsistem extends MY_Controller
{

  function __construct()
  {
    parent::__construct();

    $this->data['email'] = $this->session->userdata('email');
    $this->data['id_role']  = $this->session->userdata('id_role');
    if (!$this->data['email'] || ($this->data['id_role'] != 0)) {
      $this->flashmsg('<i class="glyphicon glyphicon-remove"></i> Anda harus masuk terlebih dahulu', 'danger');
      redirect('masuk');
      exit;
    }

    $this->load->model('Pengguna_m'); 
    $this->load->model('Karyawan_m'); 
    $this->load->model('Jabatan_m'); 
    $this->load->model('Bonus_m');  
    $this->load->model('Kriteria_m');   

    $this->data['profil'] = $this->Pengguna_m->get_row(['email' => $this->data['email']]);

    date_default_timezone_set("Asia/Jakarta");
  }

  public function index()
  {

    $this->data['title']  = 'Dashboard';
    $this->data['index'] = 1;
    $this->data['content'] = 'adminsistem/dashboard';
    $this->template($this->data, 'adminsistem');
  }
 

  public function pengguna()
  {

    if ($this->POST('tambah')) {

      if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0) {
        $this->flashmsg('Email telah digunakan!', 'warning');
        redirect('adminsistem/pengguna');
        exit();
      }

      $data = [
        'email' => $this->POST('email'),
        'password' => md5($this->POST('password')),
        'role' => $this->POST('role')
      ];
      $this->Pengguna_m->insert($data);
      $id = $this->db->insert_id();

      $this->flashmsg('Data Pengguna berhasil ditambah!', 'success');
      redirect('adminsistem/pengguna/' . $id);
      exit();
    } elseif ($this->POST('edit')) {

      if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) {
        $this->flashmsg('Email telah digunakan!', 'warning');
        redirect('adminsistem/pengguna/' . $this->POST('id_pengguna'));
        exit();
      }

      $data = [
        'email' => $this->POST('email'),
        'role' => $this->POST('role')
      ];
      $this->Pengguna_m->update($this->POST('email_x'), $data);

      $this->flashmsg('Data Pengguna berhasil disimpan!', 'success');
      redirect('adminsistem/pengguna/' . $this->POST('id_pengguna'));
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


        redirect('adminsistem/pengguna/' . $this->POST('id_pengguna'));
        exit();
      } else {
        redirect('adminsistem/pengguna/' . $this->POST('id_pengguna'));
        exit();
      }
    } elseif ($this->POST('hapusfoto')) {
      $profils = $this->Pengguna_m->get_row(['id_pengguna' => $this->POST('id_pengguna')]);

      @unlink(realpath(APPPATH . '../assets/' . $profils->foto));
      $this->Pengguna_m->update($profils->email, ['foto' => 'foto/default.jpg']);
      $this->flashmsg('Foto Profil berhasil dihapus!', 'success');
      redirect('adminsistem/pengguna/' . $this->POST('id_pengguna'));
      exit();
    } elseif ($this->POST('edit2')) {
      $profils = $this->Pengguna_m->get_row(['id_pengguna' => $this->POST('id_pengguna')]);
      $data = [
        'password' => md5($this->POST('pass1'))
      ];

      $this->Pengguna_m->update($profils->email, $data);

      $this->flashmsg('Password baru telah tersimpan!', 'success');
      redirect('adminsistem/pengguna/' . $this->POST('id_pengguna'));
      exit();
    } elseif ($this->POST('hapus')) {
      $profils = $this->Pengguna_m->get_row(['id_pengguna' => $this->POST('id_pengguna')]);

      $this->Pengguna_m->delete($profils->email);
      $this->flashmsg('Data Pengguna berhasil dihapus!', 'success');
      redirect('adminsistem/pengguna/');
      exit();
    } else if ($this->uri->segment(3)) {

      if ($this->Pengguna_m->get_num_row(['id_pengguna' => $this->uri->segment(3)]) == 0) {
        $this->flashmsg('Data pengguna tidak ditemukan!', 'danger');
        redirect('adminsistem/pengguna');
        exit();
      }

      $this->data['pengguna'] = $this->Pengguna_m->get_row(['id_pengguna' => $this->uri->segment(3)]);
      $this->data['title']  = 'Detail Data Pengguna - ' . $this->data['pengguna']->email;
      $this->data['index'] = 5;
      $this->data['content'] = 'adminsistem/detailpengguna';
      $this->template($this->data, 'adminsistem');
    } else {
      $this->data['list_pengguna'] = $this->Pengguna_m->get(['email !=' => $this->data['email'],'role !=' => 3]);
      $this->data['title']  = 'Kelola Data Pengguna';
      $this->data['index'] = 5;
      $this->data['content'] = 'adminsistem/pengguna';
      $this->template($this->data, 'adminsistem');
    }
  }

  public function jabatan()
  {

    if ($this->POST('tambah')) {
 
      $data = [
        'nama_jabatan' => $this->POST('nama_jabatan') 
      ];
      $this->Jabatan_m->insert($data);
      $id = $this->db->insert_id();

      $this->flashmsg('Data jabatan berhasil ditambah!', 'success');
      redirect('adminsistem/jabatan/' . $id);
      exit();
    }elseif ($this->POST('edit')) {

      
      $data = [
        'nama_jabatan' => $this->POST('nama_jabatan') 
      ];
      $this->Jabatan_m->update($this->POST('id_jabatan'), $data);

      $this->flashmsg('Data jabatan berhasil disimpan!', 'success');
      redirect('adminsistem/jabatan/' . $this->POST('id_jabatan'));
      exit();
    } elseif ($this->POST('hapus')) {
      
      $this->Jabatan_m->delete($this->POST('id_jabatan'));
      $this->flashmsg('Data jabatan berhasil dihapus!', 'success');
      redirect('adminsistem/jabatan/');
      exit();
    } else if ($this->uri->segment(3)) {

      if ($this->Jabatan_m->get_num_row(['id_jabatan' => $this->uri->segment(3)]) == 0) {
        $this->flashmsg('Data jabatan tidak ditemukan!', 'danger');
        redirect('adminsistem/jabatan');
        exit();
      }

      $this->data['jabatan'] = $this->Jabatan_m->get_row(['id_jabatan' => $this->uri->segment(3)]);
      $this->data['title']  = 'Detail Data Jabatan - ' . $this->data['jabatan']->nama_jabatan;
      $this->data['index'] = 3;
      $this->data['content'] = 'adminsistem/detailjabatan';
      $this->template($this->data, 'adminsistem');
    } else {
      $this->data['list_jabatan'] = $this->Jabatan_m->get();
      $this->data['title']  = 'Kelola Data Jabatan';
      $this->data['index'] = 3;
      $this->data['content'] = 'adminsistem/jabatan';
      $this->template($this->data, 'adminsistem');
    }
  }


  public function karyawan()
  {

    if ($this->POST('tambah')) {

      if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0) {
        $this->flashmsg('Email telah digunakan!', 'warning');
        redirect('adminsistem/pengguna');
        exit();
      }

      $data = [
        'email' => $this->POST('email'),
        'password' => md5($this->POST('password')),
        'role' => 3
      ];
      if ($this->Pengguna_m->insert($data)) {
        $data = [
          'email' => $this->POST('email'),
          'nama_karyawan' => $this->POST('nama_lengkap'),
          'jk' => $this->POST('jk'),
          'id_jabatan' => $this->POST('id_jabatan'),
          'tanggal_lahir' => $this->POST('tanggal_lahir'),
          'no_hp' => $this->POST('no_telp'),
          'alamat' => $this->POST('alamat')
        ];

        $this->Karyawan_m->insert($data);
        $id = $this->db->insert_id();
        $this->flashmsg('Data Pengguna berhasil ditambah!', 'success');
        redirect('adminsistem/karyawan/' . $id);
        exit();
      } else {
        $this->flashmsg('Gagal!', 'warning');
        redirect('adminsistem/karyawan/');
        exit();
      }
    } elseif ($this->POST('edit')) {

      if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) {
        $this->flashmsg('Email telah digunakan!', 'warning');
        redirect('adminsistem/karyawan/' . $this->POST('id_karyawan'));
        exit();
      }

      $data = [
        'email' => $this->POST('email')
      ];
      $this->Pengguna_m->update($this->POST('email_x'), $data);
      $data = [
        'nama_karyawan' => $this->POST('nama_karyawan'),
        'jk' => $this->POST('jk'),
        'tanggal_lahir' => $this->POST('tanggal_lahir'),
        'id_jabatan' => $this->POST('id_jabatan'),
        'no_hp' => $this->POST('no_hp'),
        'alamat' => $this->POST('alamat')
      ];

      $this->Karyawan_m->update($this->POST('id_karyawan'), $data);
      $this->flashmsg('Data karyawan berhasil disimpan!', 'success');
      redirect('adminsistem/karyawan/' . $this->POST('id_karyawan'));
      exit();
    } elseif ($this->POST('hapus')) {
      $profils = $this->Karyawan_m->get_row(['id_karyawan' => $this->POST('id_karyawan')]);

      $this->Pengguna_m->delete($profils->email);
      $this->flashmsg('Data Karyawan berhasil dihapus!', 'success');
      redirect('adminsistem/karyawan/');
      exit();
    } else if ($this->uri->segment(3)) {

      if ($this->Karyawan_m->get_num_row(['id_karyawan' => $this->uri->segment(3)]) == 0) {
        $this->flashmsg('Data karyawan tidak ditemukan!', 'danger');
        redirect('adminsistem/karyawan');
        exit();
      }

      $this->data['karyawan'] = $this->Karyawan_m->get_row(['id_karyawan' => $this->uri->segment(3)]);
      $this->data['list_jabatan'] = $this->Jabatan_m->get();
      $this->data['title']  = 'Detail Data Karyawan - ' . $this->data['karyawan']->nama_karyawan;
      $this->data['index'] = 4;
      $this->data['content'] = 'adminsistem/detailkaryawan';
      $this->template($this->data, 'adminsistem');
    } else {
      $this->data['list_karyawan'] = $this->Karyawan_m->get();
      $this->data['list_jabatan'] = $this->Jabatan_m->get();
      $this->data['title']  = 'Kelola Data Karyawan';
      $this->data['index'] = 4;
      $this->data['content'] = 'adminsistem/karyawan';
      $this->template($this->data, 'adminsistem');
    }
  }


  public function downloadberkas()
  {
    $peserta = $this->CalonGuru_m->get_row(['id_calonguru' => $this->uri->segment(3)]);
    $data = glob('berkas/' . $peserta->id_calonguru . '_' . $peserta->kd_rekrutmen . '/*');

    $this->load->library('zip');
    foreach ($data as $d) {
      $this->zip->read_file($d);
    }

    $this->zip->download($peserta->kd_rekrutmen . '_' . $peserta->id_calonguru . '.zip');
  }

  public function profil()
  {

    $this->data['title']  = 'Account';
    $this->data['index'] = 6;
    $this->data['content'] = 'adminsistem/profil';
    $this->template($this->data, 'adminsistem');
  }

  public function proses_edit_profil()
  {
    if ($this->POST('edit')) {

      if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) {
        $this->flashmsg('Email telah digunakan!', 'warning');
        redirect('adminsistem/profil');
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
      redirect('adminsistem/profil');
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
        redirect('adminsistem/profil');
        exit();
      } else {
        redirect('adminsistem/profil');
        exit();
      }
    } elseif ($this->POST('hapusfoto')) {

      @unlink(realpath(APPPATH . '../assets/' . $this->data['profil']->foto));
      $this->Pengguna_m->update($this->data['profil']->email, ['foto' => 'foto/default.jpg']);
      $this->flashmsg('Foto Profil berhasil dihapus!', 'success');
      redirect('adminsistem/profil');
      exit();
    } elseif ($this->POST('edit2')) {
      $data = [
        'password' => md5($this->POST('pass1'))
      ];

      $this->Pengguna_m->update($this->data['email'], $data);

      $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
      redirect('adminsistem/profil');
      exit();
    } else {

      redirect('adminsistem/profil');
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
