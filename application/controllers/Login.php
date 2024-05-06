<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_admin', 'm_admin');
    }


    public function index()
    {

        $this->load->view('login');
    }

    public function proseslogin()
    {
        $where = array(
            'user_username' => $this->input->post('user_username', TRUE),
            'user_password' => md5($this->input->post('user_password', TRUE))
        );
        $cek = $this->m_admin->cek_login("user", $where);
        if ($cek->num_rows() == 1) {
            foreach ($cek->result() as $sess) {
                $sess_data['status'] = 'login';
                $sess_data['user_id'] = $sess->user_id;
                $sess_data['user_username'] = $sess->user_username;
                $sess_data['user_nama'] = $sess->user_nama;
                $sess_data['user_level'] = $sess->user_level;

                $this->session->set_userdata($sess_data);
            }

            $tglsekarang = date("Y-m-d H:m:s");
            $data1 = array('last' => $tglsekarang);
            $where1 = array('user_username' => $sess_data['user_username']);
            $this->m_admin->update_data($where1, $data1, 'user');

            if ($this->session->userdata('user_level') == 'admin') {
                echo "<script>
					alert('Selamat Berhasil Login');
					window.location='" . site_url('admin') . "'
				</script>";
            } elseif ($this->session->userdata('user_level') == 'operator') {
                echo "<script>
					alert('Selamat Berhasil Login');
					window.location='" . site_url('operator') . "'
				</script>";
            }
        } else {
            echo "<script>
					alert('Gagal Login, Username/user_password Salah');
					window.location='" . site_url('login') . "'
				</script>";
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
