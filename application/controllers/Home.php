<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'controllers/Auth.php');

class Home extends Auth {
    public function __construct()
        {
                parent::__construct();
                $this->load->model('home_model');
                $this->load->model('user_model');
                $this->load->model('tasteboards_model');
                $this->load->model('ingredients_model');
                $this->load->helper('url_helper');                
        }

	public function index(){
        $user_id = $this->session->userdata('user')['user_id'];
        $data['user_details'] = $this->user_model->get_user_details();
        $data['user_tasteboards'] = $this->tasteboards_model->getUserTasteboards($user_id);
        $data['ingredients'] = $this->home_model->getIngredients();
        $data['colors'] = $this->ingredients_model->getColors(); 

        $this->load->view('user/templates/header');
        $this->load->view('user/index', $data);
        $this->load->view('user/templates/footer');
    }

    function addTasteboard(){
        $result = 0;        
        // 1: Get all needed variables:
        $user_id = $this->input->post('user_id');
        $OI = $this->input->post('OI');
        $I = $this->input->post('I');
        $tasteboard_name = $this->input->post('tasteboard_name');    // dit gaat goed

        // 2: Insert into tasteboards & tasteboard_ingredients:
        if(!empty($user_id) && !empty($OI)){
            $result = $this->tasteboards_model->setTasteboards($user_id, $OI, $tasteboard_name);
            $tasteboard_id = $this->db->insert_id();  
            // The I array is never really empty... try to fix that. 
            if($result && !empty($I)){
                $result = $this->tasteboards_model->setTasteboardsIngredients($tasteboard_id, $I);             
            }

            $tasteboard = $this->tasteboards_model->getTasteboards($tasteboard_id); 
            $_SESSION['tasteboard'] = $tasteboard;
            $tasteboard_ingredients = $this->tasteboards_model->getTasteboardsIngredients($tasteboard_id);
            $_SESSION['tasteboard_ingredients'] = $tasteboard_ingredients;
            redirect('home/index');
        }
    }

    function saveTasteboard(){
        $result = 0;        
        // 1: Get all needed variables:
        $tasteboard_id = $this->input->get('tasteboard_id');
        $OI = $this->input->get('OI');
        $I = $this->input->get('new_I');
        
        // 2: Insert into tasteboards & tasteboard_ingredients:
        if(!empty($tasteboard_id) && !empty($OI)){
            $result = $this->tasteboards_model->updateTasteboard($tasteboard_id, $OI);
            if($result){ 
                // 3: Delete other ingredients:
                $result = $this->tasteboards_model->deleteTasteboardsIngredients($tasteboard_id); 
                if($result){
                    // 4: Set ingredients:
                    $result = $this->tasteboards_model->setTasteboardsIngredients($tasteboard_id, $I);    
                }                  
            }
            $tasteboard = $this->tasteboards_model->getTasteboards($tasteboard_id); 
            $_SESSION['tasteboard'] = $tasteboard;
            $tasteboard_ingredients = $this->tasteboards_model->getTasteboardsIngredients($tasteboard_id);
            $_SESSION['tasteboard_ingredients'] = $tasteboard_ingredients;
            $_SESSION['message'] = 'please help.....';
            redirect('home/index');
        }
        
        // 3: Return response
        echo $result ? $tasteboard_id : 'err'; 
    }

    function closeTasteboard(){
        $_SESSION['tasteboard'] = null;
        $_SESSION['tasteboard_ingredients'] = null;
        redirect('home/index');
    }
}
