<?php
// if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once(APPPATH . 'controllers/AdminAuth.php');

class Admin extends AdminAuth { 

    function __construct() {
        parent::__construct();
        $this->load->model('Recipes_model');
        $this->load->model('Ingredients_model');
        $this->load->model('Tasteboards_model');
        $this->load->model('User_model');
    }

    function index() {
        // $data['tasteboards'] = $this->tasteboards_model->getTasteboards(); 
        // $data['users'] = $this->user_model->getUsers(); 

        $this->load->view('admin/templates/header');
        $this->load->view('admin/index');
        $this->load->view('admin/templates/footer');
    }

// INGREDIENTS
    function addIngredient(){
        $id = 1; // alleen voor keys
        $data['ingredient'] = $this->Ingredients_model->getIngredients($id);
        $data['colors'] = $this->Ingredients_model->getColors(); 

        $this->load->view('admin/templates/header');
        $this->load->view('admin/adminmenu/ingredients/add_ingredient', $data);
        $this->load->view('user/templates/footer');
    }

    function addIngredientAction(){
        $this->form_validation->set_rules('name', 'name of ingredient', 'trim|required|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('description', 'description of ingredient', 'trim|required');
        $this->form_validation->set_rules('line_color', 'linecolor', 'required|integer');
        $this->form_validation->set_rules('back_color', 'background color', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            redirect('admin/addIngredient');
        } else {
            $result = $this->Ingredients_model->setIngredients(); 
            if($result){
                $message = 'you added a new ingredient'; 
                $this->session->set_flashdata('message', $message);
                redirect('admin/ingredients'); 
            } else {
                $message = 'could not add ingredient'; 
                $this->session->set_flashdata('message', $message);
                redirect('admin/addIngredient/' + $id); 
            }
        }
    }

    function ingredients(){
        $data['ingredients'] = $this->Ingredients_model->getIngredients(); 

        $this->load->view('admin/templates/header');
        $this->load->view('admin/adminmenu/ingredients/ingredients', $data);
        $this->load->view('user/templates/footer');
    } 

    function readIngredient(){
        $id = $this->uri->segment(3);
        $data['ingredient'] = $this->Ingredients_model->getIngredients($id); 

        $this->load->view('admin/templates/header');
        $this->load->view('admin/adminmenu/ingredients/ingredient', $data);
        $this->load->view('user/templates/footer');
    }

    function editIngredient(){
        $id = $this->uri->segment(3);
        $data['ingredient'] = $this->Ingredients_model->getIngredients($id);
        $data['colors'] = $this->Ingredients_model->getColors(); 

        $this->load->view('admin/templates/header');
        $this->load->view('admin/adminmenu/ingredients/edit_ingredient', $data);
        $this->load->view('user/templates/footer');
    }

    function editIngredientAction(){
        $this->form_validation->set_rules('name', 'name of ingredient', 'trim|required|min_length[1]|max_length[50]');
        $this->form_validation->set_rules('description', 'description of ingredient', 'trim|required');
        $this->form_validation->set_rules('line_color', 'linecolor', 'required|integer');
        $this->form_validation->set_rules('back_color', 'background color', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            $id = $this->uri->segment(3);
            redirect('admin/recipe/' + $id);
        } else {
            $result = $this->Ingredients_model->updateIngredients(); 
            if($result){
                $message = 'you updated the ingredient'; 
                $this->session->set_flashdata('message', $message);
                redirect('admin/ingredients'); 
            } else {
                $message = 'could not update ingredient'; 
                $this->session->set_flashdata('message', $message);
                redirect('admin/editIngredient/' + $id); 
            }
        }
    }

    function deleteIngredient(){
        $id = $this->uri->segment(3);
        $result = $this->Ingredients_model->deleteIngredient($id); 
        if($result){
            $message = 'the ingredient was deleted'; 
            $this->session->set_flashdata('message', $message);
            redirect('admin/ingredients'); 
        } else {
            $message = 'could not delete ingredient'; 
            $this->session->set_flashdata('message', $message);
            redirect('admin/ingredient/' + $id); 
        }
    }
}