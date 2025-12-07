<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo_model extends CI_Model {

    public function get_all_todos() {
        $this->db->order_by('is_completed', 'ASC'); 
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('todos')->result();
    }

    public function get_todo_by_id($id) {
        return $this->db->get_where('todos', ['id' => $id])->row();
    }

    public function insert_todo($data) {
        return $this->db->insert('todos', $data);
    }

    public function update_todo($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('todos', $data);
    }

    public function delete_todo($id) {
        $this->db->where('id', $id);
        return $this->db->delete('todos');
    }
}