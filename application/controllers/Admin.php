<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Upload_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['files'] = $this->Upload_model->get_all_files();
        $this->load->view('admin_files', $data);
    }
    public function delete($id)
    {
        if ($this->Upload_model->delete_file($id)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
    
}
