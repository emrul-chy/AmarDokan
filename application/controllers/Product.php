<?php
class Product extends CI_Controller
{
				public function __construct()
				{
								date_default_timezone_set("Asia/Dhaka");
								parent::__construct();
								$this->load->library(array(
												'form_validation',
												'session'
								));
								$this->load->helper(array(
												'url',
												'html',
												'form'
								));
								$this->load->model('Product_model');
								$this->db->query("SET SESSION sql_mode = ''");
				}
				public function view($page = "")
				{
								if ($page == "") {
												redirect(base_url());
								}
								$this->product_id = $page;
								$this->page = $page;
								
								$data             = array(
									'visible' => 1,
												'id' => $this->product_id
								);
								$this->query            = $this->Product_model->get_product($data)->row();
								if($this->query == false) {
									show_404();
								}
								$data['title']    = $page;
		$this->load->view('templates/header', $data);
								$this->load->view('pages/view_product', $data);

		$this->load->view('templates/footer', $data);
				}
}
