<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->model('MCatering');

	}
	
	public function index()
	{
		$id = $this->session->userdata('user_id');
		$data['mitra'] = $this->MCatering->get_mitra($id);
		$data['content'] = $this->load->view('mitra/pages/dashboard',$data,true);
		$this->load->view('mitra/default',$data);
	}

	public function datapaket()
	{
		$id_mitra = $this->session->userdata('id_mitra');
		$data2['mitra'] = $this->MCatering->get_mitra($id_mitra);
		// $data2['kapasitas'] = $this->MCatering->get_kapasitas();
		$data2['paket'] = $this->MCatering->get_paket($id_mitra);
		$data['content'] = $this->load->view('mitra/pages/data_paket',$data2,true);
		$this->load->view('mitra/default',$data);

		// echo json_encode($data2);
	}

	public function hapus_paket($id){
		$table = 'paket';
		$param = 'id_paket';
		$this->MCatering->hapus($table,$id,$param);
		redirect('Mitra/datapaket');
	}

	

	public function save_paket(){

		$id_mitra = $this->session->userdata('id_mitra');
		$new_name = 'paket_mitra'.$id_mitra.time();

		$nama_file = $_FILES["foto"]['name'];
		$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
		$nama_upload = $new_name.".".$ext;


		$data['nama_paket'] = $_POST['nama'];
		$data['id_mitra'] = $id_mitra;
		$data['harga'] = $_POST['harga'];
		$data['deskripsi'] = $_POST['deskripsi'];
		$data['foto']=$nama_upload;
		
		$config['upload_path']          = './foto_paket/';
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
			$tabel = 'paket';
			$this->MCatering->tambah_data($tabel,$data);
			$this->session->set_flashdata('alert','berhasil');
			redirect($_SERVER['HTTP_REFERER']);

		}


	}

	public function save_mitra(){
		$data['id_user'] = $this->session->userdata('user_id');
		$data['nama_mitra'] = $_POST['nama'];
		$data['alamat'] = $_POST['alamat'];
		$data['no_telp'] = $_POST['nomor'];
		$data['nama_pemilik'] = $_POST['pemilik'];
		$data['nama_bank'] = $_POST['bank'];
		$data['nomor_rekening'] = $_POST['rekening'];
		
		$data['nama_akun_bank'] = $_POST['nama_rekening'];

		$tabel = 'mitra';

		$this->MCatering->tambah_data($tabel,$data);

		$this->session->set_flashdata('alert','berhasil');
		redirect('mitra');
	}

	public function detail(){
		$id = $_POST['id_paket'];
		// $id = 1;
		// $table = 'ruang';
		$data = $this->MCatering->get_detail_paket($id);

		if ($data->verif == 1) {
			$ket =  '<label class="btn btn-success"><i class="fas fa-check"></i>Verified</label>';
		}else{
			$ket = '<label class="btn btn-danger btn-sm"><i class="fas fa-exclamation-triangle"></i>Unverified</label>';
		}

		echo '
		<table class="table table-striped">
		<tr>
		<td colspan="3"><img style="text-align: center;" class="img-thumbnail" src="'. base_url().'foto_paket/'. $data->foto.'"></td>
		</tr>
		<tr>
		<td>Nama Paket</td>
		<td>:</td>
		<td>'.$data->nama_paket.'</td>
		</tr>
		<td>Nama Mitra</td>
		<td>:</td>
		<td>'.$data->nama_mitra.'</td>
		</tr>
		<tr>
		<td>Kapasitas</td>
		<td>:</td>
		<td>'.$data->deskripsi.'</td>
		</tr>
		<tr>
		<td>Harga</td>
		<td>:</td>
		<td>Rp.'.$data->harga.'/Jam</td>
		</tr>
		<tr>
		<td>Keterangan</td>
		<td>:</td>
		<td>'.$ket.'</td>
		</tr>
		</table>';


	}
}
