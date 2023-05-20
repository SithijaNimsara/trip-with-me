<?php
	class EditUser_model extends CI_Model {
        public function __construct(){
			$this->load->database();
		}

        public function getUserProfile($userId) {
            $type = $this->session->userdata('type');
			if($type=='business') {
                $queryBusiness = $this->db->get_where('hotel', array('hotel_id' => $userId));
                if ($queryBusiness->num_rows()==1){
                    return $queryBusiness->result();
                }else{
                    return false;
                }
            }else {
                $queryNormal = $this->db->get_where('user', array('user_id' => $userId));
                if ($queryNormal->num_rows()==1){
                    return $queryNormal->result();
                }else{
                    return false;
                }
            }


        }
    }