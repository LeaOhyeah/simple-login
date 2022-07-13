<?php
defined('BASEPATH') or exit('No direct script access allowed');

// class controller berisi function-function
class Login extends CI_Controller
{

	// function untuk memanggil model
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
	}


	// function index page
	public function index()
	{
		$this->load->view('login/index');
	}

	// 1. function login 
	//		1a. memasukan inputan email dan password ke dalam variable
	// 		1b. mengecek apakah email dan password ditemukan pada model M_Login
	// 		1c. jika benar maka mengisi data session (username dan status) dan masuk ke halaman admin
	// 		1d. jika salah maka mengisi data session status dan kembali ke halaman login

	public function cek_login()
	{
		// 1a 
		$var_email = $this->input->post('txt_email');
		$var_password = $this->input->post('txt_password');
		$where = array(
			'username' => $var_email,
			'password' => md5($var_password)
		);
			// $this adalah variable khusus dalam OOP PHP yang digunakan sebagai penunjuk kepada objek

		// 1b 
		$cek = $this->m_login->cek_user("tb_user", $where)->num_rows();
		if ($cek > 0) {
			// 1c 
			$ary_data_session = array(
				'nama' => $var_email,
				'arys_status' => "sudah_login_bro"
			);

			$this->session->set_userdata($ary_data_session);
			$this->session->set_flashdata('msg', 'Selamat Anda Berhasil Login');
				// memasukkan data kedalam session (session adalah library yang menyimpan data di server)
				// 	set_userdata di isi ary_data_session
				// 	set_flasdata di isi msg 

			redirect(base_url("dash_admin"));
				// mengarahkan ke halaman admin 

			// 1.d 
		} else {
			$this->session->set_flashdata('msg', 'Username dan password salah !');

			redirect(base_url("login"));
				// mengarahkan ke halaman login 
		}
	}

	// function logout 
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
		// mengembalikan ke halaman login 
}
