<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('MMeeting');

	}

	public function index(){
		$data['nama'] = $_POST['nama'];
		$data['no_hp'] = $_POST['nomor'];
		$data['email'] = $_POST['email'];
		$data['password'] = md5($_POST['password']);

		$tabel = 'user';

		$this->MMeeting->tambah_data($tabel,$data);

		$this->session->set_flashdata('alert','berhasil');
		redirect('frontend/login');


	}
}