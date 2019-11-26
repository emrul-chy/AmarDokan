<?php
class Delivery_model extends CI_Model
{
                public function __construct()
                {
                                $this->load->database();
                }
                public function update_order($data, $id)
                {
                                $this->db->where('id', $id);
                                if ($this->db->update('orders', $data))
                                                return true;
                                else
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
