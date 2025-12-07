<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Todo_model');
    }

    public function index() {
        $data['todos'] = $this->Todo_model->get_all_todos();
        $this->load->view('todo_list_view', $data);
    }

    public function add() {
        $title = $this->input->post('title', TRUE); // TRUE untuk keamanan XSS
        
        if ($title) {
            $this->Todo_model->insert_todo(['title' => $title]);
            $this->session->set_flashdata('msg', 'Tugas berhasil ditambahkan! 🌸');
        }
        redirect('todo');
    }

    public function edit($id) {
        $data['todo'] = $this->Todo_model->get_todo_by_id($id);
        
        if (!$data['todo']) {
            show_404();
        }

        // Jika form di-submit
        if ($this->input->post('submit')) {
            $title = $this->input->post('title', TRUE);
            if ($title) {
                $this->Todo_model->update_todo($id, ['title' => $title]);
                $this->session->set_flashdata('msg', 'Tugas berhasil diedit! 💅');
                redirect('todo');
            }
        }

        $this->load->view('todo_edit_view', $data);
    }

    public function toggle_status($id) {
        $todo = $this->Todo_model->get_todo_by_id($id);
        if ($todo) {
            $status = ($todo->is_completed == 1) ? 0 : 1;
            $this->Todo_model->update_todo($id, ['is_completed' => $status]);
        }
        redirect('todo');
    }

    public function delete($id) {
        $this->Todo_model->delete_todo($id);
        $this->session->set_flashdata('msg', 'Tugas dihapus! 🗑️');
        redirect('todo');
    }
}