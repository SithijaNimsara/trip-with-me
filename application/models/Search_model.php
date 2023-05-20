<?php
	class Search_model extends CI_Model {

        public function searchHotel() {
            // SELECT * FROM hotel WHERE name LIKE 'r%'
            $tag = $this->uri->segment(3);
            if($this->uri->segment(4)) {
                if($tag=='hotel') {
                    $query = "SELECT * FROM hotel WHERE type='Hotel' AND name LIKE '".$this->uri->segment(4)."%'";
                    $result = $this->db->query($query);
                    return $result->result();
                }
                else if($tag=='restaurent') {
                    $query = "SELECT * FROM hotel WHERE type='Restaurent' AND name LIKE '".$this->uri->segment(4)."%'";
                    $result = $this->db->query($query);
                    return $result->result();
                }
                else {
                    return false;
                }
            }else {
                $query = "SELECT * FROM hotel WHERE name LIKE '" .$this->uri->segment(3). "%'";
                $result = $this->db->query($query);
                return $result->result();
            }



            
        }

        public function searchByTag() {

        }

    }