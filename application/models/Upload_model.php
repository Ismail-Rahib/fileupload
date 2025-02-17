<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Upload_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Save file data to the database
    public function save_file($data)
    {
        return $this->db->insert('uploads', $data);
    }

    // Fetch all uploaded files
    public function get_all_files()
    {
        return $this->db->get('uploads')->result_array();
    }

    // Fetch a specific file by ID
    public function get_file($id)
    {
        return $this->db->get_where('uploads', array('id' => $id))->row_array();
    }

    public function delete_file($id)
    {
        $file = $this->db->get_where('uploads', ['id' => $id])->row();
        if ($file) {
            // Delete the file from the server
            if (file_exists($file->file_path)) {
                unlink($file->file_path);
            }
            // Remove from database
            return $this->db->delete('uploads', ['id' => $id]);
        }
        return false;
    }
}
