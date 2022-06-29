<?php 
class Indikator_m extends MY_Model
{

  function __construct()
  {
    parent::__construct();
    $this->data['primary_key'] = 'id_indikator';
    $this->data['table_name'] = 'indikator';
  }
}

 ?>
