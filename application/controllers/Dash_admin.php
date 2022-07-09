<?php
defined('BASEPATH') or exit('No direct script access allowed');

// controller yang akan memuat dashboard admin
class Dash_admin extends CI_Controller
{
	// function yang mengembalikan ke from login jika user belum login
	function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');

		if ($this->session->userdata('status') != "sudah_login_bro") {
			redirect(base_url("login"));
		}
	}


	public function index()
	{
		//pemanggilan user yang sedang login
		$data['silogin'] = $this->m_login->tampil_silogin();



		$this->load->view('backend/header', $data);
		//body yang bisa dinamis
		$this->load->view('backend/home', $data);
		$this->load->view('backend/footer', $data);
	}
}
