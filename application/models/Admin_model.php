<?php
class Admin_model extends CI_Model
{
    /// Products
    public function update_product($data, $code)
    {
        $this->db->where('id', $code);
        if ($this->db->update('products', $data))
            return true;
        else
            return false;
    }
    public function delete_product($data)
    {
        $this->db->where($data);
        $this->db->delete('products');
    }
    public function create_product($data)
    {
        if($this->db->insert('products', $data))
            return $this->db->insert_id();
        else
            return false;
    }

    /// Categories
    public function update_category($data, $code)
    {
        $this->db->where('id', $code);
        if ($this->db->update('categories', $data))
            return true;
        else
            return false;
    }
    public function delete_category($data)
    {
        $this->db->where($data);
        $this->db->delete('categories');
    }
    public function create_category($data)
    {
        if($this->db->insert('categories', $data))
            return $this->db->insert_id();
        else
            return false;
    }

    /// Tags
    public function update_tag($data, $code)
    {
        $this->db->where('id', $code);
        if ($this->db->update('tags', $data))
            return true;
        else
            return false;
    }
    public function delete_tag($data)
    {
        $this->db->where($data);
        $this->db->delete('tags');
    }
    public function create_tag($data)
    {
        if($this->db->insert('tags', $data))
            return $this->db->insert_id();
        else
            return false;
    }

    /// Users
    public function delete_user($data)
    {
        $this->db->where($data);
        $this->db->delete('users');
    }
    public function change_role($data, $role)
    {
        $this->db->where($data);
        $this->db->update('users', array("role" => $role));
    }
}
