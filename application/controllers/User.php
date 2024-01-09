<?php 
    class User extends CI_Controller {
        //http://localhost/crud-application/user/login_view
        public function __construct() {
            parent::__construct();
            $this->load->model('User_model'); 
            $this->load->model('crud');
            $this->load->helper('url');
            $this->load->library('session');
        }    
        public function index() {
            $this->load->view("Auth/register.php");
        }

        public function register_user(){
            $user_name = $this->input->post('user_name');
            $user_email = $this->input->post('user_email');
            $user_password = md5($this->input->post('user_password'));
            $user_age = $this->input->post('user_age');
            $user_mobile = $this->input->post('user_mobile');
            
            $user = array(
                'user_name' => $user_name,
                'user_email' => $user_email,
                'user_password' => $user_password,
                'user_age' => $user_age,
                'user_mobile' => $user_mobile
            );
            // echo '<pre>';print_r($user);die();

            $email_check = $this->User_model->email_check($user_email);
            //$email_check = $this->crud->email_check($user_email);
        
            if($email_check) {
                $user_login = $this->User_model->register_user($user);
                $this->session->set_flashdata('success_msg', 'Registered successfully.Now login to your account.');
                redirect('/login_view.php');
                //echo '<pre>';print_r($user_login);die("hi");
                
            } else {
                $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
                redirect('user');
            }
        }

        public function login_view(){

        $this->load->view("Auth/login.php");

        }

        public function login_user() {
            $user_login = array(
                'user_email' => $this->input->post('user_email'),
                'user_password' => md5($this->input->post('user_password'))
            );  
            
            $this->load->model('User_model');
            $user_data = $this->User_model->login_user($user_login);
            if ($user_data) {
                $this->session->set_userdata('user_id', $user_data['user_id']);
                $this->session->set_userdata('user_email', $user_data['user_email']);
                
                $this->session->set_flashdata('success_msg', 'Login successful!'); 
                //$this->load->view('Auth/user_profile', $user_data);
                $this->load->view('Auth/user_profile', array('user_data' => $user_data)); 
            } else {
                $this->session->set_flashdata('error_msg', 'Invalid username/email or password');
                redirect('Auth/login_view');
            }
        }

        function user_profile(){
            $this->load->view('Auth/user_profile.php');
        }
        public function user_logout() {
            $this->session->sess_destroy(); 
            redirect('user/login_view');
        }
    }
