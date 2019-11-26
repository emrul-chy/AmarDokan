<?php
class Order extends CI_Controller
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

		$this->load->model('Order_model');
		$this->db->query("SET SESSION sql_mode = ''");
	}
	public function view($page) {

		if ($this->session->userdata('username') == "") {
			redirect(base_url());
		}
		if ($page == "") {
			redirect(base_url());
		}
		$this->order_id = $page;
		$this->page = $page;
		$data             = array(
						'username' => $this->session->userdata('username'),
						'id' => $this->order_id
		);
		$this->query            = $this->Order_model->get_order($data)->row();
		if($this->query == false) {
			show_404();
		}
		$data             = array(
						'order_id' => $this->order_id
		);
		$this->item            = $this->Order_model->get_item($data)->result();

		$this->load->view('templates/header', $data);
		$this->load->view('pages/view_order', $data);
		$this->load->view('templates/footer', $data);
	}
	public function cancel($page) {

		if ($this->session->userdata('username') == "") {
			redirect(base_url());
		}
		if ($page == "") {
			redirect(base_url());
		}
		$this->order_id = $page;
		$this->page = $page;
		$data             = array(
						'username' => $this->session->userdata('username'),
						'status' => "Submitted",
						'id' => $this->order_id
		);
		$this->query            = $this->Order_model->get_order($data)->row();
		if($this->query == false) {
			show_404();
		}
		$this->Order_model->cancel_order($data);
		redirect(base_url('order/view/' . $this->order_id));
	}
	public function process()
	{
		if ($this->session->userdata('username') == "") {
			redirect(base_url());
		}

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('mobile_number', 'Mobile Number', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');
		
		$this->form_validation->set_message('required', 'Enter %s');
		if ($this->form_validation->run() === FALSE) {
			$user = array(
				'error_msg' => validation_errors()
			);
			$this->session->set_userdata($user);
			redirect(base_url());
		}

		$username = htmlentities($this->session->userdata('username'));
		$name = htmlentities($this->input->post('name'));
		$mobile_number = htmlentities($this->input->post('mobile_number'));
		$address = htmlentities($this->input->post('address'));
		$city = htmlentities($this->input->post('city'));
		$total = htmlentities($this->input->post('total'));

		$delivery_charge = 0;
		if($total < 3000) {
			$delivery_charge = 20;
		}

		if($city == "Select Your City") {
			$user = array(
				'error_msg' => "Please Enter City"
			);
			$this->session->set_userdata($user);
			redirect(base_url());
		}

		$data = array(
			'username' => $username,
			'name' => $name,
			'mobile_number' => $mobile_number,
			'address' => $address,
			'city' => $city,
			'total' => $total,
			'delivery_charge' => $delivery_charge
		);

		$order_id = $this->Order_model->insert_order($data);

		for ($i = 1; ; $i++) {
			if (isset($_POST['item_number_' . $i])) {
				$data = array(
					'order_id' => $order_id,
					'product_id' => $_POST['item_number_' . $i],
					'product_name' => $_POST['item_name_' . $i],
					'quantity' => $_POST['quantity_' . $i],
					'amount' => $_POST['amount_' . $i]
				);
				$this->Order_model->insert_product($data);				
			} else {
								break;
			}
		}
		$data = array(
			"success_msg" => "thankyou"
		);
		$this->session->set_userdata($data);

		//echo $this->session->userdata('success_msg'); die();
		redirect(base_url('thankyou'));
	}
}
