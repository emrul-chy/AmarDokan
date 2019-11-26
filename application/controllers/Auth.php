<?php
class Auth extends CI_Controller
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

		$this->load->model('Auth_model');
		$this->db->query("SET SESSION sql_mode = ''");
	}
	public function signup()
	{
		if ($this->session->userdata('username') != "") {
			redirect(base_url());
		}
		$this->form_validation->set_rules('name', 'Name', 'required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password1', 'Password', 'required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Repeat Password', 'required|min_length[6]|max_length[40]');
		$this->form_validation->set_message('required', 'Enter %s');
		if ($this->form_validation->run() === FALSE) {
			$user = array(
				'error_msg' => validation_errors()
			);
			$this->session->set_userdata($user);
			redirect(base_url());
		} {
			$name      = htmlentities($this->input->post('name'));
			$username  = htmlentities($this->input->post('username'));
			$email     = htmlentities($this->input->post('email'));
			$password1 = htmlentities($this->input->post('password1'));
			$password1 = md5($password1);
			$password2 = htmlentities($this->input->post('password2'));
			$password2 = md5($password2);
			if ($password1 != $password2) {
				$user = array(
					'error_msg' => "Password do not match"
				);
				$this->session->set_userdata($user);
				redirect(base_url());
			}

			$data = array(
				'username' => $username
			);

			if ($this->Auth_model->signin($data)) {
				$user = array(
					'error_msg' => "Username already exits"
				);
				$this->session->set_userdata($user);
				redirect(base_url());
			}

			$data = array(
				'email' => $email
			);

			if ($this->Auth_model->signin($data)) {
				$user = array(
					'error_msg' => "Email already exits"
				);
				$this->session->set_userdata($user);
				redirect(base_url());
			}

			$data = array(
				'name' => $name,
				'username' => $username,
				'email' => $email,
				'password' => $password1
			);
			if ($this->Auth_model->signup($data)) {
				$user = array(
					'success_msg' => "Successfully Registered!"
				);
				$this->session->set_userdata($user);
				redirect(base_url());
			} else {
				$user = array(
					'error_msg' => "Error Occured"
				);
				$this->session->set_userdata($user);
				redirect(base_url());
			}
		}
	}
	public function signin()
	{
		if ($this->session->userdata('username') != "") {
			redirect(base_url());
		}
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[40]');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[40]');
		if ($this->form_validation->run() === FALSE) {
			$user = array(
				'error_msg' => validation_errors()
			);
			
			$this->session->set_userdata($user);
			redirect(base_url());
		} {
			$username      = htmlentities($this->input->post('username'));
			$password = htmlentities($this->input->post('password'));
			$password = md5($password);

			$data = array(
				'username' => $username,
				'password' => $password
			);
			$check = $this->Auth_model->signin($data);
			if ($check != false) {
				$user = array(
					'username' => $check->username,
					'name' => $check->name,
					'email' => $check->email,
					'role' => $check->role,
					'success_msg' => "Welcome " . $check->name
				);
				$this->session->set_userdata($user);
				redirect(base_url());
			} else {
				$user = array(
					'error_msg' => "Wrong username or password"
				);
				$this->session->set_userdata($user);
				redirect(base_url());
			}
		}
	}
	public function signout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
