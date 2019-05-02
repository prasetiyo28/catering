<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MMeeting extends CI_Model{

	function tambah_data($table,$data){
		$this->db->insert($table,$data);
	}

	function cek_login($data){
		$this->db->select('user.*');
		$this->db->from('user');
		$this->db->where($data);
		$query = $this->db->get();
		
		return $query->row();
	}

	function get_kapasitas(){
		$this->db->where('deleted','0');
		$query = $this->db->get('kapasitas');
		return $query->result();
	}

	function get_ruangan($id){
		$this->db->where('id_mitra',$id);
		$this->db->where('deleted','0');
		$this->db->where('verif','0');
		$query = $this->db->get('ruang');
		return $query->result();
	}

	function get_mitra($id){
		$this->db->where('id_user',$id);
		$query = $this->db->get('mitra');
		return $query->row();
	}
}