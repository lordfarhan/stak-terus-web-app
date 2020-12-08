<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
  }

  private function sessionIsSet()
  {
    if ($this->session->userdata('email') != null) {
      redirect('home');
    }
  }

  public function index()
  {
    $this->sessionIsSet();
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Sign In';
      $this->load->view('auth/layouts/auth_header', $data);
      $this->load->view('auth/login');
      $this->load->view('auth/layouts/auth_footer');
    } else {
      $this->login();
    }
  }

  private function login()
  {
    $user = $this->db->get_where('users', ['email' => $this->input->post('email')])->row_array();
    if ($user != null) {
      if (md5($this->input->post('password')) == $user['password']) {
        $data = array('email' => $user['email'], 'role' => $user['role']);
        $this->session->set_userdata($data);
        redirect('home');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sign In Failed. Please Try Again</div>');
        redirect('auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User Is Not Registered</div>');
      redirect('auth');
    }
  }

  public function register()
  {
    $this->sessionIsSet();

    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]');
    $this->form_validation->set_rules('password_confirm', 'Password', 'required|trim|matches[password]');

    if ($this->form_validation->run() == false) {
      $data['title'] = 'Sign Up';
      $this->load->view('auth/layouts/auth_header', $data);
      $this->load->view('auth/register');
      $this->load->view('auth/layouts/auth_footer');
    } else {
      $data = array(
        'name' => $this->input->post('name'),
        'email' => $this->input->post('email'),
        'password' => md5($this->input->post('password')),
        'role' => $this->input->post('role'),
      );
      $this->db->insert('users', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Registered Successfully. Please Sign In</div>');
      redirect('auth');
    }
  }
}
