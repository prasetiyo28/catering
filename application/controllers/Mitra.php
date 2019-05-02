<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('MMeeting');

	}
	
	public function index()
	{
		// $data['banner'] = 'true';
		$data['content'] = $this->load->view('mitra/pages/dashboard','',true);
		$this->load->view('mitra/default',$data);
	}

	public function dataruang()
	{
		$id_mitra = $this->session->userdata('id_mitra');
		$data2['kapasitas'] = $this->MMeeting->get_kapasitas();
		$data2['ruangan'] = $this->MMeeting->get_ruangan($id_mitra);
		$data['content'] = $this->load->view('mitra/pages/data_ruang',$data2,true);
		$this->load->view('mitra/default',$data);

		echo json_encode($data2);
	}

	public function save_ruang(){

		$new_name = 'ruang_'.time();

		$nama_file = $_FILES["foto"]['name'];
		$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
		$nama_upload = $new_name.".".$ext;


		$data['nama_ruangan'] = $_POST['nama'];
		$data['id_mitra'] = '2';
		$data['kapasitas'] = $_POST['kapasitas'];
		$data['harga'] = $_POST['harga'];
		$data['foto']=$nama_upload;
		$data['detail_foto']='default.jpeg';

		$config['upload_path']          = './foto_ruang/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 5000;
		$config['file_name']             = $new_name;


		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('foto')){
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('alert','gagal');
			// redirect('guru/indonesia_apetizer');
			// redirect($_SERVER['HTTP_REFERER']);

			echo json_encode($error);
		}else{
			$datas = array('upload_data' => $this->upload->data());
			$tabel = 'ruang';
			$this->MMeeting->tambah_data($tabel,$data);
			$this->session->set_flashdata('alert','berhasil');
			redirect($_SERVER['HTTP_REFERER']);

		}
	}
}
