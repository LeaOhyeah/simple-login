<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dash_admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_login');

		if($this->session->userdata('arys_status') != "sudah_login_bro"){
			redirect(base_url("login"));
		}
	}

	
	public function index()
	{
		//pemanggilan user yang sedang login
		$data['silogin'] = $this->m_login->tampil_silogin(); 



		$this->load->view('backend/header',$data);
		//body yang bisa dinamis
		$this->load->view('backend/home',$data);

		$this->load->view('backend/footer',$data);
	}
	 
}
