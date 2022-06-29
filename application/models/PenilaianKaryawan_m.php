<?php 
class PenilaianKaryawan_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_penilaian';
    $this->data['table_name'] = 'penilaian_karyawan';
  }


  	public function get_nilai($kar, $kd, $k, $j){

  		$list_indikator = $this->Indikator_m->get(['id_kriteria' => $k, 'id_jabatan' =>$j]);

  		$total = 0;
  		$nilai = 0;
  		foreach ($list_indikator as $a) {
  			$total += $a->nilai_indikator;

  			if ($this->PenilaianKaryawan_m->get_num_row(['id_indikator' => $a->id_indikator, 'id_karyawan' => $kar, 'kd_bonus' => $kd]) == 0) { 
  			}else{
  			 
  				$nilai_karyawan = $this->PenilaianKaryawan_m->get_row(['id_indikator' => $a->id_indikator, 'id_karyawan' => $kar, 'kd_bonus' => $kd])->nilai;

  				$nilai += $nilai_karyawan;
  			}


  		}

  		$nilai_karyawan = ($nilai/$total) * 100;
 		
  	 

  		return $nilai_karyawan;
			
	}


}

 ?>
