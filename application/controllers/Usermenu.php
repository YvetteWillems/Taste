<?php
require_once(APPPATH . 'controllers/Auth.php');

class Usermenu extends Auth {
    function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Tasteboards_model');
        $this->load->library('form_validation');
    }
// USERMENU BUTTONS:
    // PERSONAL INFORMATION
    function update_user() {
        $this->form_validation->set_rules('firstname', 'voornaam', 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('lastname', 'achternaam', 'trim|required|min_length[2]|max_length[50]');
        $this->form_validation->set_rules('email', 'e-mail adres', 'trim|required|min_length[5]|max_length[50]|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $this->personal();
        } else {
            $result = $this->User_model->update_user();

            if ($result) {
                $message = 'your information was updated'; 
                $this->session->set_flashdata('message', $message);
                redirect('usermenu/personal'); 
            } else {
                $message = 'something went wrong'; 
                $this->session->set_flashdata('message', $message);
                redirect('usermenu/personal');
            }
        }
    }

    function updateUser() {
        $result = 0;        
        // 1: Get all needed variables:
        $id = $this->input->get('id');
        $firstname = $this->input->get('firstname');
        $lastname = $this->input->get('lastname');
        $email = $this->input->get('email');
        $oldemail = $this->input->get('oldemail');      // alles in orde
        
        // 2: Update user:
        if(!empty($id) && !empty($firstname) && !empty($lastname) && !empty($email)){       // dit gaat ook goed
            $result = $this->User_model->updateUser($id, $firstname, $lastname, $email, $oldemail);     // dit nu ook
        }
        
        // 3: Return response
        // $new_user_details = $this->User_model->getUsers($id);       // correct response, but can't be echood. 
        $new_user_details = $this->User_model->get_user_details();
        echo $result ? json_encode($new_user_details[0]) : 'err'; 
    }

    public function deleteTasteboard(){
        $id = $this->input->get('id');
        $result = $this->Tasteboards_model->deleteTasteboardsIngredients($id);
        if($result){
            $result = $this->Tasteboards_model->deleteTasteboard($id); 

            $user_id = $this->session->userdata('user')['user_id'];
            $new_user_tasteboards = $this->Tasteboards_model->getUserTasteboards($user_id);
            echo $result ? json_encode($new_user_tasteboards) : 'err'; 
        } else {
            echo 'err';
        }
    }

    function editTasteboard(){
        $tasteboard_id = $this->uri->segment(3);
        $_SESSION['tasteboard_id'] = $tasteboard_id;
        $tasteboard = $this->Tasteboards_model->getTasteboards($tasteboard_id); 
        $_SESSION['tasteboard'] = $tasteboard;
        $tasteboard_ingredients = $this->Tasteboards_model->getTasteboardsIngredients($tasteboard_id);
        $_SESSION['tasteboard_ingredients'] = $tasteboard_ingredients;
        redirect('home/index'); 
    }
}