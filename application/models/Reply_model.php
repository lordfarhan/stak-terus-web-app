<?php

class Reply_model extends CI_Model
{
  public function insert($data)
  {
    $query = $this->db->insert('replies', $data);
    return $query;
  }

  public function update($id, $data)
  {
    return $this->db->where('id', $id)->update('replies', ['reply' => $data['reply'], 'updated_at' => $data['updated_at']]);
  }

  // Get all replies generally
  public function all()
  {
    $this->db->select('replies.id, replies.reply');
    $this->db->from('replies');
    $query = $this->db->get();
    return $query->result();
  }

  // Method to get post by id
  public function get($id)
  {
    return $this->db->select('replies.id, replies.user_id, replies.post_id, replies.reply, replies.created_at, replies.updated_at')->from('replies')->where(array('replies.id' => $id))->get()->row_array();
  }

  // Get commment by post_id
  public function getAll($id)
  {
    $this->db->select('replies.id, replies.user_id, replies.post_id, replies.reply, replies.created_at, users.name');
    $this->db->from('users');
    $this->db->join('replies', 'users.id = replies.user_id');
    $this->db->where(array('replies.post_id' => $id));
    $query = $this->db->get();
    return $query->result();
  }

  public function delete($id)
  {
    return $this->db->where('id', $id)->delete('replies');
  }
}
