<?php
class Admin extends CI_Controller
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
								$this->load->model('Admin_model');
								$this->load->model('Order_model');
								$this->orders = $this->db->get('orders')->result();
                if(isset($_POST['status'])) {
                  $this->orders = $this->db->get_where('orders', array("status" => $_POST['status']))->result();
                }
                $this->users = $this->db->get('users')->result();
                if(isset($_POST['role'])) {
                  $this->users = $this->db->get_where('users', array("role" => $_POST['role']))->result();
                }
                $this->products = $this->db->get('products')->result();
                if(isset($_POST['visible'])) {
                	if($_POST['visible'] == 'Visible')
                  	$this->products = $this->db->get_where('products', array("visible" => 1))->result();
                	else
                		$this->products = $this->db->get_where('products', array("visible" => 0))->result();
                }
                $this->categories = $this->db->get('categories')->result();
                $this->tags = $this->db->get('tags')->result();
                if(isset($_POST['category'])) {
                	//echo $_POST['category']; die();
                	$this->tags = $this->db->get_where('tags', array('category' => htmlentities($_POST['category'])))->result();
                }


                $this->db->select_sum('total');
                $this->db->from('orders');
                $this->db->where('status', "Accepted");
                $this->db->where('accepted_time >= ', date("Y") . "-01-01 00:00:00");
                $this->annual_income = $this->db->get()->row()->total;

                $this->db->select_sum('total');
                $this->db->from('orders');
                $this->db->where('status', "Accepted");
                $this->db->where('accepted_time >= ', date("Y-m") . "-01 00:00:00");
                $this->monthly_income = $this->db->get()->row()->total;

                $total = sizeof($this->orders);
                $completed = sizeof($this->db->get_where('orders', array('status' => "Completed"))->result());
                $this->percentage = 100;
                if($total) $this->percentage =  ($completed / $total) * 100;


                $this->Submitted = $this->db->get_where('orders', array('status' => "Submitted"))->result();
                $this->Cancelled = $this->db->get_where('orders', array('status' => "Cancelled"))->result();
                $this->Accepted = $this->db->get_where('orders', array('status' => "Accepted"))->result();
                $this->Completed = $this->db->get_where('orders', array('status' => "Completed"))->result();

                $this->db->query("SET SESSION sql_mode = ''");
				}
				public function panel($page = 'index')
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								if (!file_exists(APPPATH . 'views/admin/' . $page . '.php')) {
												show_404();
								}
								
								$this->title = $page;
								$this->load->view('admin/template/header');
								$this->load->view('admin/' . $page);
								$this->load->view('admin/template/footer');
				}

				/// Product Section
				public function updateProduct($page = '')
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								$data        = array(
												'id' => $page
								);
								$this->title = "updateProduct";
								$this->query = $this->Product_model->get_product($data)->row();
								if ($this->query == false) {
												show_404();
								}
								$this->load->view('admin/template/header');
								$this->load->view('admin/updateProduct');
								$this->load->view('admin/template/footer');
				}
				public function deleteProduct($page = '')
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								$data        = array(
												'id' => $page
								);
								$this->title = "updateProduct";
								$this->query = $this->Product_model->get_product($data)->row();
								if ($this->query == false) {
												show_404();
								}
								$this->Admin_model->delete_product(array("id" => $page));
								redirect(base_url('admin/panel/products'));
				}
				public function updateProduct_process($page = '')
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								$data        = array(
												'id' => $page
								);

								$this->query = $this->Product_model->get_product($data)->row();
								if ($this->query == false) {
												show_404();
								}


								$name        = htmlentities($this->input->post('name'));
								$description = htmlentities($this->input->post('description'));
								$category    = htmlentities($this->input->post('category'));
								$tag         = htmlentities($this->input->post('tag'));
								$amount      = htmlentities($this->input->post('amount'));
								$discount    = htmlentities($this->input->post('discount'));
								$in_stock    = htmlentities($this->input->post('in_stock'));
								$visible     = 0;
								if (isset($_POST['visible'])) {
												$visible = 1;
								}
								$top_product = 0;
								if (isset($_POST['top_product'])) {
												$top_product = 1;
								}
								$special_offer = 0;
								if (isset($_POST['special_offer'])) {
												$special_offer = 1;
								}
								$special_deal = 0;
								if (isset($_POST['special_deal'])) {
												$special_deal = 1;
								}
								$show_img1 = $this->query->show_img1;
								$show_img2 = $this->query->show_img2;
								$show_img3 = $this->query->show_img3;

								$config['upload_path']   = './images/products';
								$config['allowed_types'] = 'gif|jpg|png';
								$config['max_size']      = 100;
								$config['max_width']     = 1024;
								$config['max_height']    = 768;

								$new_name                = $page . "_1_" . time();
								$config['file_name']     = $new_name;
								$this->load->library('upload', $config);

								if (!$this->upload->do_upload('show_img1')) {
								} else {
												$show_img1 = "images/products/" . $this->upload->data('file_name');
												
								}

								$new_name                = $page . "_2_" . time();
								$config['file_name']     = $new_name;
								$this->load->library('upload', $config);

								if (!$this->upload->do_upload('show_img2')) {
								} else {
												$show_img2 = "images/products/" . $this->upload->data('file_name');
												
								}

								$new_name                = $page . "_3_" . time();
								$config['file_name']     = $new_name;
								$this->load->library('upload', $config);

								if (!$this->upload->do_upload('show_img3')) {
								} else {
												$show_img3 = "images/products/" . $this->upload->data('file_name');
												
								}

								$data = array(
												"name" => $name,
												"description" => $description,
												"category" => $category,
												"tag" => $tag,
												"amount" => $amount,
												"discount" => $discount,
												"in_stock" => $in_stock,
												"visible" => $visible,
												"top_product" => $top_product,
												"special_deal" => $special_deal,
												"special_offer" => $special_offer,
												"show_img1" => $show_img1,
												"show_img2" => $show_img2,
												"show_img3" => $show_img3
								);
								$this->Admin_model->update_product($data, $page);
								redirect(base_url('admin/panel/products'));
				}
				public function createProduct_process($page = '')
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}

								$name        = htmlentities($this->input->post('name'));
								$description = htmlentities($this->input->post('description'));
								$category    = htmlentities($this->input->post('category'));
								$tag         = htmlentities($this->input->post('tag'));
								$amount      = htmlentities($this->input->post('amount'));
								$discount    = htmlentities($this->input->post('discount'));
								$in_stock    = htmlentities($this->input->post('in_stock'));
								$visible     = 0;
								if (isset($_POST['visible'])) {
												$visible = 1;
								}
								$top_product = 0;
								if (isset($_POST['top_product'])) {
												$top_product = 1;
								}
								$special_offer = 0;
								if (isset($_POST['special_offer'])) {
												$special_offer = 1;
								}
								$special_deal = 0;
								if (isset($_POST['special_deal'])) {
												$special_deal = 1;
								}
								$show_img1 = "";
								$show_img2 = "";
								$show_img3 = "";

								$data = array(
												"name" => $name,
												"description" => $description,
												"category" => $category,
												"tag" => $tag,
												"amount" => $amount,
												"discount" => $discount,
												"in_stock" => $in_stock,
												"visible" => $visible,
												"top_product" => $top_product,
												"special_deal" => $special_deal,
												"special_offer" => $special_offer,
								);
								$id = $this->Admin_model->create_product($data);

								$config['upload_path']   = './images/products';
								$config['allowed_types'] = 'gif|jpg|png';
								$config['max_size']      = 100;
								$config['max_width']     = 1024;
								$config['max_height']    = 768;

								$new_name                = $id . "_1_" . time();
								$config['file_name']     = $new_name;
								$this->load->library('upload', $config);

								if (!$this->upload->do_upload('show_img1')) {
								} else {
												$show_img1 = "images/products/" . $this->upload->data('file_name');
												
								}

								$new_name                = $id . "_2_" . time();
								$config['file_name']     = $new_name;
								$this->load->library('upload', $config);

								if (!$this->upload->do_upload('show_img2')) {
								} else {
												$show_img2 = "images/products/" . $this->upload->data('file_name');
												
								}

								$new_name                = $id . "_3_" . time();
								$config['file_name']     = $new_name;
								$this->load->library('upload', $config);

								if (!$this->upload->do_upload('show_img3')) {
								} else {
												$show_img3 = "images/products/" . $this->upload->data('file_name');
												
								}

								$data = array(
												"show_img1" => $show_img1,
												"show_img2" => $show_img2,
												"show_img3" => $show_img3
								);
								$this->Admin_model->update_product($data, $id);
								redirect(base_url('admin/panel/products'));
				}


				/// Order Section
				public function viewOrder($page = '')
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								$data        = array(
												'id' => $page
								);
								$this->title = "viewOrder";
								$this->query = $this->Order_model->get_order($data)->row();
								if ($this->query == false) {
												show_404();
								}
								$data             = array(
									'order_id' => $page
								);
								$this->item            = $this->Order_model->get_item($data)->result();
								$this->load->view('admin/template/header');
								$this->load->view('admin/viewOrder');
								$this->load->view('admin/template/footer');
				}
				public function acceptOrder()
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								$data        = array(
												'id' => $this->input->post('order_id'),
												'status' => 'Submitted'
								);
								$this->title = "acceptOrder";
								$this->query = $this->Order_model->get_order($data)->row();
								if ($this->query == false) {
												show_404();
								}

								$data             = array(
										'order_id' => $this->input->post('order_id'),
								);
								$this->item            = $this->Order_model->get_item($data)->result();
								
								foreach ($this->item as $product) {
									$cur = $this->db->get_where('products', array('id' => $product->product_id))->row();
									$this->db->where('id', $product->product_id);
									$data = array(
										'in_stock' => $cur->in_stock - $product->quantity
									);
									$this->db->update('products', $data);
								}
								$data = array(
									'assigned_to' => $this->input->post('assigned_to'),
									'deadline' => date("Y-m-d", strtotime($this->input->post('deadline'))),
									'note' => htmlentities($this->input->post('note')),
									'status' => "Accepted",
									'accepted_time' => date("Y-m-d H:i:s", time())
								);
								$this->Order_model->update_order($data, $this->input->post('order_id'));
								redirect(base_url('admin/viewOrder/' . $this->input->post('order_id')));
				}
				public function updateOrder()
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								$data        = array(
												'id' => $this->input->post('order_id'),
												'status' => 'Accepted'
								);
								$this->title = "updateOrder";
								$this->query = $this->Order_model->get_order($data)->row();
								if ($this->query == false) {
												show_404();
								}

								$data = array(
									'assigned_to' => $this->input->post('assigned_to'),
									'deadline' => date("Y-m-d", strtotime($this->input->post('deadline'))),
									'note' => htmlentities($this->input->post('note')),
								);
								$this->Order_model->update_order($data, $this->input->post('order_id'));
								redirect(base_url('admin/viewOrder/' . $this->input->post('order_id')));
				}

				/// User Section
				public function deleteUser($page = '')
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								$data        = array(
												'username' => $page
								);
								$this->query = $this->db->get_where('users', $data)->row();
								if ($this->query == false) {
												show_404();
								}
								$this->Admin_model->delete_user(array("username" => $page));
								redirect(base_url('admin/panel/users'));
				}
				public function makeAdmin($page = '')
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								$data        = array(
												'username' => $page,
												'role !=' => "Admin"
								);
								$this->query = $this->db->get_where('users', $data)->row();
								if ($this->query == false) {
												show_404();
								}
								$this->Admin_model->change_role(array("username" => $page), "Admin");
								redirect(base_url('admin/panel/users'));
				}
				public function makeUser($page = '')
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								$data        = array(
												'username' => $page,
												'role !=' => "User"
								);
								$this->query = $this->db->get_where('users', $data)->row();
								if ($this->query == false) {
												show_404();
								}
								$this->Admin_model->change_role(array("username" => $page), "User");
								redirect(base_url('admin/panel/users'));
				}
				public function makeDeliveryMan($page = '')
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								$data        = array(
												'username' => $page,
												'role !=' => "Delivery Man"
								);
								$this->query = $this->db->get_where('users', $data)->row();
								if ($this->query == false) {
												show_404();
								}
								$this->Admin_model->change_role(array("username" => $page), "Delivery Man");
								redirect(base_url('admin/panel/users'));
				}

				/// Category Section
				public function updateCategory($page = '')
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								$data        = array(
												'id' => $page
								);
								$this->title = "updateCategory";
								$this->query = $this->db->get_where('categories', $data)->row();
								if ($this->query == false) {
												show_404();
								}
								$this->load->view('admin/template/header');
								$this->load->view('admin/updateCategory');
								$this->load->view('admin/template/footer');
				}
				public function updateCategory_process($page = '')
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								$data        = array(
												'id' => $page
								);

								$this->query = $this->db->get_where('categories', $data)->row();
								if ($this->query == false) {
												show_404();
								}

								$name        = htmlentities($this->input->post('name'));

								$data = array(
												"name" => $name
								);
								$this->Admin_model->update_category($data, $page);
								redirect(base_url('admin/panel/categories'));
				}
				public function createCategory_process()
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								$data        = array(
												'id' => $page
								);

								$name        = htmlentities($this->input->post('name'));

								$data = array(
												"name" => $name
								);

								$this->Admin_model->create_category($data);
								redirect(base_url('admin/panel/categories'));
				}
				public function deleteCategory($page = '')
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								$data        = array(
												'id' => $page
								);
								$this->title = "updateCategory";
								$this->query = $this->db->get_where('categories', $data)->row();
								if ($this->query == false) {
												show_404();
								}
								$this->Admin_model->delete_category(array("id" => $page));
								redirect(base_url('admin/panel/categories'));
				}

				/// Tag Section
				public function updateTag($page = '')
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								$data        = array(
												'id' => $page
								);
								$this->title = "updateTag";
								$this->query = $this->db->get_where('tags', $data)->row();
								if ($this->query == false) {
												show_404();
								}
								$this->load->view('admin/template/header');
								$this->load->view('admin/updateTag');
								$this->load->view('admin/template/footer');
				}
				public function updateTag_process($page = '')
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								$data        = array(
												'id' => $page
								);

								$this->query = $this->db->get_where('tags', $data)->row();
								if ($this->query == false) {
												show_404();
								}

								$name        = htmlentities($this->input->post('name'));
								$category        = htmlentities($this->input->post('category'));
								$top = 0;

								if(isset($_POST['top'])) $top = 1;

								$data = array(
												"name" => $name,
												"category" => $category,
												"top" => $top
								);
								$this->Admin_model->update_tag($data, $page);
								redirect(base_url('admin/panel/tags'));
				}
				public function createTag_process()
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								$data        = array(
												'id' => $page
								);

								$name        = htmlentities($this->input->post('name'));
								$category        = htmlentities($this->input->post('category'));
								$top = 0;

								if(isset($_POST['top'])) $top = 1;

								$data = array(
												"name" => $name,
												"category" => $category,
												"top" => $top
								);
																$this->Admin_model->create_tag($data);
								redirect(base_url('admin/panel/tags'));
				}
				public function deleteTag($page = '')
				{
								if ($this->session->userdata('role') != "Admin") {
												redirect(base_url());
								}
								$data        = array(
												'id' => $page
								);
								$this->title = "updateTag";
								$this->query = $this->db->get_where('tags', $data)->row();
								if ($this->query == false) {
												show_404();
								}
								$this->Admin_model->delete_tag(array("id" => $page));
								redirect(base_url('admin/panel/tags'));
				}
}
