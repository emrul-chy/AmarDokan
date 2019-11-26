<?php
class Account_model extends CI_Model
{
    public function update_account($data)
    {
        $this->db->where('username', $this->session->userdata('username'));
        if ($this->db->update('users', $data))
            return true;
        else
            return false;
    }
    public function purchases($data)
    {
        $this->db->where('username', $this->session->userdata('username'));
        $query = $this->db->get('orders');

        if ($query)
            return $query;
        else
            return false;
    }
}
