<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mitra extends CI_Controller {


	public function __construct(){
		parent::__construct();
		$this->load->library(array('googlemaps'));
		$this->load->model('MCatering');

	}
	
	public function index()
	{
		$config['map_div_id'] = "map-add";
		$config['map_height'] = "250px";
		$config['center'] = '-6.880029,109.124192';
		$config['zoom'] = '12';
		$config['map_height'] = '300px;';
		$this->googlemaps->initialize($config);

		$marker = array();
		$marker['position'] = '-6.880029,109.124192';
		$marker['draggable'] = true;
		$marker['ondragend'] = 'setMapToForm(event.latLng.lat(), event.latLng.lng());';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();

		$id = $this->session->userdata('user_id');
		$data['mitra'] = $this->MCatering->get_mitra($id);
		$data['content'] = $this->load->view('mitra/pages/dashboard',$data,true);
		$this->load->view('mitra/default',$data);
	}

	public function pesananmasuk()
	{

		$id_mitra = $this->session->userdata('user_id');
		$data2['mitra'] = $this->MCatering->get_mitra($id_mitra);
		$data2['pesanan'] = $this->MCatering->get_pesanan_id($data2['mitra']->id_mitra);
		$data['content'] = $this->load->view('mitra/pages/data_pesanan',$data2,true);
		$this->load->view('mitra/default',$data);	
	}

	public function histori()
	{

		$id_mitra = $this->session->userdata('user_id');
		$data2['mitra'] = $this->MCatering->get_mitra($id_mitra);
		$data2['pesanan'] = $this->MCatering->get_histori_id($data2['mitra']->id_mitra);
		$data['content'] = $this->load->view('mitra/pages/data_histori',$data2,true);
		$this->load->view('mitra/default',$data);	

		// echo json_encode($id_mitra);

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

	public function update_paket(){
		$id = $this->input->post('id');
		$data['nama_paket'] = $this->input->post('nama');
		$data['harga'] = $this->input->post('harga');
		$data['deskripsi'] = $this->input->post('deskripsi');

		if (!empty($_FILES["foto"]['name'])) {
			$nama_file = $_FILES["foto"]['name'];
			$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
			$nama_upload = $new_name.".".$ext;


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
				$this->MCatering->update_data('paket',$id,'id_paket',$data);
				$this->session->set_flashdata('alert','berhasil');
				redirect($_SERVER['HTTP_REFERER']);

			}
		}else{
			$this->MCatering->update_data('paket',$id,'id_paket',$data);
			$this->session->set_flashdata('alert','berhasil');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function verifikasi($id){
		$tabel = 'pesan';
		$param = 'id_order';
		$this->MCatering->verif($tabel,$id,$param);
		redirect('mitra/pesananmasuk');
	}
	public function tolak($id){
		$tabel = 'pesan';
		$param = 'id_order';
		$this->MCatering->tolak($tabel,$id,$param);
		redirect('mitra/pesananmasuk');
	}

	public function selesai($id){
		$tabel = 'pesan';
		$param = 'id_order';
		$this->MCatering->selesai($tabel,$id,$param);
		redirect('mitra/pesananmasuk');
	}

	public function hapus_paket(){

		$id = $this->input->post('id');
		$table = 'paket';
		$param = 'id_paket';
		$this->MCatering->hapus($table,$id,$param);
		redirect('Mitra/datapaket');
	}

	public function cetak_laporan(){
		$mulai = $this->input->post('mulai');
		$sampai = $this->input->post('sampai');
		$id_mitra = $this->session->userdata('user_id');
		$data2['mitra'] = $this->MCatering->get_mitra($id_mitra);
		$data2['pesanan'] = $this->MCatering->get_histori_id_laporan($data2['mitra']->id_mitra,$mulai,$sampai);
		$this->load->view('mitra/pages/laporan_histori',$data2);
		
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
		$data['kategori'] = $_POST['kategori'];
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


		$id_mitra = $this->session->userdata('id_mitra');
		$new_name = 'foto_mitra'.$id_mitra.time();

		$nama_file = $_FILES["foto"]['name'];
		$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
		$nama_upload = $new_name.".".$ext;


		$data['nama_mitra'] = $_POST['nama'];
		$data['longitude'] = $_POST['longitude'];
		$data['latitude'] = $_POST['latitude'];
		$data['alamat'] = $_POST['alamat'];
		$data['no_telp'] = $_POST['nomor'];
		$data['nama_pemilik'] = $_POST['pemilik'];
		if ($_POST['bank']=='others') {
			$data['nama_bank'] = $_POST['bank2'];
		}else{

			$data['nama_bank'] = $_POST['bank'];
		}
		$data['nomor_rekening'] = $_POST['rekening'];
		
		$data['nama_akun_bank'] = $_POST['nama_rekening'];
		$data['image']=$nama_upload;
		
		$config['upload_path']          = './katon/img/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 5000;
		$config['file_name']             = $new_name;



		$tabel = 'mitra';
		$this->load->library('upload', $config);

		$this->upload->do_upload('foto');
		$this->MCatering->tambah_data($tabel,$data);
		$cek_mitra = $this->MCatering->get_mitra($this->session->userdata('user_id'));
		if (!empty($cek_mitra)) {
			$datauser2 = array(
				'id_mitra' => $cek_mitra->id_mitra,
				'nama_mitra' => $cek_mitra->nama_mitra,
				'alamat_mitra' => $cek_mitra->alamat,
				'no_telp_mitra' => $cek_mitra->no_telp
			);
			$this->session->set_userdata($datauser2);
		}

		$this->session->set_flashdata('alert','berhasil');
		redirect($_SERVER['HTTP_REFERER']);


		


		

		
	}

	public function detail(){
		$id = $_POST['id_paket'];
		// $id = 1;
		// $table = 'ruang';
		$data = $this->MCatering->get_detail_paket($id);

		
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
		<td>Rp.'.$data->harga.'</td>
		</tr>
		<tr>
		
		</tr>
		</table>';


	}
}
