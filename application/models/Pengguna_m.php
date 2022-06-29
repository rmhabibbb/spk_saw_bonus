<?php

class Pengguna_m extends MY_Model{
	public function __construct(){
		parent::__construct();
		$this->data['table_name'] 	= 'pengguna';
    	$this->data['primary_key']	= 'email';
	}
	
	public function cek_login($email,$password){
		$user_data = $this->get_row(['email'=>$email]);
		if(isset($user_data)){
			if ($user_data->password == md5($password)) {

				 
				$user_session = [
					'email'	=> $user_data->email, 
					'id_role'	=> $user_data->role 
				];
				$this->session->set_userdata($user_session);
				return 2;
			}else {
				return 1;
			}
		}
		return 0;
	}



	public function cek_password_length($password)
        {

          $output = "";
          if (strlen($password) < 8 ) {
            $output .= '<div class="alert alert-danger alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Password Terlalu Pendek ! Minimal 8 Karakter</div>';
          }
          return $output;
        }
  
        
        public function cek_password($password,$confirm_password){
            return $password === $confirm_password;
        }
    
        
        public function cek_email($email)
	{
            $this->load->model('Voter_m');
            $check_email = $this->Voter_m->get(['email' => $email]);
            return count($check_email) > 0 ? FALSE : TRUE;
	}

	
}