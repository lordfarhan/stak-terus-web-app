<?php

class Post_model extends CI_Model
{

  public function insert($data)
  {
    return $this->db->insert('posts', $data);
  }

  public function search($data)
  {
    return $this->db->select('posts.title, posts.id, posts.body, posts.created_at, posts.updated_at, (select count(*) from replies where replies.post_id = posts.id) as replies, users.name')
      ->from('users')
      ->join('posts', 'users.id = posts.user_id')->order_by('posts.updated_at', 'desc')->like('posts.title', $data)->get()->result();
  }

  public function update($id, $data)
  {
    return $this->db->where('id', $id)->update('posts', ['title' => $data['title'], 'body' => $data['body'], 'updated_at' => $data['updated_at']]);
  }

  public function all()
  {
    return $this->db->select('posts.title, posts.id, posts.body, posts.created_at, posts.updated_at, (select count(*) from replies where replies.post_id = posts.id) as replies, users.name')
      ->from('users')
      ->join('posts', 'users.id = posts.user_id')->order_by('posts.updated_at', 'desc')->get()->result();
  }

  // Method to get post by id
  public function get($id)
  {
    return $this->db->select('posts.id, posts.title, posts.body, posts.created_at, posts.updated_at, users.name')
      ->from('users')
      ->join('posts', 'users.id = posts.user_id')
      ->where(array('posts.id' => $id))->get()->row_array();
  }

  public function delete($id)
  {
    return $this->db->where('id', $id)->delete('posts');
  }
}
