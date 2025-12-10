<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Todo_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index() {
        $filter = $this->input->get('day', TRUE) ?: 'today';
        $data['current_filter'] = $filter;

        if ($filter == 'all') {
            $data['todos'] = $this->Todo_model->get_all_todos_ordered();
            $data['page_title'] = 'Semua Tugas';
        } else {
            switch ($filter) {
                case 'yesterday':
                    $target_date = date('Y-m-d', strtotime("-1 days"));
                    $title_prefix = "Yesterday";
                    break;
                case 'tomorrow':
                    $target_date = date('Y-m-d', strtotime("+1 days"));
                    $title_prefix = "Tomorrow";
                    break;
                case 'today':
                default:
                    $target_date = date('Y-m-d');
                    $title_prefix = "Today";
                    break;
            }
            $data['todos'] = $this->Todo_model->get_all_todos_by_date_target($target_date);
            $data['page_title'] = $title_prefix . ' (' . date('d M', strtotime($target_date)) . ')';
        }

        $this->load->view('todo_list_view', $data);
    }

    public function add() {
        $title = $this->input->post('title', TRUE); 
        
        if ($title) {
            $due_date = $this->input->post('due_date', TRUE);
            $due_time = $this->input->post('due_time', TRUE);
            $due_day  = $this->input->post('due_day', TRUE);

            $data_insert = [
                'title'         => $title,
                'is_completed'  => 0,
                'due_date'      => empty($due_date) ? NULL : $due_date,
                'due_time'      => empty($due_time) ? NULL : $due_time,
                'due_day'       => empty($due_day) ? NULL : $due_day,
            ];

            $this->Todo_model->insert_todo($data_insert);
            $this->session->set_flashdata('msg', 'Tugas berhasil ditambahkan! 🌸');
        }
        redirect('todo?day=all'); 
    }
    
    public function edit($id) {
        $data['todo'] = $this->Todo_model->get_todo_by_id($id);
        if (!$data['todo']) show_404();

        if ($this->input->post('submit')) {
            $title = $this->input->post('title', TRUE);
            if ($title) {
                $due_date = $this->input->post('due_date', TRUE);
                $due_time = $this->input->post('due_time', TRUE);
                $due_day  = $this->input->post('due_day', TRUE);
                $data_update = [
                    'title'    => $title,
                    'due_date' => empty($due_date) ? NULL : $due_date,
                    'due_time' => empty($due_time) ? NULL : $due_time,
                    'due_day'  => empty($due_day) ? NULL : $due_day,
                ];
                $this->Todo_model->update_todo($id, $data_update);
                $this->session->set_flashdata('msg', 'Tugas berhasil diedit! ✨');
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
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete($id) {
        $this->Todo_model->delete_todo($id);
        $this->session->set_flashdata('msg', 'Tugas dihapus! 🗑️');
        redirect($_SERVER['HTTP_REFERER']);
    }
}