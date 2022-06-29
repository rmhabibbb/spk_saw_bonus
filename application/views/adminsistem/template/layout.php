<?php
$data = [
  'title' => $title,
  'index' => $index
];
$this->load->view('adminsistem/template/header', $data);
$this->load->view('adminsistem/template/navbar');
$this->load->view('adminsistem/template/sidebar', $data);
$this->load->view($content);
$this->load->view('adminsistem/template/footer');
