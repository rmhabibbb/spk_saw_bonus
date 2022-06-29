<?php
class Penilaian_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_penilaian';
    $this->data['table_name'] = 'penilaian';
  }

   
  public function saw($kd_bonus)
  {
    $nilai_awal = array();
    $list_karyawan = $this->Karyawan_m->get();
    $list_kriteria = $this->Kriteria_m->get();



    foreach ($list_karyawan as $l) {

      $nilai = array();
      foreach ($list_kriteria as $k) {
        if ($this->Penilaian_m->get_num_row(['kd_bonus' => $kd_bonus, 'id_karyawan' => $l->id_karyawan, 'id_kriteria' => $k->id_kriteria]) != 0) {
          $id_bobot = $this->Penilaian_m->get_row(['kd_bonus' => $kd_bonus,'id_karyawan' => $l->id_karyawan, 'id_kriteria' => $k->id_kriteria])->id_bobot;
          array_push($nilai, $this->Bobot_m->get_row(['id_bobot' => $id_bobot])->bobot);
        } else {

          array_push($nilai, 0);
        }
      }
      $data = [
        'id_karyawan' => $l->id_karyawan,
        'nilai' => $nilai
      ];
      array_push($nilai_awal, $data);
    }

     

    $i = 0;
    $c_temp = array();
    foreach ($list_kriteria as $k) {
      array_push($c_temp,  $i++);
    }

    $i = 0;
    $j = 0;
    foreach ($list_kriteria as $k) {
      $d = array();
      foreach ($nilai_awal as $v) {

        array_push($d,  $v['nilai'][$i]);
      }
      $c_temp[$j] = $d;
      $i++;
      $j++;
    } 
    $R = array();
    foreach ($nilai_awal as $v) {
      $nilai = array();
      $idk = array();
      $i = 0;
      foreach ($list_kriteria as $k) {
        $d = 0;
        if ($k->tipe == 'Benefit') {
          if ($v['nilai'][$i] == 0) {
            $d = 0;
          } else {
            $d = number_format($v['nilai'][$i] / max($c_temp[$i]), 2);
          }
        } else { 
          if ($v['nilai'][$i] == 0) {
            $d = 0;
          } else {
            $d = min($c_temp[$i]) / $v['nilai'][$i]; 
          }
        }
        array_push($idk, $k->id_kriteria);
        array_push($nilai, $d);
        $i++;
      }
      $data = [
        'id_karyawan' => $v['id_karyawan'],
        'nilai' => $nilai,
        'kriteria' => $idk
      ];
      array_push($R, $data);
    }

 


    $bobot = array();

    foreach ($list_kriteria as $k) {
      array_push($bobot, ($k->bobot_vektor / 100));
    }


    $V = array();
    $i = 0;
    foreach ($R as $v) {
      $nilai_akhir = 0;
      for ($i = 0; $i < sizeof($bobot); $i++) {
        $nilai_akhir = $nilai_akhir + ($bobot[$i] * $v['nilai'][$i]);
      }
      $data = [
        'nilai_akhir' => number_format($nilai_akhir, 4),
        'id_karyawan' => $v['id_karyawan']
      ];

      array_push($V, $data);
    }


    $this->data['hasil'] = $V;
    rsort($V);
    $this->data['nilai_awal'] = $nilai_awal;
    $this->data['matrik_r'] = $R;
    $this->data['hasil_akhir'] = $V;
    return $this->data;
  }
}
