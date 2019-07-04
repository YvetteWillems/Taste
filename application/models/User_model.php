<?php

if (!defined('BASEPATH')) 
    exit('No direct script access allowed');

class User_model extends CI_Model {    

    private $email_code = '';

    // USERS
    public function getUsers($id = ''){
        if($id){
            $sql = "SELECT * FROM users WHERE id=$id"; 
            $query = $this->db->query($sql); 
            $result = $query->row_array();
        }else{
            $sql = "SELECT * FROM users"; 
            $query = $this->db->query($sql); 
            $result = $query->result_array();
        }
        return !empty($result)?$result:false;
    }

// REGISTER USER
    function insert_user() {
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $email = $this->input->post('email');
        $password = sha1($this->config->item('salt') . $this->input->post('password'));

        $sql = "INSERT INTO users (usr_firstname, usr_lastname, usr_email, usr_email_confirmed, usr_password)
                VALUES(" . $this->db->escape($firstname) . ",
                        " . $this->db->escape($lastname) . ",
                        '" . $email . "',
                        '1',
                        '" . $password . "')";
        
        $result = $this->db->query($sql);
        return $result;
        
        // if ($this->db->affected_rows() === 1) {
        //     // $this->set_session($firstname, $lastname, $email);
        //     // $this->send_validation_email($email);
        //     return $firstname;
        // } else {
        //     $this->load->library('email');
        // }
    }

// SEND VALIDATION EMAIL
    private function send_validation_email($email) {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            // 'smtp_user' => 'mauritsseelen@gmail.com',
            // 'smtp_pass' => 'upbtdwqttfpgngql',
            'mailtype'  => 'html',
            'newline'   => "\r\n"
        );
        $this->load->library('email', $config);

        if (empty($this->email_code)) {
            $email_code = $this->session->userdata('user')['email_code'];
        } else {
            $email_code = $this->email_code;
        }
        $this->email->from($this->config->item('bot_email'), 'Taste - Match Ingredients');
        $this->email->to($email);
        $this->email->subject('E-mail verificatie');
        $message = '<!DOCTYPE html><html><body>';
        $message .= '<p>Hallo fijnproever! <strong><a href="' . base_url() . 'register/validate_email/' . $email .
                '/' . $email_code . '"> Klik hier</a></strong> om je account te activeren. Daarna kun je beginnen met het matchen van ingrediënten.';
        $message .= '</body></html>';
        $this->email->message($message);
        if ($this->email->send()) {
            return true;
        } else {
            show_error($this->email->print_debugger());
        }
    }

// CLICK - ACTIVATE ACCOUNT
    function validate_email($email_address, $email_code) {
        $sql = "SELECT usr_email, usr_timestampRegistration, usr_firstname FROM users WHERE usr_email = '{$email_address}' LIMIT 1";
        $result = $this->db->query($sql);
        $row = $result->row();

        if ($result->num_rows() == 1 && $row->usrFirstName) {
            if (md5((string) $row->usrTimestampRegistration) === $email_code) {
                $result = $this->activate_account($email_address);
                if ($result == true) {
                    return true;
                } else {
                    echo 'There was an error when activating your account';
                    return false;
                }
            }
        } else {
            echo 'There was an error validating your email';
            return false;
        }
    }

    private function activate_account($email_address) {
        $sql = "UPDATE users SET usr_email_confirmed = 1 WHERE usr_email = '" . $email_address . "' LIMIT 1";
        $this->db->query($sql);
        if ($this->db->affected_rows() === 1) {
            return true;
        } else {
            echo 'Error when activating your account in the database.';
            return false;
        }
    }

    private function deactivate_account($email_address) {
        $sql = "UPDATE users SET usr_email_confirmed = 0 WHERE usr_email = '" . $email_address . "' LIMIT 1";
        $this->db->query($sql);
        if ($this->db->affected_rows() === 1) {
            return true;
        } else {
            echo 'Error when activating your account in the database.';
            return false;
        }
    }

// PASSWORD FORGOTTEN:
    function send_resetpassword_email() {
        $email = $this->input->post('veri_email');
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            // 'smtp_user' => 'mauritsseelen@gmail.com',
            // 'smtp_pass' => 'upbtdwqttfpgngql',
            'mailtype'  => 'html',
            'newline'   => "\r\n"
        );
        $this->load->library('email', $config);

        // if (empty($this->email_code)) {
        //     $email_code = $this->session->userdata('user')['email_code'];
        // } else {
        //     $email_code = $this->email_code;
        // }
        $this->email->from($this->config->item('bot_email'), 'Taste - Match Ingredients');
        $this->email->to($email);
        $this->email->subject('Wachtwoord herstellen');
        $message = '<!DOCTYPE html><html><body>';
        $message .= '<p><strong><a href="' . base_url() . 'login/reset_password_action/' . $email . '">Klik hier</a></strong> om je wachtwoord opnieuw in te stellen.';
        $message .= '</body></html>';
        $this->email->message($message);
        if ($this->email->send()) {
            return true;
        } else {
            show_error($this->email->print_debugger());
        }
    }

    // get the old password to compare it with the newly inputted one
    private function get_old_password($email) {
        $sql = "SELECT usr_password FROM users WHERE usr_email = '" . $email . "' LIMIT 1";
        $res = $this->db->query($sql);
        if ($this->db->affected_rows() === 1) {
            $oldpw = $res->row();
            return $oldpw->usrPassword;
        } else {
            return false;
        }
    }

    // reset the password in the database
    private function reset_password($email) {
        $sql = "UPDATE users SET usr_password = NULL WHERE usr_email = '" . $email . "' LIMIT 1";
        $this->db->query($sql);
        if ($this->db->affected_rows() === 1) {
            return true;
        } else {
            echo 'Could not reset the password';
            return false;
        }
    }

    // enter a new password in the database 
    function new_password() {
        $password = sha1($this->config->item('salt') . $this->input->post('password'));
        $email = $this->input->post('email');
        if (!($password === $this->get_old_password($email))) {
            $result = $this->reset_password($email);
            if ($result) {
                $sql = "UPDATE users SET usr_password = '" . $password . "' WHERE usr_email = '" . $email . "' LIMIT 1";
                $this->db->query($sql);
                if ($this->db->affected_rows() === 1) {
                    return true;
                } else {
                    return false;
                }
            } else {
                echo 'An error occured when resetting your password.';
            }
        } else {
            return false;
        }
    }

// SET USER IN SESSION:
    private function set_session($firstname, $lastname, $email) {
        $sql = "SELECT id, usrTimestampRegistration FROM users WHERE usr_email = '" . $email . "' LIMIT 1";
        $result = $this->db->query($sql);
        $row = $result->row();

        $sess_data = array (
            'user_id' => $row->id,
            'firstname' => $firstname,
            'lastname' => $lastname, 
            'email' => $email,
            'logged_in' => 0,
            'admin' => 0
        );        
        $this->email_code = md5((string)$row->usrTimestampRegistration);
        $this->session->set_userdata('user', $sess_data);
    }

// GET USER DETAILS
    function get_user_details() {
        $user_id = $this->session->userdata('user')['user_id'];
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        return $result = $query->result_array();
    }

// UPDATE USER ACCOUNT
    function update_user() {
        $id = $this->input->post('id');
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $email = $this->input->post('email');   
        // $oldemail = $this->input->post('oldemail');

        $sql = "UPDATE users SET usr_lastname = '" . $lastname ."', usr_firstname = '" . $firstname . "',
            usr_email = '" . $email . "' WHERE id = '" . $id . "' LIMIT 1";
            
        $this->db->query($sql);
            if ($this->db->affected_rows() === 1) {
                // if ($oldemail != $email) {
                //     $this->send_validation_email($email);
                //     $this->deactivate_account($email);
                //     $this->session->sess_destroy();
                // }
                return true;
            } else {
                return false;
            }
    }

    function updateUser($id, $firstname, $lastname, $email, $oldemail) {
        $sql = "UPDATE users SET usr_lastname = '" . $lastname ."', usr_firstname = '" . $firstname . "',
            usr_email = '" . $email . "' WHERE id = '" . $id . "' LIMIT 1";
            
        $this->db->query($sql);
        if ($this->db->affected_rows() === 1) {
            // if ($oldemail != $email) {
            //     $this->send_validation_email($email);
            //     $this->deactivate_account($email);
            //     $this->session->sess_destroy();
            // }
            return true;
        } else {
            return false;
        }
    }

    
}