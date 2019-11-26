<?php
class Delivery extends CI_Controller
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
								$data = array(
									"assigned_to" => $this->session->userdata('username'),
									"status" => "Accepted"
								);
								$this->load->model('Delivery_model');
								$this->orders = $this->db->get_where('orders', $data)->result();
								$this->db->query("SET SESSION sql_mode = ''");
				}
				public function panel($page = 'orders')
				{
								if ($this->session->userdata('role') != "Delivery Man") {
												redirect(base_url());
								}
								if (!file_exists(APPPATH . 'views/delivery/' . $page . '.php')) {
												show_404();
								}
								
								$this->title = $page;
								$this->load->view('delivery/template/header');
								$this->load->view('delivery/' . $page);
								$this->load->view('delivery/template/footer');
				}

				/// Order Section
				public function viewOrder($page = '')
				{
								if ($this->session->userdata('role') != "Delivery Man") {
												redirect(base_url());
								}
								$found = 0;
								$this->query = array();

								foreach ($this->orders as $order) {
									if($order->id == $page) {
										$this->query = $order;
										$found = 1;
									}
								}

								if (!$found) {
												show_404();
								}

								$this->title = "updateOrder";
								$data             = array(
									'order_id' => $page
								);
								$this->item            = $this->Delivery_model->get_item($data)->result();
								$this->load->view('delivery/template/header');
								$this->load->view('delivery/viewOrder');
								$this->load->view('delivery/template/footer');
				}
				
				public function updateOrder()
				{
								if ($this->session->userdata('role') != "Delivery Man") {
												redirect(base_url());
								}
								$found = 0;
								foreach ($this->orders as $order) {
									if($order->id == $this->input->post('order_id')) {
										$found = 1;
									}
								}
								$this->title = "updateOrder";
								if (!$found) {
												show_404();
								}
								$data = array(
									'status' => "Completed",
									'completed_time' => date("Y-m-d H:i:s", time())
								);
								$this->Delivery_model->update_order($data, $this->input->post('order_id'));
								redirect(base_url('delivery/panel'));
				}
}
