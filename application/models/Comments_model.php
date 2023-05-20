<?php
	class Comments_model extends CI_Model {
        public function __construct(){
			$this->load->database();
		}

        public function commnetList() {
			$this->db->select('c.comment_id, c.comment, c.time, c.post_id, u.user_id, u.name, u.image');
			// $this->db->select('c.comment_id, c.post_id');
			$this->db->from('comment as c');
			$this->db->join('user u', 'u.user_id = c.user_id');
			$query = $this->db->get();
			return $query->result();
		}

        public function insertCommnet($data) {
			print_r($data['comment']);
			$sql = "INSERT INTO comment (comment, user_id, post_id) VALUES ('" .$data['comment']. "', " .$data['user_id']. ", " .intval($data['post_id']). ")";
			$this->db->query($sql);
			echo $this->db->affected_rows();

		}
    
    
    
    
    }