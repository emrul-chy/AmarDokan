<?php
class Auth_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function signup($data)
    {
        $insert = $this->db->insert('users', $data);
        if ($insert) return true;
        return false;
    }

    public function signin($data)
    {
        $query = $this->db->get_where('users', $data);
        if ($query) return $query->row();
        return false;
    }
}
