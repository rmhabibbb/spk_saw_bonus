<?php

class MY_Controller extends CI_Controller
{
	public $title = 'PMB KM UNSRI';
	public function __construct()
	{
		parent::__construct();
		// $this->load->library('lib_log');
	}

	public function template($data, $role = 'administrasi')
	{
		if ($role == 'administrasi') {
			return $this->load->view('administrasi/template/layout', $data);
		} elseif ($role == 'pimpinan') {
			return $this->load->view('pimpinan/template/layout', $data);
		} elseif ($role == 'adminsistem') {
			return $this->load->view('adminsistem/template/layout', $data);
		} elseif ($role == 'karyawan') {
			return $this->load->view('karyawan/template/layout', $data);
		}elseif ($role == 'landing') {
			return $this->load->view('landing/template/layout', $data);
		}
		return false;
	}

	public function POST($name)
	{
		return $this->input->post($name);
	}

	public function flashmsg($msg, $type = 'success', $name = 'msg')
	{
		return $this->session->set_flashdata($name, '<div class="alert alert-' . $type . ' alert-dismissable">' . $msg . '</div>');
	}

	public function upload($id, $directory, $tag_name = 'userfile')
	{
		if ($_FILES[$tag_name]) {
			$upload_path = realpath(APPPATH . '../assets/' . $directory . '/');
			@unlink($upload_path . '/' . $id . '.jpg');
			$config = [
				'file_name' 		=> $id . '.jpg',
				'allowed_types'		=> 'jpg|png|bmp|jpeg',
				'upload_path'		=> $upload_path
			];
			$this->load->library('upload');
			$this->upload->initialize($config);
			return $this->upload->do_upload($tag_name);
		}
		return FALSE;
	}

	public function dump($var)
	{
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
