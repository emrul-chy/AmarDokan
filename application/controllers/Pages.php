<?php
class Pages extends CI_Controller
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
				public function view($page = 'index')
				{
								if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
												show_404();
								}
								if ($page == "thankyou") {
												if ($this->session->userdata('success_msg') != "thankyou") {
																redirect(base_url());
												}
												$this->session->unset_userdata('success_msg');
								}
								$this->page    = $page;
								$data['title'] = $page;
								$this->load->view('templates/header', $data);
								$this->load->view('pages/' . $page, $data);
								$this->load->view('templates/footer', $data);
				}
				public function search()
				{
								if($this->input->post('search') == "") {
									redirect(base_url());
								}
								$data        = array(
										'visible' => 1, 
												'name' => $this->input->post('search')
								);
								$this->query = $this->Product_model->get_product($data)->row();
								if($this->query == false) {
									$data        = array(
												'error_msg' => "This product is not available"
									);
									$this->session->set_userdata($data);
									redirect(base_url());
								}

								redirect(base_url("product/view/" . $this->query->id));
				}
}
