<?php
    class Home_model extends CI_Model {
        public function __construct() {
            $this->load->database();
        }

// SELECT
    // INGREDIENTS
        public function getIngredients($id = ''){
            if($id){
                $sql = "SELECT * FROM ingredients WHERE id=$id"; 
                $query = $this->db->query($sql); 
                $result = $query->row_array();
            }else{
                $sql = "SELECT * FROM ingredients"; 
                $query = $this->db->query($sql); 
                $result = $query->result_array();
            }
            return !empty($result)?$result:false;
        }
    // TASTEBOARDS
        public function getTasteboards($id = ''){
            if($id){
                $sql = "SELECT * 
                        FROM tasteboards 
                        INNER JOIN tasteboards_ingredients ON tasteboards.id = tasteboards_ingredients.tst_id
                        WHERE tasteboards.id=$id"; 
                $query = $this->db->query($sql); 
                $result = $query->row_array();
            }else{
                $sql = "SELECT * FROM tasteboards"; 
                $query = $this->db->query($sql); 
                $result = $query->result_array();
            }
            return !empty($result)?$result:false;
        }
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
    // COLORS
        public function getColors($id = ''){
            if($id){
                $sql = "SELECT * FROM colors WHERE id=$id"; 
                $query = $this->db->query($sql); 
                $result = $query->row_array();
            }else{
                $sql = "SELECT * FROM colors"; 
                $query = $this->db->query($sql); 
                $result = $query->result_array();
            }
            return !empty($result)?$result:false;
        }
    // UNITS
        public function getUnits($id = ''){
            if($id){
                $sql = "SELECT * FROM units WHERE id=$id"; 
                $query = $this->db->query($sql); 
                $result = $query->row_array();
            }else{
                $sql = "SELECT * FROM units"; 
                $query = $this->db->query($sql); 
                $result = $query->result_array();
            }
            return !empty($result)?$result:false;
        }
    // RECIPES
        // Dit is voor later

// INSERT
    // USERS IN USER_MODEL
    // COLORS & INGREDIENTS IN ADMIN
    // RECIPES, LATER




// DELETE

        

// UPDATE
        


    }