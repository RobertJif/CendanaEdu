<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {


	public function index()
	{	$data['siswa'] = $this->Admin_model->getSiswa('siswa');
		$data['pengumumanweb'] = $this->Admin_model->getPengumumanWeb();
		$this->load->view('index',$data);
	}

	public function Tampil_login(){
	$this->load->view('login');	
	}

	public function tampilphpinfo()
	{
		$this->load->view('phpinfo');
	}
	
	
	public function CekLogin(){
		$id = $this->input->post('id',true); //ambil inputan username
		$_SESSION['nisn']=$id;
		$password = $this->input->post('password',true);//ambil inputan password
					
		$cek = $this->Login_model->ProsesAdminLogin($id,$password);  
		$hasil = count($cek); // jika ada 1 tidak ada 0
		

		if ($hasil > 0){
			$select = $this->db->get_where('admin',array('nip' => $id,'password' => $password ))->row();
			$data = array('logged_in' => true,
						  'loger' => $select->nama_admin,
						  'level' => $select->level);
			$this->session->set_userdata($data);
			if ($data['level'] == '1'){
			redirect('Admin_controller/Tampilkes_Beranda');}
			else if ($data['level'] == '2'){
			redirect('Admin_controller/Tampilkur_Beranda');}
			else if ($data['level'] == '3'){
			redirect('Admin_controller/Tampilsar_beranda');}
			else if ($data['level'] == '4'){
			redirect('Admin_controller/Tampilperpus_Beranda');}
			
		}else if ($hasil < 1){
		$cekk = $this->Login_model->ProsesSiswaLogin($id,$password);  
		$hasill = count($cekk); // jika ada 1 tidak ada 0
		if ($hasill > 0){
			$select = $this->db->get_where('siswa',array('nisn' => $id,'password' => $password ))->row();
			$dataa = array('logged_in' => true,
						  'loger' => $select->nama_siswa,
						  'level' => $select->level);
			$this->session->set_userdata($dataa);

			redirect('Siswa_controller/Tampilsiswa_beranda');
		}}else{
		?>
		<script>
				alert('Username / Password salah!');
				window.location=('../Login_controller/Tampil_login');			
		</script>
				<?php
			//$this->session->set_flashdata('err','Username / Password salah!');
			//redirect('loginpakarcontroller/tampilloginpakar');
		}
	}
	
	
	
	
	
	
	
public function CekAdminLogin(){
		$username = $this->input->post('username',true); //ambil inputan username
		$password = $this->input->post('password',true);//ambil inputan password
		$cek = $this->Login_model->ProsesAdminLogin($username,$password);  
		$hasil = count($cek); // jika ada 1 tidak ada 0
		
		if ($hasil > 0){
			$select = $this->db->get_where('admin',array('username' => $username,'password' => $password ))->row();
			$data = array('logged_in' => true,
						  'loger' => $select->username);
			$this->session->set_userdata($data);
			//$_SESSION['username'] = $username;
			redirect('Admin_controller/TampilAdminBeranda');	
		}else{
		?>
		<script>
				alert('Username / Password salah!');
				window.location=('../Login_controller/Tampil_login');		
		</script>
				<?php
			//$this->session->set_flashdata('err','Username / Password salah!');
			//redirect('loginpakarcontroller/tampilloginpakar');
		}
	}
	
		public function CekSiswaLogin(){
		$username = $this->input->post('username',true); //ambil inputan username
		$password = $this->input->post('password',true);//ambil inputan password
		$cek = $this->Login_model->ProsesSiswaLogin($username,$password);  
		$hasil = count($cek); // jika ada 1 tidak ada 0
		
		if ($hasil > 0){
			$select = $this->db->get_where('siswa',array('username' => $username,'password' => $password ))->row();
			$data = array('logged_in' => true,
						  'loger' => $select->username);
			$this->session->set_userdata($data);
			//$_SESSION['username'] = $username;
			redirect('Siswa_controller/TampilSiswaBeranda');	
		}else{
		?>
		<script>
				alert('Username / Password salah!');
				window.location=('../Login_controller/Tampil_login');			
		</script>
				<?php
			//$this->session->set_flashdata('err','Username / Password salah!');
			//redirect('loginpakarcontroller/tampilloginpakar');
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('Login_controller/index');
	}
	
	}


