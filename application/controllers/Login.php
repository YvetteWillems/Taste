<?php

if (!defined('BASEPATH')) 
    exit('No direct script access allowed');

class Login extends CI_Controller {

    private $data;

    function __construct() {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('User_model');
        $this->load->library('form_validation');
        
        $this->data = array(
            'title' => set_value('title'),
            'action' => site_url('login/login_user')
        );
    }

    function index() {        
        $this->load->view('login/login', $this->data);
    }

// CHECK LOGIN VALUES:
    function login_user() {
        $this->form_validation->set_rules('email', 'e-mail adres', 'trim|required|min_length[6]|max_length[50]|valid_email');
        $this->form_validation->set_rules('password', 'wachtwoord', 'trim|required|min_length[6]|max_length[50]');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $result = $this->Login_model->login_user();

            switch($result) {
                case 'logged_in':
                    redirect('home');
                    break;
                case 'admin_logged_in':
                    redirect('admin/index');
                case 'incorrect_password':
                    $this->data['failed'] = 'Password is incorrect.';
                    $this->load->view('login/login', $this->data);
                    break;
                // case 'not_activated':
                //     $this->data['failed'] = 'Account not activated.';
                //     $this->load->view('login/login', $this->data);
                //     break;
                case 'email_not_found':
                    $this->data['failed'] = 'E-mail address not found.';
                    $this->load->view('login/login', $this->data);
                    break;
            }
        }      
    }

// LOGOUT
    function logout_user() {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            $this->session->sess_destroy();
            redirect('login');
        }
    }
}