<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * @author Rido
	 */

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_auth');	
	}

	// menampilkan halaman login
	public function index()
	{
		$data['title'] = "Sistem Inventori dan Kasir | Login Page";
		$this->load->view('auth/v_index', $data);
	}

	// melakukan pengecekan data login admin/kasir
	function login(){
    $this->load->database();
		date_default_timezone_set("Asia/Jakarta");
		
		$username = strtoupper(htmlspecialchars(trim($this->input->post('username'))));
		$password = htmlspecialchars(trim($this->input->post('password')));

		// lakukan cek username apakah terdapat pada sistem atau tidak
		$whereUsername = array(
			'username' => $username
		);
		$cek_username = $this->m_auth->getWhere('user', $whereUsername)->num_rows();
		
		if ($cek_username > 0) {
			// lakukan cek password apakah sesuai
			$whereUser = array(
				'username' => $username,
				'password' => md5($password)
			);
			$cek_user = $this->m_auth->getWhere('user', $whereUser)->num_rows();
			$data     = $this->m_auth->getWhere('user', $whereUser)->result();
			
			if($cek_user > 0){
				$role  = $data[0]->role;
				$id    = $data[0]->id;
				// menyimpan data session
				$login_session  = array(
					'username' => $username,
					'role'     => $role,
					'id'       => $id,
					'status'   => "logged",
				);

				$this->session->set_userdata($login_session);
				$this->session->set_flashdata('success', "Selamat datang Admin.");

				// switch role
				switch ($role) {
					case 'ADMIN':
						redirect(base_url("admin/index"));
						break;
						
					default:
						redirect(base_url("kasir/index"));
						break;
				}

			} else {
				// jika password salah
				$this->session->set_flashdata('error', "Password salah. Silakan login kembali!");
				redirect(base_url("auth"));
			}
		} else {
			// jika username tidak ada di database
			$this->session->set_flashdata('error', "Username salah. Silakan login kembali!");
			redirect(base_url("auth"));
		}
	}

	// Fungsi untuk logout
	function logout() {
		date_default_timezone_set("Asia/Jakarta");

		// hapus session dan redirect ke halaman login
		$this->session->sess_destroy();
		redirect(base_url('auth'));
	}

	
}
