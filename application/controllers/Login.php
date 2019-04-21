<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('MMeeting');

	}

	public function index(){
		$data['email'] = $_POST['email'];
		$data['password'] = md5($_POST['password']);
		$data['verifikasi'] = '1';
		
		$cek_login = $this->MMeeting->cek_login($data);
		if (!isset($cek_login))	 {
			$this->session->set_flashdata('alert','gagal');
			redirect('frontend/login');
		}else{

			$datauser = array(
				'user_id' => $cek_login->user_id,
				'nama' => $cek_login->nama,
				'no_hp' => $cek_login->no_hp,
				'email' => $cek_login->email,
				'jenis_user' => $cek_login->jenis_user
			);

			

			$this->session->set_userdata($datauser);
			
			if ($cek_login->jenis_user == 0) {
				redirect('frontend');
			}elseif($cek_login->jenis_user == 1){
				echo "Pemilik usaha";
			}else{
				echo "Super Admin";
			}
		}

		


	}

	public function logout(){
		$this->session->sess_destroy();
		redirect ('frontend');
	}
}