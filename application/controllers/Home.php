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
	public function index()
	{
		$this->load->view('common/header');
		$this->load->view('home');
		$this->load->view('common/footer');
	}

	public function registration()
	{
		$this->load->view('common/header');
		$this->load->view('registration');
		$this->load->view('common/footer');
	}

	public function saveRegistrationInfo(){
		$postdata = $this->input->post();
		print_r($postdata); die("PostData");
		$query = $this->db->query("Select id from users where email = '".$postdata['email']."'");
			$this->db->insert("users", array('firstName' => $postdata['fname'], 'lastName' => $postdata['lname'], 'email' => $postdata['email'], 'password' => $postdata['password'], 'title' => $postdata['title']));
	}
}
