<?php
    class Ingredients_model extends CI_Model {
        public function __construct() {
            $this->load->database();
        }

// SELECT
    // INGREDIENTS
        public function getIngredients($id = ''){
            if($id){
                $sql = "SELECT ingredients.*, 
                        line_colors.clr_name AS linecolor_name, 
                        line_colors.clr_code AS linecolor_code, 
                        back_colors.clr_name AS backcolor_name, 
                        back_colors.clr_code AS backcolor_code 
                        FROM ingredients 
                        LEFT JOIN colors AS line_colors ON ingredients.igr_linecolor=line_colors.id 
                        LEFT JOIN colors AS back_colors ON ingredients.igr_backcolor=back_colors.id 
                        WHERE ingredients.id=$id";
                $query = $this->db->query($sql); 
                $result = $query->row_array();
            }else{
                $sql = "SELECT * FROM ingredients ORDER BY igr_name ASC"; 
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
    // INGREDIENTS
        public function setIngredients(){
            $igr_name = $this->input->post('name');
            $igr_description = $this->input->post('description');
            $igr_img = $this->input->post('image');
            $igr_linecolor = intval($this->input->post('line_color'));
            $igr_backcolor = intval($this->input->post('back_color'));
            $fruity = $this->input->post('fruity');
            $green = $this->input->post('green');
            $roasted = $this->input->post('roasted');

            $sql = "INSERT INTO ingredients (igr_name, igr_description, igr_img, igr_linecolor, igr_backcolor, fruity, green, roasted) 
                    VALUES('" . $igr_name . "', 
                        '" . $igr_description . "', 
                        '" . $igr_img . "', 
                        '" . $igr_linecolor . "', 
                        '" . $igr_backcolor . "', 
                        '" . $fruity . "', 
                        '" . $green . "', 
                        '" . $roasted . "')"; 
            $result = $this->db->query($sql); 
            return $result;
        }

// UPDATE
        public function updateIngredients(){
            $id = $this->input->post('id');
            $igr_name = $this->input->post('name');
            $igr_description = $this->input->post('description');
            // $igr_description = escape($igr_description);
            $igr_description = $this->db->escape($igr_description);
            $igr_img = $this->input->post('image');
            $igr_linecolor = intval($this->input->post('line_color'));
            $igr_backcolor = intval($this->input->post('back_color'));
            $fruity = $this->input->post('fruity');
            $green = $this->input->post('green');
            $roasted = $this->input->post('roasted');

            $sql = "UPDATE ingredients 
                    SET igr_name='$igr_name', 
                        igr_description=$igr_description, 
                        igr_img='$igr_img', 
                        igr_linecolor=$igr_linecolor,
                        igr_backcolor=$igr_backcolor,
                        fruity=$fruity, 
                        green=$green, 
                        roasted=$roasted  
                    WHERE id=$id"; 
            $result = $this->db->query($sql); 
            return $result;
        }




// DELETE

        


    }