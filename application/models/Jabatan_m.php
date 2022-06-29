<?php 
class Jabatan_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_jabatan';
    $this->data['table_name'] = 'jabatan';
  }
}

 ?>
