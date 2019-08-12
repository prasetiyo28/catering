<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('MCatering');

	}

	public function index()
	{
		$this->load->view('login');
	}

	


	public function login(){
		$data['email'] = $_POST['email'];
		$data['password'] = md5($_POST['password']);
		$data['verifikasi'] = '1';
		
		$cek_login = $this->MCatering->cek_login($data);
		if (!isset($cek_login))	 {
			$this->session->set_flashdata('alert','gagal');
			redirect('login');
		}else{

			$datauser = array(
				'user_id' => $cek_login->id_user,
				'nama' => $cek_login->nama,
				'no_hp' => $cek_login->no_hp,
				'email' => $cek_login->email,
				'jenis_user' => $cek_login->jenis_user
			);

			

			$this->session->set_userdata($datauser);
			
			if ($cek_login->jenis_user == 0) {
				redirect('frontend');
			}elseif($cek_login->jenis_user == 1){
				$cek_mitra = $this->MCatering->get_mitra($cek_login->id_user);
				if (!empty($cek_mitra)) {
					$datauser2 = array(
						'id_mitra' => $cek_mitra->id_mitra,
						'nama_mitra' => $cek_mitra->nama_mitra,
						'alamat_mitra' => $cek_mitra->alamat,
						'no_telp_mitra' => $cek_mitra->no_telp
					);
					$this->session->set_userdata($datauser2);
				}

				// echo json_encode($cek_mitra);
				redirect('mitra');
			}else{
				redirect('SuperAdmin');
			}
		}




	}

	

	public function logout(){
		$this->session->sess_destroy();
		redirect ('login');
	}
}