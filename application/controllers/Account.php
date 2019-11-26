<?php
class Account extends CI_Controller
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

		
		$this->load->model('Account_model');
		$this->load->model('Auth_model');
		$this->db->query("SET SESSION sql_mode = ''");
	}

	public function purchase($page = 1)
	{
		if ($this->session->userdata('username') == "") {
			redirect(base_url());
		}
		$data['title'] = $page;

		$this->pageno = $page;

		$data             = array(
			'username' => $this->session->userdata('username'),
		);
		$this->query            = $this->Account_model->purchases($data)->result();
		

		$this->load->view('templates/header', $data);
		$this->load->view('pages/purchase', $data);
		$this->load->view('templates/footer', $data);
	}

	public function profile()
	{
		if ($this->session->userdata('username') == "") {
			redirect(base_url());
		}
		$this->load->view('templates/header');
		$this->load->view('pages/profile');
		$this->load->view('templates/footer');
	}

	public function email()
	{
		if ($this->session->userdata('username') == "") {
			redirect(base_url());
		}
		$this->load->view('templates/header');
		$this->load->view('pages/email');
		$this->load->view('templates/footer');
	}

	public function password()
	{
		if ($this->session->userdata('username') == "") {
			redirect(base_url());
		}
		$this->load->view('templates/header');
		$this->load->view('pages/password');
		$this->load->view('templates/footer');
	}

	public function update_password()
	{
		if ($this->session->userdata('username') == "") {
			redirect(base_url());
		}

		//echo "oka"; die();

		$this->form_validation->set_rules('old_password', 'Old Password', 'required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('new_password1', 'New Password', 'required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('new_password2', 'Confirm Password', 'required|min_length[6]|max_length[32]');
		$this->form_validation->set_message('required', 'Enter %s');
		
		if ($this->form_validation->run() === FALSE) {
			$user = array(
				'error_msg' => validation_errors()
			);
			
			$this->session->set_userdata($user);
			redirect(base_url() . 'account/password');
		}

		$username      = $this->session->userdata('username');
		$password = htmlentities($this->input->post('old_password'));
		$password = md5($password);

		$data = array(
			'username' => $username,
			'password' => $password
		);
		$check = $this->Auth_model->signin($data);
		if($check == false) {
			$user = array(
				'error_msg' => "Wrong password"
			);
			$this->session->set_userdata($user);
			redirect(base_url() . 'account/password');
		}
		$password1 = htmlentities($this->input->post('new_password1'));
		$password1 = md5($password1);
		$password2 = htmlentities($this->input->post('new_password2'));
		$password2 = md5($password2);
		if($password1 != $password2) {
			$user = array(
				'error_msg' => "Passwords do not match"
			);
			$this->session->set_userdata($user);
			redirect(base_url() . 'account/password');
		}

		$data = array(
			'password' => $password1
		);

		if($this->Account_model->update_account($data)) {
			$user = array(
				'success_msg' => "Password Updated"
			);
			$this->session->set_userdata($user);
			redirect(base_url() . 'account/password');
		}
		$user = array(
			'error_msg' => "Error Occured."
		);
		$this->session->set_userdata($user);
		redirect(base_url() . 'account/password');
	}

	public function update_profile()
	{
		if ($this->session->userdata('username') == "") {
			redirect(base_url());
		}


		$this->form_validation->set_rules('name', 'Name', 'required|min_length[4]|max_length[32]');
		$this->form_validation->set_message('required', 'Enter %s');
		
		if ($this->form_validation->run() === FALSE) {
			$user = array(
				'error_msg' => validation_errors()
			);
			
			$this->session->set_userdata($user);
			redirect(base_url() . 'account/profile');

		}

		$data = array(
			'name' => htmlentities($this->input->post('name'))
		);

		if($this->Account_model->update_account($data)) {
			$user = array(
				'name' => htmlentities($this->input->post('name')),
				'success_msg' => "Profile Updated"
			);
			$this->session->set_userdata($user);
			redirect(base_url() . 'account/profile');
		}
		$user = array(
			'error_msg' => "Error Occured."
		);
		$this->session->set_userdata($user);
		redirect(base_url() . 'account/profile');
	}
}
