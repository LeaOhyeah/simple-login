<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

     function __construct()
     {
          parent::__construct();
          $this->load->model('m_login');
     }


     public function index()
     {
          $this->load->view('login/index');
     }
     
     public function cek_login()
     {
          $user = $this->input->post('username');
          $pass = $this->input->post('password');
          $where = array(
               'username' => $user,
               'password' => md5($pass)
          );
          $cek = $this->m_login->cek_user("tb_user", $where)->num_rows();
          if ($cek > 0) {

               $data_session = array(
                    'vars_nama' => $user,
                    'vars_status' => "sudah_login_bro"
               );

               $this->session->set_userdata($data_session);
               $this->session->set_flashdata('msg', 'welcome');
               // redirect(base_url("nama kelas atau file di controllers"));
               redirect(base_url("dash_admin"));
          } else {
               $this->session->set_flashdata('msg', 'Username dan password salah !');
               // redirect(base_url("nama kelas atau file di controllers"));
               redirect(base_url("login"));
          }
     }
     public function logout()
     {
          $this->session->sess_destroy();
          redirect(base_url('login'));
     }
}
