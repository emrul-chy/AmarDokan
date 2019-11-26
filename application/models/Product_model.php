<?php
class Product_model extends CI_Model
{
                public function __construct()
                {
                                $this->load->database();
                }
                public function get_product($data)
                {
                                $query = $this->db->get_where('products', $data);
                                if ($query) {
                                                return $query;
                                }
                                return false;
                }
}