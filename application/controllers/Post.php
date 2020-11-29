<?php defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
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

  public function index()
  {
    $this->sessionIsSet();

    $data['title'] = 'Dashboard | All Post';
    $data['user'] = $this->getSession();
    $data['posts'] = $this->post_model->all();
    $this->load->view('layouts/header', $data);
    $this->load->view('layouts/sidebar');
    $this->load->view('layouts/top', $data);
    $this->load->view('posts', $data);
    $this->load->view('layouts/bottom');
    $this->load->view('layouts/footer');
  }

  public function detail($id)
  {
    $this->sessionIsSet();

    $data['title'] = 'Dashboard | Detail Post';
    $data['user'] = $this->getSession();
    $data['post'] = $this->post_model->get($id);
    $data['replies'] = $this->reply_model->getAll($id);
    $this->load->view('layouts/header', $data);
    $this->load->view('layouts/sidebar');
    $this->load->view('layouts/top', $data);
    $this->load->view('detail', $data);
    $this->load->view('layouts/bottom');
    $this->load->view('layouts/footer');
  }

  // Redirect to create page
  public function create()
  {
    $this->sessionIsSet();

    $data['title'] = 'Dashboard | Post Post';
    $data['user'] = $this->getSession();
    $this->load->view('layouts/header', $data);
    $this->load->view('layouts/sidebar');
    $this->load->view('layouts/top', $data);
    $this->load->view('create', $data);
    $this->load->view('layouts/bottom');
    $this->load->view('layouts/footer');
  }

  // Method to store the post data
  public function store()
  {
    $this->sessionIsSet();

    $this->form_validation->set_rules('user_id', 'User', 'required');
    $this->form_validation->set_rules('title', 'Title', 'required|trim');
    $this->form_validation->set_rules('body', 'Body', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->create();
    } else {
      $data = array(
        'user_id' => $this->input->post('user_id'),
        'title' => $this->input->post('title'),
        'body' => $this->input->post('body'),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
      );
      $this->post_model->insert($data);
      $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Added new post successfully!</div>');
      redirect(base_url('post'));
    }
  }

  // Redirect to edit page
  public function edit($id)
  {
    $this->sessionIsSet();

    $data['title'] = 'Dashboard | Post Post';
    $data['user'] = $this->getSession();
    $data['post'] = $this->post_model->get($id);
    $this->load->view('layouts/header', $data);
    $this->load->view('layouts/sidebar');
    $this->load->view('layouts/top', $data);
    $this->load->view('edit', $data);
    $this->load->view('layouts/bottom');
    $this->load->view('layouts/footer');
  }

  // Method to update the post data
  public function update()
  {
    $this->sessionIsSet();

    $this->form_validation->set_rules('id', 'ID', 'required');
    $this->form_validation->set_rules('title', 'Title', 'required|trim');
    $this->form_validation->set_rules('body', 'Body', 'required|trim');

    if ($this->form_validation->run() == false) {
      $this->create();
    } else {
      $id = $this->input->post('id');
      $data = array(
        'title' => $this->input->post('title'),
        'body' => $this->input->post('body'),
        'updated_at' => date('Y-m-d H:i:s'),
      );
      $this->post_model->update($id, $data);
      $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Edited post successfully!</div>');
      redirect("post/detail/$id");
    }
  }

  // Method to delete posts
  public function delete($id)
  {
    $this->sessionIsSet();
    $this->post_model->delete($id);
    redirect(base_url('post'));
  }

  // Method to get the result from search query
  public function search()
  {
    $this->sessionIsSet();

    $query = $this->input->post('query');

    $data['title'] = 'Dashboard | Search';
    $data['user'] = $this->getSession();
    $data['posts'] = $this->post_model->search($query);
    $data['query'] = $query;
    $this->load->view('layouts/header', $data);
    $this->load->view('layouts/sidebar');
    $this->load->view('layouts/top', $data);
    $this->load->view('result', $data);
    $this->load->view('layouts/bottom');
    $this->load->view('layouts/footer');
  }

  // Method to store reply
  public function storeReply()
  {
    $this->sessionIsSet();

    $this->form_validation->set_rules('reply', 'Reply', 'required|trim');

    $data = array(
      'user_id' => $this->input->post('user_id'),
      'post_id' => $this->input->post('post_id'),
      'reply' => $this->input->post('reply'),
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s'),
    );
    $post_id = $this->input->post('post_id');
    $this->reply_model->insert($data);
    $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Replied successfully!</div>');
    redirect("post/detail/$post_id");
  }

  // Redirect to edit reply page
  public function editReply($id)
  {
    $this->sessionIsSet();

    $data['title'] = 'Dashboard | Post Post';
    $data['user'] = $this->getSession();
    $data['reply'] = $this->reply_model->get($id);
    $this->load->view('layouts/header', $data);
    $this->load->view('layouts/sidebar');
    $this->load->view('layouts/top', $data);
    $this->load->view('edit_reply', $data);
    $this->load->view('layouts/bottom');
    $this->load->view('layouts/footer');
  }

  // Method to update reply
  public function updateReply()
  {
    $this->sessionIsSet();

    $this->form_validation->set_rules('reply', 'Reply', 'required|trim');

    $id = $this->input->post('id');
    $data = array(
      'reply' => $this->input->post('reply'),
      'updated_at' => date('Y-m-d H:i:s'),
    );
    $post_id = $this->input->post('post_id');
    $this->reply_model->update($id, $data);
    $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Replied successfully!</div>');
    redirect("post/detail/$post_id");
  }

  // Method to delete posts
  public function deleteReply($id)
  {
    $this->sessionIsSet();
    $post_id = $this->reply_model->get($id)['post_id'];
    $this->reply_model->delete($id);
    redirect("post/detail/$post_id");
  }
}
