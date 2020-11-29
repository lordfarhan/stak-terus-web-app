<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('post_model');
    $this->load->model('reply_model');
  }

  private function sessionIsSet()
  {
    if ($this->session->userdata('email') == null) {
      redirect('auth');
    }
  }

  private function getSession()
  {
    $this->db->where(array('email' => $this->session->userdata('email')));
    $query = $this->db->get('users');
    return $query->row_array();
  }

  public function logout()
  {
    $this->session->unset_userdata('email');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Logged out</div>');
    redirect('auth');
  }

  public function index()
  {
    $this->sessionIsSet();

    $data['title'] = 'Dashboard';
    $data['user'] = $this->getSession();
    $data['users'] = $this->getUsers();
    $data['posts'] = $this->post_model->all();
    $data['replies'] = $this->reply_model->all();
    $this->load->view('layouts/header', $data);
    $this->load->view('layouts/sidebar');
    $this->load->view('layouts/top', $data);
    $this->load->view('dashboard', $data);
    $this->load->view('layouts/bottom');
    $this->load->view('layouts/footer');
  }

  private function getUsers()
  {
    $this->db->select('users.id, users.name');
    $this->db->from('users');
    $query = $this->db->get();
    return $query->result();
  }
}
