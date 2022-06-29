<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Administrasi extends MY_Controller
{

  function __construct()
  {
    parent::__construct();

    $this->data['email'] = $this->session->userdata('email');
    $this->data['id_role']  = $this->session->userdata('id_role');
    if (!$this->data['email'] || ($this->data['id_role'] != 1)) {
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
    $this->load->model('Absensi_m');
    $this->load->model('DAbsensi_m');
    $this->load->model('Jabatan_m');
    $this->load->model('PenilaianKaryawan_m');
    $this->load->model('Indikator_m');

    $this->data['profil'] = $this->Pengguna_m->get_row(['email' => $this->data['email']]);

    date_default_timezone_set("Asia/Jakarta");
  }

  public function index()
  {

    $this->data['title']  = 'Dashboard';
    $this->data['index'] = 1;
    $this->data['content'] = 'administrasi/dashboard';
    $this->template($this->data, 'administrasi');
  }
 
  public function kriteria()
  {
    if ($this->POST('tambah')) {
      $data = [
        'nama_kriteria' => $this->POST('nama_kriteria'),
        'bobot_vektor' => $this->POST('bobot'),
        'hasIndikator' => $this->POST('hasIndikator'),
        'tipe' => $this->POST('tipe')
      ];
      $this->Kriteria_m->insert($data);
      $id = $this->db->insert_id();

      $this->flashmsg('KRITERA BERHASIL DITAMBAH!', 'success');
      redirect('administrasi/kriteria/' . $id);
      exit();
    }

    if ($this->POST('edit')) {
      $data = [
        'nama_kriteria' => $this->POST('nama_kriteria'),
        'bobot_vektor' => $this->POST('bobot'),
        'hasIndikator' => $this->POST('hasIndikator'),
        'tipe' => $this->POST('tipe')
      ];

      $this->Kriteria_m->update($this->POST('id_kriteria'), $data);

      $this->flashmsg('DATA BERHASIL TERSIMPAN!', 'success');
      redirect('administrasi/kriteria/' . $this->POST('id_kriteria'));
      exit();
    }

    if ($this->POST('hapus')) {
      $id_kriteria = $this->POST('id_kriteria');
      $this->Kriteria_m->delete($id_kriteria);
      $this->flashmsg('Kriteria berhasil dihapus!', 'success');
      redirect('administrasi/kriteria/');
      exit();
    }


    if ($this->uri->segment(3)) {
      if ($this->Kriteria_m->get_num_row(['id_kriteria' => $this->uri->segment(3)]) == 1) {
        $this->data['kriteria'] = $this->Kriteria_m->get_row(['id_kriteria' => $this->uri->segment(3)]);
        $this->data['list_sub'] = $this->Bobot_m->get(['id_kriteria' => $this->uri->segment(3)]);


        $this->data['title']  = 'Kelola Kriteria - ' . $this->data['kriteria']->nama_kriteria . '';
        $this->data['index'] = 3;
        $this->data['content'] = 'administrasi/detailkriteria';
        $this->template($this->data, 'administrasi');
      } else {
        redirect('sekretariat/kriteria');
        exit();
      }
    } else {
      $this->data['list_kriteria'] = $this->Kriteria_m->get();


      $this->data['title']  = 'Kelola Data Kriteria';
      $this->data['index'] = 3;
      $this->data['content'] = 'administrasi/kriteria';
      $this->template($this->data, 'administrasi');
    }
  }

  public function bobot()
  {
    if ($this->POST('tambah')) {
      $data = [
        'keterangan' => $this->POST('ket'),
        'bobot' => $this->POST('nilai'),
        'min' => $this->POST('min'),
        'max' => $this->POST('max'),
        'id_kriteria' => $this->POST('id_kriteria')
      ];
      $this->Bobot_m->insert($data);

      $this->flashmsg('BOBOT KRITERA BERHASIL DITAMBAH!', 'success');
      redirect('administrasi/kriteria/' . $this->POST('id_kriteria'));
      exit();
    }

    if ($this->POST('edit')) {
      $data = [
        'keterangan' => $this->POST('ket'),
        'bobot' => $this->POST('nilai'),
        'min' => $this->POST('min'),
        'max' => $this->POST('max'),
        'id_kriteria' => $this->POST('id_kriteria')
      ];

      $this->Bobot_m->update($this->POST('id_bobot'), $data);

      $this->flashmsg('DATA BERHASIL TERSIMPAN!', 'success');
      redirect('administrasi/kriteria/' . $this->POST('id_kriteria'));
      exit();
    }

    if ($this->POST('hapus')) {
      $this->Bobot_m->delete($this->POST('id_bobot'));
      $this->flashmsg('DATA BOBOT KRITERA BERHASIL DIHAPUS!', 'success');
      redirect('administrasi/kriteria/' . $this->POST('id_kriteria'));
      exit();
    }
  } 

  public function indikator()
  {
    if ($this->POST('tambah')) {
      $data = [
        'id_jabatan' => $this->POST('id_jabatan'),
        'nama_indikator' => $this->POST('nama_indikator'),
        'nilai_indikator' => $this->POST('nilai_indikator'),
        'id_kriteria' => $this->POST('id_kriteria')
      ];
      $this->Indikator_m->insert($data);

      $this->flashmsg('Indikator telah ditambah!', 'success');
      redirect('administrasi/indikator/');
      exit();
    }

    if ($this->POST('edit')) {
      $data = [
        'id_jabatan' => $this->POST('id_jabatan'),
        'nama_indikator' => $this->POST('nama_indikator'),
        'nilai_indikator' => $this->POST('nilai_indikator'),
        'id_kriteria' => $this->POST('id_kriteria')
      ];

      $this->Indikator_m->update($this->POST('id_indikator'), $data);

      $this->flashmsg('DATA BERHASIL TERSIMPAN!', 'success');
      redirect('administrasi/indikator/');
      exit();
    }

    if ($this->POST('hapus')) {
      $this->Indikator_m->delete($this->POST('id_indikator'));
      $this->flashmsg('DATA BOBOT KRITERA BERHASIL DIHAPUS!', 'success');
      redirect('administrasi/indikator/' );
      exit();
    }

    if ($this->uri->segment(3)) {
      redirect('administrasi/indikator');
        exit();
    } else {
      $this->data['list_kriteria'] = $this->Kriteria_m->get(['hasIndikator' => 1, 'id_kriteria !=' => 1]);
      $this->data['list_jabatan'] = $this->Jabatan_m->get();
      $this->data['list_indikator'] = $this->Indikator_m->get();


      $this->data['title']  = 'Kelola Data Indikator';
      $this->data['index'] = 4;
      $this->data['content'] = 'administrasi/indikator';
      $this->template($this->data, 'administrasi');
    }

  } 

  public function bonus()
  {

    if ($this->POST('tambah')) {

      $no = $this->Bonus_m->get_num_row(['bulan' => $this->POST('bulan'), 'tahun' => $this->POST('tahun')]) + 1;

      $kode = $this->POST('bulan') . $this->POST('tahun') . '-' . $no;

      $data = [
        'kd_bonus ' => $kode,
        'bulan' => $this->POST('bulan'),
        'tahun' => $this->POST('tahun'), 
        'tgl_buat' => date('Y-m-d H:i:s'),
        'status' => 1
      ];

      $this->Bonus_m->insert($data);
      $this->flashmsg('Data pemberian bonus berhasil ditambah!, silahkan lakukan penginputan nilai karyawan', 'success');
      redirect('administrasi/bonus/' . $kode);
      exit();
    }

    if ($this->POST('edit')) {


      $kode = $this->POST('kd_rekrutmen');

      $data = [
        'judul' => $this->POST('judul'),
        'buka' => $this->POST('buka'),
        'tutup' => $this->POST('tutup'), 
        'keterangan' => $this->POST('editor1'),
        'persyaratan' => $this->POST('editor2')
      ];

      $this->Rekrutmen_m->update($kode, $data);

      $status = $this->Rekrutmen_m->get_row(['kd_rekrutmen' => $kode])->status;
      $this->flashmsg('Data Rekrutmen berhasil disimpan', 'success');
      if ($status == 0) {
        redirect('administrasi/rekrutmen/' . $kode);
      } elseif ($status == 1) {
        redirect('administrasi/rekrutmen/' . $kode . '?konten=datarekrutmen');
      }

      exit();
    }



    if ($this->POST('selesai')) {


      $kode = $this->POST('kd_bonus');

      $bonus = $this->Bonus_m->get_row(['kd_bonus' => $kode]);
      $list_kriteria = $this->Kriteria_m->get();
      $list_karyawan = $this->Karyawan_m->get();

      $max_izin = 10;
      $max_sakit = 10;
      $max_tanpaket = 10;

      $nilai_sakit = 2;
      $nilai_izin = 3;
      $nilai_tanpaket = 5;

      $absen = $this->Absensi_m->get_row(['bulan' => $bonus->bulan,'tahun' => $bonus->tahun]);
      $list_bobot = $this->Bobot_m->get(['id_kriteria' => 1]);
      foreach ($list_karyawan as $kar) {
        $poin = 0;

        if ($this->DAbsensi_m->get_num_row(['id_absensi' => $absen->id_absensi,'id_karyawan' => $kar->id_karyawan]) != 0) {
          
          $dt = $this->DAbsensi_m->get_row(['id_absensi' => $absen->id_absensi,'id_karyawan' => $kar->id_karyawan]);

          $pi = $dt->izin * $nilai_izin;
          $ps = $dt->sakit * $nilai_sakit;
          $pt = $dt->tanpa_ket * $nilai_tanpaket;

          if ($pi > $max_izin) {
            $pi = $max_izin;
          }
          if ($ps > $max_sakit) {
            $ps = $max_sakit;
          }
          if ($pt > $max_tanpaket) {
            $pt = $max_tanpaket;
          }

          $poin = ($pi + $pt + $ps)/ ($max_izin + $max_sakit + $max_tanpaket);
          $poin = $poin * 100;
          echo $poin . "<br>";
          foreach ($list_bobot as $b) {
              if ($b->max >= $poin && $b->min <= $poin) {
                  $data = [
                      'id_kriteria' => 1,
                      'kd_bonus' => $kode,
                      'id_karyawan' => $kar->id_karyawan,
                      'id_bobot' => $b->id_bobot,
                      'keterangan' => '<b>'.  number_format($poin,2) . '</b>   ['.  number_format($b->min,0) . ' - ' . number_format($b->max,0).']'
                  ];
                 $this->Penilaian_m->insert($data);
              }
            }



        }else{
          $poin = 0;
          foreach ($list_bobot as $b) {
              if ($b->max >= $poin && $b->min <= $poin) {
                  $data = [
                      'id_kriteria' => 1,
                      'kd_bonus' => $kode,
                      'id_karyawan' => $kar->id_karyawan,
                      'id_bobot' => $b->id_bobot,
                      'keterangan' => '<b>'.  number_format($poin,2) . '</b>   ['.  number_format($b->min,0) . ' - ' . number_format($b->max,0).']'
                  ];
                 $this->Penilaian_m->insert($data);
              }
            }
        }
      }

      


      $spk = $this->Penilaian_m->saw($kode);
 

      $i = 1;
      foreach ($spk['hasil_akhir'] as $s) {
        
        $i++;
        $data = [
          'id_karyawan' => $s['id_karyawan'],
          'kd_bonus' => $kode,
          'nilai_akhir' => $s['nilai_akhir'],
          'status' => 0,
        ];

        $this->Laporan_m->insert($data);
      }


      foreach ($spk['matrik_r'] as $s) {
        $i = 0;
        $id_laporan = $this->Laporan_m->get_row(['kd_bonus' => $kode, 'id_karyawan' => $s['id_karyawan']])->id_laporan;
        $karyawan = $this->Karyawan_m->get_row(['id_karyawan' => $s['id_karyawan']]);
        foreach ($s['kriteria'] as $r) {
          $kriteria = $this->Kriteria_m->get_row(['id_kriteria' => $r]);

          $list_indikator = $this->Indikator_m->get(['id_kriteria' => $kriteria->id_kriteria, 'id_jabatan' => $karyawan->id_jabatan]);

          $ket = '';


          if ($kriteria->hasIndikator  == 1) {  
            if ($kriteria->id_kriteria != 1) {
             
              $ket_header = '<table class="table table-bordered">
                                <tr>
                                    <th colspan="2"><center>Indikator Kriteria</center></th> 
                                </tr>';
              $ket_body = '';

              $ket_footer = '  </table>';

                
                foreach ($list_indikator as $ind) { 
                  if($this->PenilaianKaryawan_m->get_num_row(['id_karyawan' => $karyawan->id_karyawan, 'id_indikator' => $ind->id_indikator, 'kd_bonus' => $bonus->kd_bonus]) != 0) {  
                    $check = '<div class="badge bg-success text-white rounded-pill"><i class="fa fa-check-circle" aria-hidden="true"></i>';
                  }else{
                    $check = '<div class="badge bg-danger text-white rounded-pill"><i class="fa fa-times-circle" aria-hidden="true"></i>';
                  }
                  $ket_body = $ket_body . '
                          <tr>
                              <td>'. $ind->nama_indikator. '</td>
                              <td style="width: 20%; text-align: center;"> '
                              .$check.
                              '</td>
                          </tr>';
                } 
              

              $ket = $ket_header . '<br>' . $ket_body . '<br>' . $ket_footer ;

            }else{
              
                  $absen = $this->Absensi_m->get_row(['bulan' => $bonus->bulan, 'tahun' => $bonus->tahun]);

                  if ($this->DAbsensi_m->get_num_row(['id_absensi' => $absen->id_absensi, 'id_karyawan' => $karyawan->id_karyawan]) == 0) {
                      $ket = $ket . 'Tidak ada data';
                  }else{
                      $dt = $this->DAbsensi_m->get_row(['id_absensi' => $absen->id_absensi, 'id_karyawan' => $karyawan->id_karyawan]);
                       $ket = $ket . "Izin : " . $dt->izin . "<br>";
                       $ket = $ket . "Sakit : " . $dt->sakit . "<br>";
                       $ket = $ket . "Tanpa Keterangan : " . $dt->tanpa_ket . "<br>";
                  } 
                                                
            }
          }else{
            $ket = $ket.  'Tidak ada indikator kriteria';
          }
          $data = [
            'kriteria' => $kriteria->nama_kriteria,
            'id_laporan' => $id_laporan,
            'presentase' => $kriteria->bobot_vektor,
            'nilai' => $s['nilai'][$i],
            'keterangan' => $ket
          ];
          $this->DLaporan_m->insert($data);
          $i++;
        }

        $data = [
          'status' => 2
        ];

        $this->Bonus_m->update($kode, $data);
      }


      $this->flashmsg('Penilaian karyawan selesai, menunggu verifikasi pimpinan', 'success');
      redirect('administrasi/bonus/' . $kode);
      exit();
    }

    if ($this->POST('hapus')) {


      $kode = $this->POST('kd_rekrutmen');

      $this->Rekrutmen_m->delete($kode);



      $this->flashmsg('Data Rekrutmen berhasil dihapus', 'success');
      redirect('administrasi/rekrutmen/');
      exit();
    }

    if ($this->POST('simpannilai')) {


      $karyawan = $this->Karyawan_m->get_row(['id_karyawan' => $this->POST('id_karyawan')]);
      $jabatan = $this->Jabatan_m->get_row(['id_jabatan' => $karyawan->id_jabatan]);
      $kd_bonus = $this->POST('kd_bonus');

      $list_kriteria = $this->Kriteria_m->get();

      foreach ($list_kriteria as $k) {
        if ($k->hasIndikator == 0) {
          if ($this->POST('kriteria_'.$k->id_kriteria)) {
            if ($this->Penilaian_m->get_num_row(['kd_bonus' => $kd_bonus, 'id_kriteria' => $k->id_kriteria,'id_karyawan' => $karyawan->id_karyawan]) == 0) {
                $d = $this->Bobot_m->get_row(['id_bobot' => $this->POST('kriteria_' . $k->id_kriteria)]);


                $data = [
                    'id_kriteria' => $k->id_kriteria,
                    'kd_bonus' => $kd_bonus,
                    'id_karyawan' => $karyawan->id_karyawan,
                    'id_bobot' => $this->POST('kriteria_' . $k->id_kriteria),
                    'keterangan' => $d->keterangan
                ];
                $this->Penilaian_m->insert($data);

               
            }else{
              $datanilai = $this->Penilaian_m->get_row(['kd_bonus' => $kd_bonus, 'id_kriteria' => $k->id_kriteria,'id_karyawan' => $karyawan->id_karyawan]);
              $d = $this->Bobot_m->get_row(['id_bobot' => $this->POST('kriteria_' . $k->id_kriteria)]);

                $data = [
                    'id_kriteria' => $k->id_kriteria,
                    'kd_bonus' => $kd_bonus,
                    'id_karyawan' => $karyawan->id_karyawan,
                    'id_bobot' => $this->POST('kriteria_' . $k->id_kriteria),
                    'keterangan' => $d->keterangan
                ];
                $this->Penilaian_m->update($datanilai->id_penilaian,$data);
               
            }
          }
        }else{
          $list_indikator = $this->Indikator_m->get(['id_jabatan' => $jabatan->id_jabatan, 'id_kriteria' => $k->id_kriteria]);
                
           foreach ($list_indikator as $ind) { 
            if ($this->POST('indikator_'.$ind->id_indikator)) {



              if ($this->PenilaianKaryawan_m->get_num_row(['kd_bonus' => $kd_bonus,'id_karyawan' => $karyawan->id_karyawan,'id_indikator' => $ind->id_indikator]) == 0) {
                
                $data = [
                  'kd_bonus' => $kd_bonus,
                  'id_karyawan' => $karyawan->id_karyawan,
                  'id_indikator' => $ind->id_indikator,
                  'nilai' => $ind->nilai_indikator
                ];

                $this->PenilaianKaryawan_m->insert($data); 

              }
            }else{

              $this->PenilaianKaryawan_m->delete_by(['kd_bonus' => $kd_bonus,'id_karyawan' => $karyawan->id_karyawan,'id_indikator' => $ind->id_indikator]);

            }
          } 

          $nilai_indikator = $this->PenilaianKaryawan_m->get_nilai($karyawan->id_karyawan,$kd_bonus,$k->id_kriteria,$jabatan->id_jabatan);

          $list_bobot = $this->Bobot_m->get(['id_kriteria' => $k->id_kriteria]);
          $this->Penilaian_m->delete_by(['id_karyawan' => $karyawan->id_karyawan, 'kd_bonus' => $kd_bonus, 'id_kriteria' => $k->id_kriteria]);

          foreach ($list_bobot as $b) {
            if ($b->max >= $nilai_indikator && $b->min <= $nilai_indikator) {
                $data = [
                    'id_kriteria' => $k->id_kriteria,
                    'kd_bonus' => $kd_bonus,
                    'id_karyawan' => $karyawan->id_karyawan,
                    'id_bobot' => $b->id_bobot,
                    'keterangan' => '<b>'.  number_format($nilai_indikator,2) . '</b>   ['.  number_format($b->min,0) . ' - ' . number_format($b->max,0).']'
                ];
                $this->Penilaian_m->insert($data);
            }
          }


        }
      }

        
       $this->flashmsg('Nilai berhasil disimpan!', 'success');
       redirect('administrasi/bonus/' . $kd_bonus.'?konten=penilaian&id_karyawan='.$karyawan->id_karyawan);
                exit();
    }

    if ($this->uri->segment(3)) {
      $kd = $this->uri->segment(3);

      if ($this->Bonus_m->get_num_row(['kd_bonus' => $kd]) == 0) {
        $this->flashmsg('Data bonus tidak tersedia', 'warning');
        redirect('administrasi/bonus');
        exit;
      }



      $this->data['bonus'] = $this->Bonus_m->get_row(['kd_bonus' => $kd]);
      $spk = $this->Penilaian_m->saw($this->data['bonus']->kd_bonus);
      $this->data['list_karyawan'] = $this->Karyawan_m->get();
      $this->data['list_kriteria'] = $this->Kriteria_m->get();
      $this->data['title']  = $this->data['bonus']->kd_bonus;
      $this->data['index'] = 2;
      $this->data['content'] = 'administrasi/detailbonus';
      $this->template($this->data, 'administrasi');
    } else {
      $this->data['list_bonus'] = $this->Bonus_m->get_by_order('tgl_buat', 'desc', []);
      $this->data['title']  = 'Data Pemberian Bonus';
      $this->data['index'] = 2;
      $this->data['content'] = 'administrasi/bonus';
      $this->template($this->data, 'administrasi');
    }
  }

  public function absensi()
  {

    if ($this->POST('tambah')) {

      $no = $this->Absensi_m->get_num_row(['bulan' => $this->POST('bulan'), 'tahun' => $this->POST('tahun')]);


      if ($no != 0) {
        $absensi = $this->Absensi_m->get_row(['bulan' => $this->POST('bulan'), 'tahun' => $this->POST('tahun')]);
        $this->flashmsg('Data absensi telah tersedia, silahkan edit', 'warning');
        redirect('administrasi/absensi/' . $absensi->id_absensi);
        exit();
      }

 

      $data = [ 
        'bulan' => $this->POST('bulan'),
        'tahun' => $this->POST('tahun'), 
        'tgl_buat' => date('Y-m-d H:i:s') 
      ];

      $id = $this->db->insert_id();

      $this->Absensi_m->insert($data);
      $this->flashmsg('Data absensi telah dibuat, silahkan isi absensi karyawan', 'success');
      redirect('administrasi/absensi/' . $id);
      exit();
    }elseif ($this->POST('tambah_data')) {

       
      $data = [ 
        'id_absensi' => $this->POST('id_absensi'),
        'id_karyawan' => $this->POST('id_karyawan'),
        'izin' => $this->POST('izin'),  
        'sakit' => $this->POST('sakit'),  
        'tanpa_ket' => $this->POST('tanpa_ket')
      ];

      $this->DAbsensi_m->insert($data);
      $id = $this->db->insert_id();

      $this->flashmsg('Data absensi karyawan berhasil ditambah', 'success');
      redirect('administrasi/absensi/' . $this->POST('id_absensi'));
      exit();
    }elseif ($this->POST('edit_data')) {

       
      $data = [  
        'izin' => $this->POST('izin'),  
        'sakit' => $this->POST('sakit'),  
        'tanpa_ket' => $this->POST('tanpa_ket')
      ];
 
      $this->DAbsensi_m->update($this->POST('id'), $data);
      $this->flashmsg('Data absensi karyawan berhasil disimpan', 'success');
      redirect('administrasi/absensi/' . $this->POST('id_absensi'));
      exit();
    }elseif ($this->POST('hapus_data')) {
 
      $this->DAbsensi_m->delete($this->POST('id'));
      $this->flashmsg('Data absensi karyawan berhasil dihapus', 'success');
      redirect('administrasi/absensi/' . $this->POST('id_absensi'));
      exit();
    }

    elseif ($this->POST('edit')) {

       
      exit();
    } elseif ($this->POST('hapus')) { 
 
      exit();
    } else if ($this->uri->segment(3)) {

      if ($this->Absensi_m->get_num_row(['id_absensi' => $this->uri->segment(3)]) == 0) {
        $this->flashmsg('Data absensi tidak ditemukan!', 'danger');
        redirect('administrasi/pengguna');
        exit();
      }

      $this->data['absensi'] = $this->Absensi_m->get_row(['id_absensi' => $this->uri->segment(3)]);
      $this->data['list_absensi'] = $this->DAbsensi_m->get(['id_absensi' => $this->uri->segment(3)]);
      $this->data['list_karyawan'] = $this->Karyawan_m->get();

      $this->data['title']  = 'Detail Data Absensi - ' . $this->data['absensi']->id_absensi;
      $this->data['index'] = 9;
      $this->data['content'] = 'administrasi/detailabsensi';
      $this->template($this->data, 'administrasi');
    } else {
      $this->data['list_absensi'] = $this->Absensi_m->get();
      $this->data['title']  = 'Kelola Data Absensi';
      $this->data['index'] = 9;
      $this->data['content'] = 'administrasi/absensi';
      $this->template($this->data, 'administrasi');
    }
  }

  public function pengguna()
  {

    if ($this->POST('tambah')) {

      if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0) {
        $this->flashmsg('Email telah digunakan!', 'warning');
        redirect('administrasi/pengguna');
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
      redirect('administrasi/pengguna/' . $id);
      exit();
    } elseif ($this->POST('edit')) {

      if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) {
        $this->flashmsg('Email telah digunakan!', 'warning');
        redirect('administrasi/pengguna/' . $this->POST('id_pengguna'));
        exit();
      }

      $data = [
        'email' => $this->POST('email'),
        'role' => $this->POST('role')
      ];
      $this->Pengguna_m->update($this->POST('email_x'), $data);

      $this->flashmsg('Data Pengguna berhasil disimpan!', 'success');
      redirect('administrasi/pengguna/' . $this->POST('id_pengguna'));
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


        redirect('administrasi/pengguna/' . $this->POST('id_pengguna'));
        exit();
      } else {
        redirect('administrasi/pengguna/' . $this->POST('id_pengguna'));
        exit();
      }
    } elseif ($this->POST('hapusfoto')) {
      $profils = $this->Pengguna_m->get_row(['id_pengguna' => $this->POST('id_pengguna')]);

      @unlink(realpath(APPPATH . '../assets/' . $profils->foto));
      $this->Pengguna_m->update($profils->email, ['foto' => 'foto/default.jpg']);
      $this->flashmsg('Foto Profil berhasil dihapus!', 'success');
      redirect('administrasi/pengguna/' . $this->POST('id_pengguna'));
      exit();
    } elseif ($this->POST('edit2')) {
      $profils = $this->Pengguna_m->get_row(['id_pengguna' => $this->POST('id_pengguna')]);
      $data = [
        'password' => md5($this->POST('pass1'))
      ];

      $this->Pengguna_m->update($profils->email, $data);

      $this->flashmsg('Password baru telah tersimpan!', 'success');
      redirect('administrasi/pengguna/' . $this->POST('id_pengguna'));
      exit();
    } elseif ($this->POST('hapus')) {
      $profils = $this->Pengguna_m->get_row(['id_pengguna' => $this->POST('id_pengguna')]);

      $this->Pengguna_m->delete($profils->email);
      $this->flashmsg('Data Pengguna berhasil dihapus!', 'success');
      redirect('administrasi/pengguna/');
      exit();
    } else if ($this->uri->segment(3)) {

      if ($this->Pengguna_m->get_num_row(['id_pengguna' => $this->uri->segment(3)]) == 0) {
        $this->flashmsg('Data pengguna tidak ditemukan!', 'danger');
        redirect('administrasi/pengguna');
        exit();
      }

      $this->data['pengguna'] = $this->Pengguna_m->get_row(['id_pengguna' => $this->uri->segment(3)]);
      $this->data['title']  = 'Detail Data Pengguna - ' . $this->data['pengguna']->email;
      $this->data['index'] = 5;
      $this->data['content'] = 'administrasi/detailpengguna';
      $this->template($this->data, 'administrasi');
    } else {
      $this->data['list_pengguna'] = $this->Pengguna_m->get(['email !=' => $this->data['email'],'role !=' => 3]);
      $this->data['title']  = 'Kelola Data Pengguna';
      $this->data['index'] = 5;
      $this->data['content'] = 'administrasi/pengguna';
      $this->template($this->data, 'administrasi');
    }
  }


  public function karyawan()
  {

    if ($this->POST('tambah')) {

      if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0) {
        $this->flashmsg('Email telah digunakan!', 'warning');
        redirect('administrasi/pengguna');
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
          'tanggal_lahir' => $this->POST('tanggal_lahir'),
          'no_hp' => $this->POST('no_telp'),
          'alamat' => $this->POST('alamat')
        ];

        $this->Karyawan_m->insert($data);
        $id = $this->db->insert_id();
        $this->flashmsg('Data Pengguna berhasil ditambah!', 'success');
        redirect('administrasi/karyawan/' . $id);
        exit();
      } else {
        $this->flashmsg('Gagal!', 'warning');
        redirect('administrasi/karyawan/');
        exit();
      }
    } elseif ($this->POST('edit')) {

      if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) {
        $this->flashmsg('Email telah digunakan!', 'warning');
        redirect('administrasi/karyawan/' . $this->POST('id_karyawan'));
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
        'no_hp' => $this->POST('no_hp'),
        'alamat' => $this->POST('alamat')
      ];

      $this->Karyawan_m->update($this->POST('id_karyawan'), $data);
      $this->flashmsg('Data karyawan berhasil disimpan!', 'success');
      redirect('administrasi/karyawan/' . $this->POST('id_karyawan'));
      exit();
    } elseif ($this->POST('hapus')) {
      $profils = $this->Karyawan_m->get_row(['id_karyawan' => $this->POST('id_karyawan')]);

      $this->Pengguna_m->delete($profils->email);
      $this->flashmsg('Data Karyawan berhasil dihapus!', 'success');
      redirect('administrasi/karyawan/');
      exit();
    } else if ($this->uri->segment(3)) {

      if ($this->Karyawan_m->get_num_row(['id_karyawan' => $this->uri->segment(3)]) == 0) {
        $this->flashmsg('Data karyawan tidak ditemukan!', 'danger');
        redirect('administrasi/karyawan');
        exit();
      }

      $this->data['karyawan'] = $this->Karyawan_m->get_row(['id_karyawan' => $this->uri->segment(3)]);
      $this->data['title']  = 'Detail Data Karyawan - ' . $this->data['karyawan']->nama_karyawan;
      $this->data['index'] = 4;
      $this->data['content'] = 'administrasi/detailkaryawan';
      $this->template($this->data, 'administrasi');
    } else {
      $this->data['list_karyawan'] = $this->Karyawan_m->get();
      $this->data['title']  = 'Kelola Data Karyawan';
      $this->data['index'] = 4;
      $this->data['content'] = 'administrasi/karyawan';
      $this->template($this->data, 'administrasi');
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
    $this->data['content'] = 'administrasi/profil';
    $this->template($this->data, 'administrasi');
  }

  public function proses_edit_profil()
  {
    if ($this->POST('edit')) {

      if ($this->Pengguna_m->get_num_row(['email' => $this->POST('email')]) != 0 && $this->POST('email') != $this->POST('email_x')) {
        $this->flashmsg('Email telah digunakan!', 'warning');
        redirect('administrasi/profil');
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
      redirect('administrasi/profil');
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
        redirect('administrasi/profil');
        exit();
      } else {
        redirect('administrasi/profil');
        exit();
      }
    } elseif ($this->POST('hapusfoto')) {

      @unlink(realpath(APPPATH . '../assets/' . $this->data['profil']->foto));
      $this->Pengguna_m->update($this->data['profil']->email, ['foto' => 'foto/default.jpg']);
      $this->flashmsg('Foto Profil berhasil dihapus!', 'success');
      redirect('administrasi/profil');
      exit();
    } elseif ($this->POST('edit2')) {
      $data = [
        'password' => md5($this->POST('pass1'))
      ];

      $this->Pengguna_m->update($this->data['email'], $data);

      $this->flashmsg('PASSWORD BARU TELAH TERSIMPAN!', 'success');
      redirect('administrasi/profil');
      exit();
    } else {

      redirect('administrasi/profil');
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
