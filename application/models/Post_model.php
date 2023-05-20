<?php
	class Post_model extends CI_Model {

        public function __construct(){
			$this->load->database();
		}

        public function deletePost($postId) {
            $this->db->delete('like', array('post_id' => $postId));
            $this->db->delete('comment', array('post_id' => $postId));
            $this->db->delete('post', array('post_id' => $postId));
           
        }

        public function createPost() {
            $img = file_get_contents($_FILES['img']['tmp_name']);
            $data = array(
                'caption' => $this->input->post('text-area'),
                'image' => $img,
                'hotel_id' => $this->input->post('hotelId')
            );
            $this->db->insert('post', $data);
        }

    }