<?php
if (!defined('BASEPATH')) 
    exit('No direct script access');

class Register extends CI_controller {

    private $data;

    function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');        
    }

    function index() {
        $this->data = array(
            'title' => 'Register',
            'action' => base_url('register/register_user'),
            'success' => '',
            'failed' => ''
        );
        
        $this->load->view('login/register', $this->data);    
    }

    function register_user() {
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[3]|max_length[24]');
        $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|min_length[2]|max_length[24]');
        $this->form_validation->set_rules('email', 'Email Address', 'trim|required|min_length[6]|max_length[50]|valid_email|is_unique[users.usr_email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[50]|matches[confirmpassword]');
        $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'trim|required|min_length[6]|max_length[50]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $result = $this->User_model->insert_user();

            if ($result) {
                $data = array (
                    'title' => set_value('Login'),
                    'success' => 'Registration succesful',
                );
                $this->load->view('login/login', $data);
            } else {
                $data = array (
                    'title' => set_value('Login'),
                    'failed' => 'Registration failed, please try again.',
                );
                $data['message'] = 'Registration failed, please try again.'; 
                $this->load->view('login/register', $data);
            }
        }
    }

    function validate_email($email_address, $email_code)
    {
        $email_code = trim($email_code);

        $validated = $this->User_model->validate_email($email_address, $email_code);

        if ($validated == true) {
            $this->load->view('validated/validated');
        } else {
            echo 'Error giving email activated confirmation.';
        }
    }
}