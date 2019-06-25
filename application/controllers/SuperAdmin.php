<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuperAdmin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('MCatering');

	}

	public function index()
	{
		// $data['banner'] = 'true';
		$data['content'] = $this->load->view('super/pages/dashboard','',true);
		$this->load->view('super/default',$data);

	}

	public function datamitra()
	{
		// $data['banner'] = 'true';
		$data2['mitra'] = $this->MCatering->getMitraAll();
		$data['content'] = $this->load->view('super/pages/data_mitra',$data2,true);
		$this->load->view('super/default',$data);

	}

	public function datapaket()
	{
		// $data['banner'] = 'true';
		$data2['paket'] = $this->MCatering->getPaketAll();
		$data['content'] = $this->load->view('super/pages/data_paket',$data2,true);
		$this->load->view('super/default',$data);

	}

	public function datauser()
	{
		// $data['banner'] = 'true';
		$data2['user'] = $this->MCatering->getUserAll();
		$data['content'] = $this->load->view('super/pages/data_user',$data2,true);
		$this->load->view('super/default',$data);

	}



	public function dataruang()
	{

		$data2['kapasitas'] = $this->MCatering->get_kapasitas();
		$data2['ruangan'] = $this->MCatering->get_ruangan_all();
		$data['content'] = $this->load->view('super/pages/data_ruang',$data2,true);
		$this->load->view('super/default',$data);

		// echo json_encode($data2);
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

		if ($data->verif == 0) {
			$ver =  '<tr>
			<td colspan="3">
			<center>
			<a href="'.base_url().'SuperAdmin/verifikasi/'.$data->id_paket.'" class="btn btn-success">V e r i f i k a s i </a>
			</center>
			</td>
			</tr>';
		}else{
			$ver = '';
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
		<td>Harga</td>
		<td>:</td>
		<td>Rp.'.$data->harga.'</td>
		</tr>
		<tr>
		<td>Deskripsi</td>
		<td>:</td>
		<td>'.$data->deskripsi.'/Jam</td>
		</tr>
		<tr>
		<td>Keterangan</td>
		<td>:</td>
		<td>'.$ket.'</td>
		</tr>
		'.$ver.'
		</table>';


	}

	public function verifikasi($id){
		$table = 'paket';
		$param = 'id_paket';
		$this->MCatering->verifikasi($table,$id,$param);

		redirect('SuperAdmin/datapaket');
	}

	public function verif_mitra($id){
		$table = 'mitra';
		$param = 'id_mitra';
		$this->MCatering->verifikasi($table,$id,$param);

		redirect('SuperAdmin/datamitra');
	}

	public function hapus_paket($id){
		$table = 'paket';
		$param = 'id_paket';
		$this->MCatering->hapus($table,$id,$param);
		redirect('SuperAdmin/datapaket');
	}

}
