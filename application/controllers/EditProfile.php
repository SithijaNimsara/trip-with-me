<?php

class EditProfile extends CI_Controller {

    function __construct() {
		parent::__construct();
        $this->load->model('EditUser_model');
		$this->load->helper('url');
	}


    public function editUser(){
        if($this->session->userdata('logIn')) {
            $user_id = $this->session->userdata('user_id');
            $result = $this->EditUser_model->getUserProfile($user_id);
            if ($result != false){
                $this->load->view('templates/header');
                $data= array(
                    'user' => $result
                );
                $this->load->view('edit_view',$data);
            }
            
        }
    }

    public function update(){
        
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // echo $this->input->post('email');
            echo 'POST';
        }
       
    }
}