<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct() {
        parent::__construct();
        $this->load->library("session");
    }

	public function index()
	{
		$this->load->view('common/header');
		$this->load->view('home');
		$this->load->view('common/footer');
	}

	public function registration()
	{
		if(!$this->session->userdata("Email")){
			$this->load->view('common/header');
			$this->load->view('registration');
			$this->load->view('common/footer');
		}else{
			redirect(base_url()."home/", "refresh");
		}

	}

	public function saveRegistrationInfo(){
		if($this->input->post()){
			$this->load->library('form_validation');

			$this->form_validation->set_rules("title", "title", "required");
			$this->form_validation->set_rules("fname", "first name", "trim|required|name");
			$this->form_validation->set_rules("lname", "first name", "trim|required|name");
			$this->form_validation->set_rules("email", "email address", "trim|required|email");
			$this->form_validation->set_rules("password", "password", "required");
			
			if($this->form_validation->run() == TRUE){
				$postdata = $this->input->post();
				$query = $this->db->query("Select id from users where email = '".$postdata['email']."'")->row();
				if(empty($query->id)){	
					$this->db->trans_start();
					$this->db->insert("users", array('firstName' => $postdata['fname'], 'lastName' => $postdata['lname'], 'email' => $postdata['email'], 'password' => $postdata['password'], 'title' => $postdata['title'], 'updated_date' => date("Y-m-d H:i:s"), 'status' => 1));
					$this->db->trans_complete();
					if ($this->db->trans_status() != FALSE) {
		               $data['success_message'] = "Successfully Registered";
		           } else {
		               $data['error_msg'] = "Something went wrong";
		           }
					
				}else{
					$data['error_msg'] = "You have already registered with this email";
				}

				$this->load->view('common/header');
				$this->load->view('registration', $data);
				$this->load->view('common/footer');
			}else{
				$this->load->view('common/header');
				$this->load->view("registration");
				$this->load->view('common/footer');
			}
		}
		else{
			redirect(base_url()."home/registration", "refresh");
		}
	}

	public function signIn(){
		if($this->input->post()){
			$postdata = $this->input->post();
			$query = $this->db->get("users", array("email" => $postdata['loginemail'],"password" => $postdata['loginpassword']))->row();
			
			if(count($query) > 0){
				$sessiondata = array(
					"FirstName" => $query->firstName,
					"LastName" => $query->lastName,
					"Email" => $query->email,
					);
				$this->session->set_userdata($sessiondata);

				$data['success'] = "Login Successfully";
			}else{
				$data['error'] = "Record not found";
			}

		}else{
			$data['error'] = "Something went wrong";
		}
		echo json_encode($data);
	}

	public function signout(){
		$array_items = array(
				"FirstName" => "",
				"LastName" => "",
				"Email" => "",
					);
		$this->session->unset_userdata($array_items);
		$this->session->sess_destroy();
		redirect(base_url()."home/", "refresh");
	}
}
