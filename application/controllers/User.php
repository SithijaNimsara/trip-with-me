<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Comments_model');
		$this->load->model('User_model');
	}

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index() {
		$this->load->view('login_view');
	}

	public function signUp() {
		$this->load->view('sign_up');
	}

	public function register() {
		$this->load->library('form_validation');

		// $this->form_validation->set_rules('img', 'Image', 'required');
        $this->form_validation->set_rules('uname', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('state', 'State', 'required');
		$this->form_validation->set_rules('pw', 'Password', 'required');
        $this->form_validation->set_rules('repeatpw', 'Repeat Password', 'required|matches[pw]');
		$this->form_validation->set_rules('country', 'Country');
		$this->form_validation->set_rules('business', 'business');
		

		if ($this->form_validation->run() == FALSE) {
            $this->load->view('login_view');
        }
        else {
			$result = $this->User_model->registerUser();
			if ($result != false){
				if($this->session->userdata('type')=='business') {
					$this->load->view('templates/header');
					$data= array(
						'hotel' => $result,                    
						'post' => $this->User_model->postList(),
						'comment' => $this->Comments_model->commnetList()
					);
					$this->load->view('business_view', $data);
				}
				else {
					
					$this->load->view('templates/header');
					$data= array(
						'user' => $result,                    
						'post' => $this->User_model->postList(),
						'comment' => $this->Comments_model->commnetList()
					);
					$this->load->view('user_view', $data);
				}
			}
			
		}


	}

	// public function signIn() {
		
	// }
}
