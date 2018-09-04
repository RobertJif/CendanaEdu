<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function ProsesAdminLogin($id,$password){
		$this->db->where('nip',$id);
		$this->db->where('password',$password);

		return $this->db->get('admin')->row();
	}
	
	public function ProsesSiswaLogin($id,$password){
		$this->db->where('nisn',$id);
		$this->db->where('password',$password);
		return $this->db->get('siswa')->row();
	}
	
}
