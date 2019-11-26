<?php
class Category extends CI_Controller
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
								$this->load->model('Category_model');
								$this->db->query("SET SESSION sql_mode = ''");
				}
				public function view($page = "")
				{
								if ($page == "") {
												redirect(base_url());
								}
								$this->category_id = $page;
								$this->page       = $page;
								$data             = array(
												'id' => $this->category_id
								);
								$this->query      = $this->Category_model->get_category($data)->row();
								if ($this->query == false) {
												show_404();
								}
								$data['title'] = $page;
								if(isset($_POST['subcategories'])) {
									$this->subcategories = $_POST['subcategories'];
									$this->load->view('templates/header', $data);
									$this->load->view('pages/view_category_by_tag', $data);
									$this->load->view('templates/footer', $data);
								}
								else {
									$this->load->view('templates/header', $data);
									$this->load->view('pages/view_category', $data);
									$this->load->view('templates/footer', $data);
								}
				}
}
