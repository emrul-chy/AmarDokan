<?php
class Category_model extends CI_Model
{
                public function __construct()
                {
                                $this->load->database();
                }
                public function get_category($data)
                {
                                $query = $this->db->get_where('categories', $data);
                                if ($query) {
                                                return $query;
                                }
                                return false;
                }
}