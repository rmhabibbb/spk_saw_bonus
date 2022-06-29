<?php
$data = [
  'title' => $title,
  'index' => $index
];
$this->load->view('administrasi/template/header', $data);
$this->load->view('administrasi/template/navbar');
$this->load->view('administrasi/template/sidebar', $data);
$this->load->view($content);
$this->load->view('administrasi/template/footer');
