<?php
	class Likes_model extends CI_Model {

        public function __construct(){
			$this->load->database();
		}

        public function addLike($data) {
            $sql = "INSERT INTO `like` (user_id, post_id) VALUES (" .$data['user_id']. ", " .$data['post_id']. ")";
			$this->db->query($sql);
			echo $this->db->affected_rows();
           
        }

        public function getLikeCount($post_id) {
            $this->db->select("COUNT(*) AS likes_count");
            $this->db->from("like");
            $this->db->where("post_id", $post_id);
            $result= $this->db->get();  
            return $result->row_array();

        }

        public function userLikeDetails() {
            $userId = $this->session->userdata('user_id');
            $this->db->select("like_id, user_id, post_id");
            $this->db->from("like");
            $this->db->where("user_id", $userId);
            $result= $this->db->get();  
            return $result->result();
        }

        public function likeCount() {
            $this->db->select("like_id, user_id, post_id");
            $this->db->from("like");
            $result= $this->db->get();  
            return $result->result();
        }
    }