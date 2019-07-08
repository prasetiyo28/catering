<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('MCatering');

	}

	public function index()
	{
		$this->load->view('register');
	}

	public function register(){
		$data['nama'] = $_POST['nama'];
		$data['no_hp'] = $_POST['nomor'];
		$data['email'] = $_POST['email'];
		$data['jenis_user'] = '1';
		$data['password'] = md5($_POST['password']);

		$tabel = 'user';

		$this->MCatering->tambah_data($tabel,$data);
		$regis = $this->MCatering->cek_id($data['email']);
		$this->send($regis->id_user,$data['email']);
		$this->session->set_flashdata('alert','berhasil');
		redirect('register');


	}

	public function send($id,$email){
		$htmlContent = '<h1>Klik Link di bawah ini untuk memverifikasi akun anda</h1>';
		$htmlContent .= '<a href='.base_url().'register/verifikasi/'.$id.'>Verifikasi</a>';


		$ci = get_instance();
		$ci->load->library('email');
		$config['protocol'] = "smtp";
		$config['smtp_host'] = "smtp.gmail.com";
		$config['smtp_port'] = "587";
		$config['smtp_user'] = "dinawahyuni440@gmail.com";
		$config['smtp_pass'] = "Dina@12345";
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		$ci->email->initialize($config);
		$ci->email->from('verif@catering.com', 'Verif Catering');
		$list = array($email);
		$ci->email->to($list);
		$ci->email->subject('Verifikasi Catering');


		$ci->email->message($htmlContent);
		if ($this->email->send()) {
			echo 'Email sent.';
		} else {
			show_error($this->email->print_debugger());
		}
	}

	public function verifikasi($id){
		$this->MCatering->verif('user',$id,'id_user');
		redirect('login');
	}
}
