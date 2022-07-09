<?php

class M_login extends CI_Model
{
     // function untuk mengecek username dan password
     function cek_user($table, $where)
     {
          return $this->db->get_where($table, $where);
     }

     // function untuk mengambil seluruh data user yang sedang login
     function tampil_silogin()
     {
          $nama_user = $this->session->userdata("nama");
          $query = $this->db->query(" SELECT * FROM tb_user WHERE  username = '$nama_user' ");
          return $query->result();
     }
}
