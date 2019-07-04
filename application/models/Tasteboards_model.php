<?php
    class Tasteboards_model extends CI_Model {
        public function __construct() {
            $this->load->database();
        }

// SELECT
    // TASTEBOARDS BY ID
        public function getTasteboards($id = ''){
            if($id){
                $sql = "SELECT * 
                        FROM tasteboards 
                        -- INNER JOIN tasteboards_ingredients ON tasteboards.id = tasteboards_ingredients.tst_id
                        WHERE id=$id"; 
                $query = $this->db->query($sql); 
                $result = $query->row_array();
            }else{
                $sql = "SELECT * FROM tasteboards"; 
                $query = $this->db->query($sql); 
                $result = $query->result_array();
            }
            return !empty($result)?$result:false;
        }
    // TASTEBOARDS BY USER ID
        public function getUserTasteboards($user_id){
            $sql = "SELECT * 
                    FROM tasteboards 
                    -- INNER JOIN tasteboards_ingredients ON tasteboards.id = tasteboards_ingredients.tst_id
                    WHERE tasteboards.usr_id=$user_id
                    ORDER BY tst_save DESC"; 
            $query = $this->db->query($sql); 
            $result = $query->result_array();

            return !empty($result)?$result:false;
        }
    // TASTEBOARD INGREDIENTS BY TST ID
        public function getTasteboardsIngredients($id){
            $sql = "SELECT * 
                    FROM tasteboards_ingredients 
                    WHERE tst_id=$id"; 
            $query = $this->db->query($sql); 
            $result = $query->result_array();
            
            return !empty($result)?$result:false;
        }


// INSERT
    // TASTEBOARDS
        public function setTasteboards($user_id, $OI, $tasteboard_name){
            $sql = "INSERT INTO tasteboards (usr_id, org_id, tst_name) 
                    VALUES('" . $user_id . "', 
                           '" . $OI . "', 
                           '" . $tasteboard_name . "')"; 
            $result = $this->db->query($sql); 
            return $result;
        }
    // TASTEBOARDS_INGREDIENTS
        public function setTasteboardsIngredients($tasteboard_id, $I){
            // $json = str_replace('&quot;', '"', $I);
            $json = str_replace('&quot;', '&apos;', $I);
            $ingredients = json_decode($json, true);
            var_dump($I);
            var_dump($ingredients);
            $result = true;
            foreach($ingredients as $ingredient){
                var_dump($ingredient);
                $igr_id = $ingredient['id']; 
                $igr_connection = $ingredient['connection']; 

                if(!empty($igr_id) && !empty($igr_connection)){
                    $sql = "INSERT INTO tasteboards_ingredients (tst_id, igr_id, igr_connection) 
                    VALUES('" . $tasteboard_id . "', 
                           '" . $igr_id . "', 
                           '" . $igr_connection . "')"; 
                    $result = $this->db->query($sql);
                    
                    if($result !== true){
                        return $result;
                    }                    
                }
            }
            return $result;
        }
        
// UPDATE
        public function updateTasteboard($tasteboard_id, $OI){
            $sql = "UPDATE tasteboards SET org_id=$OI WHERE id=$tasteboard_id"; 
            $result = $this->db->query($sql); 
            return $result;
        }

        public function updateTasteboardName($tasteboard_id, $tasteboard_name){
            $sql = "UPDATE tasteboards SET tst_name=$tasteboard_name WHERE tst_id=$tasteboard_id"; 
            $result = $this->db->query($sql); 
            return $result;
        }

// DELETE
        public function deleteTasteboard($tasteboard_id){
            $sql = "DELETE FROM tasteboards WHERE id=$tasteboard_id"; 
            $result = $this->db->query($sql);
            return $result;
        }

        public function deleteTasteboardsIngredients($tasteboard_id){
            $sql = "DELETE FROM tasteboards_ingredients WHERE tst_id=$tasteboard_id"; 
            $result = $this->db->query($sql);
            return $result;
        }     
    }