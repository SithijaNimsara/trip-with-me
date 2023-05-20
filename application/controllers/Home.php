<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
   
    function __construct() {
		parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Comments_model');
        $this->load->model('Post_model');
        $this->load->model('Search_model');
        $this->load->model('Likes_model');
		$this->load->helper('url');
	}
    

    public function user(){

        // $this->load->library('form_validation');
        // $this->session->unset_userdata('user_id');
        // $this->session->unset_userdata('logIn');
       


        // $result = $this->User_model->userView();
        // $this->load->view('templates/header');
        // $data= array(
        //     'user' => $result,                    
        //     'post' => $this->User_model->postList(),
        //     'comment' => $this->Comments_model->commnetList()
        // );
        // $this->load->view('user_view', $data);

        $this->load->library('form_validation');


        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        
        if($this->session->userdata('logIn')) {    
           
            $resultSession = $this->User_model->userViewBySession();   
            // print_r($resultSession);     
            if ($resultSession != false){
                 
                $this->load->view('templates/header');
                if($this->session->userdata('type')=='business') {
                    $dataSession= array(
                        'hotel' => $resultSession,                    
                        'post' => $this->User_model->postList(),
                        'comment' => $this->Comments_model->commnetList()
                    );
                    $this->load->view('business_view', $dataSession);
                }else {
                    $dataSession= array(
                        'user' => $resultSession,                    
                        'post' => $this->User_model->postList(),
                        'comment' => $this->Comments_model->commnetList(),
                        'like' => $this->Likes_model->userLikeDetails(),
                        'count' => $this->Likes_model->likeCount()

                    );
                    // print_r($this->User_model->postList()[0]->post_id);
                    // print_r($this->Likes_model->likeCount());
                    $this->load->view('user_view', $dataSession);
                }



                // $dataSession= array(
                //     'user' => $resultSession,                    
                //     'post' => $this->User_model->postList(),
                //     'comment' => $this->Comments_model->commnetList()
                // );


                // $this->load->view('user_view', $dataSession);
            }
        }
        else {
            
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('login_view');
            }
            else {
                $result = $this->User_model->userView();
                if ($result != false){ 
                    $this->load->view('templates/header');
                    if($this->session->userdata('type')=='business') {
                        $data= array(
                            'hotel' => $result,                    
                            'post' => $this->User_model->postList(),
                            'comment' => $this->Comments_model->commnetList()
                        );
                        $this->load->view('business_view', $data);
                    }else {
                        $data= array(
                            'user' => $result,                    
                            'post' => $this->User_model->postList(),
                            'comment' => $this->Comments_model->commnetList(),
                            'like' => $this->Likes_model->userLikeDetails(),
                            'count' => $this->Likes_model->likeCount()
                        );
                       
                        $this->load->view('user_view', $data);
                    }   
                }
                else {
                    print_r("redirect");
                    // redirect('/User/index');
                }   
            }
        }        
    }

    public function businessUser(){

            $this->load->view('templates/header');
            $this->load->view('business_view');
        
        
    }

    public function search(){
        $hotel = $this->Search_model->searchHotel();
        $user = $this->User_model->userViewBySession();
        
        $data= array(
            'user' => $user,
            'hotel' => $hotel
        );
        $this->load->view('templates/header');
        $this->load->view('search_view',$data);
    }

    // public function searchTag(){
       
    //     $hotel = $this->Search_model->searchByTag();
    //     $user = $this->User_model->userViewBySession();

    // }



    public function comment(){
       
        if($this->session->userdata('logIn')) {
            $data = array(
                'comment' => $this->input->post('comment'),
                'user_id' => $this->session->userdata('user_id'),                                        //---------------------------Session------------------------------------------------------------------
                // 'post_id' => $this->uri->segment(3)
                'post_id' => $this->input->post('postId')
            );
    
            $this->Comments_model->insertCommnet($data);
        }
        
        // redirect('/Home/user/');
    }

    public function logOut(){
        $this->session->sess_destroy();
        $this->load->view('Templates/Header');
        $this->load->view('login_view');
    }

    public function deletePost(){
        $postId = $this->uri->segment(3);
        $this->Post_model->deletePost($postId); 
    }

    public function newPost(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('text-area', 'Text', 'required');
        $this->form_validation->set_rules('img', 'Image', 'required');
        $this->Post_model->createPost();
        redirect('/Home/user/');
    }

    public function like(){
        print_r($this->input->post('postId'));
        if($this->session->userdata('logIn')) {
            $data = array(
                'user_id' => $this->session->userdata('user_id'),                                        //---------------------------Session------------------------------------------------------------------
                'post_id' => $this->input->post('postId')
            );
    
            $this->Likes_model->addLike($data);
        }
    }

    public function likeCount(){
        $postId=  $this->input->post("postId");
        $result=  $this->Likes_model->getLikeCount($postId);
        echo $result['likes_count'];
    }
    
    
}