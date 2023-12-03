<?php
    class User_model extends CI_model{
    
        public function register_user($user) { 
            //echo '<pre>';print_r($user);die("hi model");      
            $this->db->insert('user', $user);
        }
        
        public function login_user($user_login){
           // echo '<pre>';print_r($user_login);die("hi model");
            
           $email = $user_login['user_email'];
           $password = $user_login['user_password'];
           $this->db->where('user_email', $email);
           $this->db->where('user_password', $password);
           $query = $this->db->get('user');
           if ($query->num_rows() == 1) {
               return $query->row_array();
           } else {
               return false;
           }
        }
        public function email_check($user_email) {
            //echo '<pre>';print_r($user_email);die("hi model");
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('user_email', $user_email);
            $query = $this->db->get();
            // $str = $this->db->last_query();
            // echo $str;
            if ($query->num_rows() > 0) {
                return false;
            } else {
                return true;
            }
        }  
        
        
    }
 
 
