<?php
	class User_model extends CI_Model {
        public function __construct(){
			$this->load->database();
		}

        public function userView(){
			$email =  $this->input->post('email');
			$password = $this->input->post('password');
			$queryNormal = $this->db->get_where('user', array('email' => $email));
			$queryBusiness = $this->db->get_where('hotel', array('email' => $email));
			if ($queryNormal->num_rows()==1){
				$isPasswordNormal = password_verify($password, $queryNormal->result()['0']->password);
				if($isPasswordNormal) {
					$user_data = array(
                        'user_id'=>$queryNormal->result()['0']->user_id,
                        'logIn'=>true,
						'type'=> 'normal'
                    );
                    $this->session->set_userdata($user_data);
					// print_r($this->session->userdata('type'));
					return $queryNormal->result();
				}
				
			}
			else if ($queryBusiness->num_rows()==1) {
				$isPasswordBusiness = password_verify($password, $queryBusiness->result()['0']->password);
				if($isPasswordBusiness) {
					$user_data = array(
                        'user_id'=>$queryBusiness->result()['0']->hotel_id,
                        'logIn'=>true,
						'type'=> 'business'
                    );
                    $this->session->set_userdata($user_data);
					// print_r($this->session->userdata('type'));
					return $queryBusiness->result();
				}

			}
			else{
				return false;
			}
		}

		public function userViewBySession() {
			
			if($this->session->userdata('logIn')) {
				$userId = $this->session->userdata('user_id');
				$type = $this->session->userdata('type');
				
				if($type=='business') {
					$queryBusiness = $this->db->get_where('hotel', array('hotel_id' => $userId));
					if ($queryBusiness->num_rows()==1){
						return $queryBusiness->result();
					}else{
						return false;
					}
				}
				else {
					$queryNormal = $this->db->get_where('user', array('user_id' => $userId));
					if ($queryNormal->num_rows()==1){
						return $queryNormal->result();
					}else{
						return false;
					}
				}
				// $userId = $this->session->userdata('user_id');
				// $query = $this->db->get_where('user', array('user_id' => $userId));
				// if ($query->num_rows()==1){
				// 	return $query->result();
				// }else{
				// 	return false;
				// }
			}else{
				return false;
			}

		}

		public function postList(){
			$data=array();

			$this->db->select('p.post_id, p.caption, p.time, p.image as p_image, h.hotel_id, h.name, h.image as h_image');
			// $this->db->select('p.post_id, p.caption, p.time, h.hotel_id, h.name');
			$this->db->from('post as p');
			$this->db->join('hotel h', 'p.hotel_id = h.hotel_id');
			$query = $this->db->get();
			// $query = $this->db->query('SELECT *FROM post INNER JOIN hotel ON post.hotel_id=hotel.hotel_id');
			// SELECT *FROM post INNER JOIN hotel ON post.hotel_id=hotel.hotel_id;
			// print_r($query->result()); 
			return $query->result();
		}

		public function registerUser(){
			
			$img = file_get_contents($_FILES['img']['tmp_name']);
		
			$password = $this->input->post('pw');
			$hashPw = password_hash($password, PASSWORD_DEFAULT);

			if($this->input->post('business')) {
				$data = array(
					'name' => $this->input->post('uname'),
					'email' => $this->input->post('email'),
					'password' => $hashPw,
					'address' => $this->input->post('address'),
					'state' => $this->input->post('state'),
					'country' => $this->input->post('country'),
					'type' => $this->input->post('business'),
					'image' => $img			
				);
				$this->db->insert('hotel', $data);
				$query = $this->db->get_where('hotel', array('email' => $this->input->post('email')));

				$user_data = array(
					'user_id'=>$query->result()['0']->hotel_id,
					'logIn'=>true,
					'type'=> 'business'
				);
				$this->session->set_userdata($user_data);
			}else {
				$data = array(
					'name' => $this->input->post('uname'),
					'email' => $this->input->post('email'),
					'password' => $hashPw,
					'address' => $this->input->post('address'),
					'state' => $this->input->post('state'),
					'country' => $this->input->post('country'),
					'image' => $img			
				  );
				$this->db->insert('user', $data);
				$query = $this->db->get_where('user', array('email' => $this->input->post('email')));

				$user_data = array(
					'user_id'=>$query->result()['0']->user_id,
					'logIn'=>true,
					'type'=> 'normal'
				);
				$this->session->set_userdata($user_data);
			}

			// $this->db->insert('user', $data);

			
			if ($query->num_rows()==1){
				$isPasswordCorrect = password_verify($password, $query->result()['0']->password);
				if($isPasswordCorrect) {
					return $query->result();
				}
				
			}else{
				return false;
			}
			
		}

		
    }