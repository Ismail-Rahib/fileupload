<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Upload_model'); // Load the model
        $this->load->helper(array('form', 'url'));
        $this->load->library('upload');
    }

    public function index() {
        $this->load->view('upload_form', array('error' => ''));
    }

    public function do_upload() {
        $config['upload_path']   = FCPATH . 'uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;
    
        $this->upload->initialize($config);
    
        if (!$this->upload->do_upload('userfile')) {
            echo json_encode(['status' => 'error', 'error' => strip_tags($this->upload->display_errors())]);
            return;
        }
    
        $upload_data = $this->upload->data();
        $file_data = [
            'file_name' => $upload_data['file_name'],
            'file_type' => $upload_data['file_type'],
            'file_size' => $upload_data['file_size'],
            'file_path' => 'uploads/' . $upload_data['file_name']
        ];
    
        $this->Upload_model->save_file($file_data);
    
        echo json_encode([
            'status' => 'success',
            'file_name' => $upload_data['file_name'],
            'file_path' => base_url('uploads/' . $upload_data['file_name']),
            'file_ext' => $upload_data['file_ext']
        ]);
    }
    
}
?>