<?php
$data = [
  'title' => $title,
  'index' => $index
];
$this->load->view('pimpinan/template/header', $data);
$this->load->view('pimpinan/template/navbar');
$this->load->view('pimpinan/template/sidebar', $data);
$this->load->view($content);
$this->load->view('pimpinan/template/footer');
