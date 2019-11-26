<?php
class Order_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function insert_order($data)
    {
        $insert = $this->db->insert('orders', $data);
        return $this->db->insert_id();
    }

    public function insert_product($data)
    {
        $this->db->insert('ordered_product_list', $data);
    }

    public function cancel_order($data)
    {
        $this->db->where($data);

        $can = array(
            "status" => "Cancelled",
            "cancelled_time" => date("Y/m/d H:i:s", time())
        );
        if ($this->db->update('orders', $can))
            return true;
        else
            return false;
    }

    public function update_order($data, $id)
    {
        $this->db->where('id', $id);
        if ($this->db->update('orders', $data))
            return true;
        else
            return false;
    }

    public function get_order($data)
    {
        $query = $this->db->get_where('orders', $data);
        if ($query) {
                        return $query;
        }
        return false;
    }

    public function get_item($data)
    {
        $query = $this->db->get_where('ordered_product_list', $data);
        if ($query) {
                        return $query;
        }
        return false;
    }
}
