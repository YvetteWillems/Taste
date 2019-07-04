<?php
    class Recipes_model extends CI_Model {
        public function __construct() {
            $this->load->database();
        }

// SELECT    
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
        public function getRecipes($id = ''){
            if($id){
                $sql = "SELECT * FROM recipes WHERE id=$id"; 
                $query = $this->db->query($sql); 
                $result = $query->row_array();
            }else{
                $sql = "SELECT * FROM recipes"; 
                $query = $this->db->query($sql); 
                $result = $query->result_array();
            }
            return !empty($result)?$result:false;
        }
    // RECIPES INGREDIENTS
        public function getRecipesIngredients($recipe_id){
            $sql = "SELECT * 
                    FROM recipes_ingredients
                    LEFT JOIN ingredients ON recipes_ingredients.igr_id = ingredients.id 
                    LEFT JOIN units ON recipes_ingredients.uni_id = units.id 
                    WHERE recipes_ingredients.rec_id=$recipe_id"; 
            $query = $this->db->query($sql); 
            $result = $query->result_array();
            
            return !empty($result)?$result:false;
        }

// INSERT
    // RECIPES
        public function setRecipes($rec_name, $rec_description, $usr_id){
            $sql = "INSERT INTO recipes (rec_name, rec_description, usr_id)
                    VALUES('" . $rec_name . "', 
                        '" . $rec_description . "', 
                        '" . $usr_id . "')";
            $result = $this->db->query($sql); 
            return $result;
        }

        public function setRecipesIngredients($igr_id, $igr_amount, $uni_id){
            $sql = "INSERT INTO recipes_ingredients (igr_id, igr_amount, uni_id)
                    VALUES('" . $igr_id . "', 
                           '" . $igr_amount . "', 
                           '" . $uni_id . "')";
            $result = $this->db->query($sql); 
            return $result;
        }

// UPDATE
    // RECIPES
        public function updateRecipes($recipe_id, $rec_name, $rec_description){
            $sql = "UPDATE recipes 
                    SET rec_name=$rec_name, rec_description=$rec_description 
                    WHERE id=$recipe_id"; 
            $result = $this->db->query($sql); 
            return $result;
        }

// DELETE
    // RECIPES
        public function deleteRecipe($recipe_id){
            $sql = "DELETE FROM recipes WHERE id=$recipe_id"; 
            $result = $this->db->query($sql);
            return $result;
        }

        public function deleteRecipesIngredients($recipe_id){
            $sql = "DELETE FROM recipes_ingredients WHERE rec_id=$recipe_id"; 
            $result = $this->db->query($sql);
            return $result;
        }
    }