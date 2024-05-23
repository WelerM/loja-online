<?php

namespace core\models;

use core\classes\Database;
use core\classes\Functions;
use Exception;

class Image
{
    private  $result_image_table;
    private  $result_image_temperature;

    public function display_img($img_body_type, $user_id)
    {

        $db = new Database();
        $params = [
            ':image_body_type' => $img_body_type,
            ':user_id' => $user_id

        ];

        $results =  $db->select("SELECT * FROM images WHERE image_body_type = :image_body_type AND user_id = :user_id", $params);

        return $results;
    }
    //===================================================================

    public function show_wearing_parts($user_id)
    {

        $db = new Database();

        $params = [
            ':user_id' => $user_id,
            ':image_displayed' => 1
        ];

        $result = $db->select("SELECT * FROM images 
        WHERE user_id = :user_id
        AND image_displayed = :image_displayed", $params);

        $img_name_with_ext = null;

        if ($result === 0) {
            $img_name_with_ext = 'default.png';
        } else {
            $img_name_with_ext = $result;
        }

        return $img_name_with_ext;
    }
    //===================================================================

    public function show_img_info($img_id)
    {


        $db = new Database();

        $this->result_image_table;
        $this->result_image_temperature;

        //Select to get image name  from images table
        $params = [
            ':id' => $img_id,
        ];

        try {

            $result_image_table = $db->select(
                "SELECT image_name, image_src FROM images 
                WHERE id = :id",
                $params
            );
        } catch (Exception $e) {
            echo $e;
            die('error');
        }
        //----------------------------------------------------------------------


        //Select to get image temperature and season from temperature_seasons table
        $params = [
            ':id' => $img_id,
        ];

        try {

            $result_image_temperature = $db->select(
                "SELECT * FROM temperature_seasons 
                WHERE id = :id",
                $params
            );
        } catch (Exception $e) {
            echo $e;
            die('error');
        }


        //Create array joining both results from the two selects above. 
        //I will replace this code with a JOIN, later
        $result = [
            'image_name' => $result_image_table[0]->image_name,
            'image_src' => $result_image_table[0]->image_src,
            'min_temp' => $result_image_temperature[0]->min_temp,
            'max_temp' => $result_image_temperature[0]->max_temp,
            'season_spring' => $result_image_temperature[0]->season_spring,
            'season_summer' => $result_image_temperature[0]->season_summer,
            'season_fall' => $result_image_temperature[0]->season_fall,
            'season_winter' => $result_image_temperature[0]->season_winter,
        ];

        return $result;
    }
    //===================================================================

    public function show_suggestion($user_current_temperature)
    {

        $db = new Database();
        $params = [
            ':current_temperature' => $user_current_temperature,
            ':id' => $_SESSION['user_id']
        ];

        $results =  $db->select(
            "SELECT min_temp, max_temp, image_body_type, image_src 
            FROM temperature_seasons 
            JOIN images
            WHERE temperature_seasons.image_id = images.id 
            AND images.user_id = :id
            AND min_temp <= :current_temperature 
            AND max_temp >= :current_temperature",
            $params
        );
        // "SELECT * FROM temperature_seasons 
        // WHERE min_temp <= :current_temperature 
        // AND max_temp >= :current_temperature"
        // , $params);

        return $results;
    }
    //===================================================================

    public function use_image($user_id, $img_body_type, $img_id)
    {

        $db = new Database();

        //Checks if there is an image from the "images" table with "image_body_type" = $img_body_type
        //while having "image_displayed" set as 1.
        //. If true, all results from image_body_type that are equal to $img_body_type,
        // will be set to false, allowing a new one to be set as true.
        $params = [
            ':user_id' => $user_id,
            ':image_body_type' => $img_body_type,
            ':image_displayed' => 1
        ];

        $is_img_being_used =  $db->select(
            "SELECT * FROM images WHERE user_id = :user_id
            AND image_body_type = :image_body_type 
            AND image_displayed = :image_displayed",
            $params

        );

        //If there is an image being used, all results from the images table will have its "image_displayed"
        //Column set to 0
        if (count($is_img_being_used) > 0) {

            $params = [
                ':image_displayed' => 0,
                ':user_id' => $user_id,
                ':image_body_type' => $img_body_type
            ];
            $db->update(
                "UPDATE images SET image_displayed = :image_displayed
                WHERE user_id = :user_id 
                AND image_body_type = :image_body_type",
                $params
            );
        }
        //--------------------------------------------------------------------------

        //Sets "displayed" table for choosen image to TRUE
        $params = [
            ':image_displayed' => 1,
            ':id' => $img_id
        ];
        $db->update("UPDATE images SET image_displayed = :image_displayed
         WHERE id = :id", $params);
    }
    //===================================================================

    //Me: Tentar usar JOIN aqui dentro
    public function save_image(
        

    ) {

    }
    //===================================================================

    public static function edit_image(
        $img_id,
        $img_name,
        $min_temperature,
        $max_temperature,

        $input_check_spring,
        $input_check_summer,
        $input_check_fall,
        $input_check_winter,

        $img_type,
        $img_file
    ) {

        $file = $img_file;
        $fileName = $img_file['name'];
        $fileTmpName = $img_file['tmp_name'];
        $fileSize = $img_file['size'];
        $fileError = $img_file['error'];
        $fileType = $img_file['type'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');
        //==========================================================


        //Validate input check seasons


        //Creates array of user's choosen seasons
        $arr_choosen_seasons_filtered = array();

        $arr_choosen_seasons = [
            'spring' => $input_check_spring,
            'summer' => $input_check_summer,
            'fall' => $input_check_fall,
            'winter' => $input_check_winter,
        ];


        //Sets user's choosen "input check seasons" to true 

        foreach ($arr_choosen_seasons as $key => $value) {

            if ($value === 1) {

                $arr_choosen_seasons_filtered[$key] = $value;

                if ($key === 'spring') {
                    $input_check_spring = 1;
                } else if ($key === 'summer') {
                    $input_check_summer = 1;
                } else if ($key === 'fall') {
                    $input_check_fall = 1;
                } else if ($key === 'winter') {
                    $input_check_winter = 1;
                }
            }
        }

        //==========================================================




        //Verifies if id of the image to update exists on database
        $db = new Database();

        $params = [
            ':id' => $img_id
        ];
        $result = $db->select("SELECT * FROM images WHERE id =:id", $params);

        if (count($result) === 0) { //Free to delete

            Functions::redirect('home$data=null&error=imgdoesntexistondb');
        }
        //===================================================================


        $root = $_SERVER["DOCUMENT_ROOT"] . '/buildlookmvc/public';


        //Retrieve img from database
        $img_file_name = $result[0]->image_file_name;
        $img_src = $result[0]->image_src;

        //Retrieve img_file_name from database
        $is_img_displayed = $result[0]->image_displayed;
        $img_to_delete = $root . '/assets/images/' . $img_type . '/' . $img_file_name;



        $uniqueName = null;
        $fileNameNew = null;
        $fileDestination = null;


        //Checks whether or not user has chosen a new image
        //New img selected: error = 0.
        //Img not selected: error = 4.
        if ($file['error'] === 0) {  //New image selected


            //Deltes old img on server folder
            if (file_exists($img_to_delete)) {

                if (unlink($img_to_delete)) {


                    //Adds new img to server folder
                    if (in_array($fileActualExt, $allowed)) {

                        if ($fileError === 0) {
                            if ($fileSize < 1000000) {
                                $uniqueName = round(microtime(true) * 1000);
                                $fileNameNew = $img_type . "_" . $uniqueName . "." . $fileActualExt;
                                $fileDestination = $root . '/assets/images/' . $img_type . '/' . $fileNameNew;
                                $img_src = 'assets/images/' . $img_type . '/' . $fileNameNew;

                                //Inserts new image with new name within server folder
                                move_uploaded_file($fileTmpName, $fileDestination);

                                //  Functions::redirect("home&data=$img_type&error=none");
                                //   exit();
                                //Updates $param values that will be used to update "img_src" & "img_file_name" tables on DB
                            } else {

                                Functions::redirect("home&data=$img_type&error=filetoobig");
                                exit();
                            }
                        } else {

                            Functions::redirect("home&data=$img_type&error=uploaderror");
                            exit();
                        }
                    } else {

                        Functions::redirect("home&data=$img_type&error=filenotsupported");
                        exit();
                    }
                } else {
                    Functions::redirect("home&data=$img_type&error=couldntdeleteimg");
                    exit();
                }
            } else {

                Functions::redirect("home&data=$img_type&error=imgtodeletenotfound");
                exit();
            }
        } else if ($file['error'] === 4) { //New Image not selected

            //Updates $param values that will be used to update "img_src" & "img_file_name" tables on DB
            $fileNameNew = $img_file_name;
        }
        //-------------------------------------------------------------------------


        //Updates 'image' table
        $params = [
            ':id' => $img_id,
            ':image_body_type' => $img_type,
            ':image_src' => $img_src,
            ':image_name' => $img_name,
            ':image_file_name' => $fileNameNew,
        ];
        try {

            $db->update(
                "UPDATE images set 
                    image_body_type = :image_body_type,
                    image_src = :image_src, 
                    image_name = :image_name,
                    image_file_name = :image_file_name,
                    updated_at = NOW()

                 WHERE id = :id",
                $params
            );
        } catch (Exception $e) {
            echo $e;
            die('error updating images table');
        }
        //-------------------------------------------------------------------------




        //Updates season_temperature table
        $params = [
            ':image_id' => $img_id,
            ':min_temp' => $min_temperature,
            ':max_temp' => $max_temperature,
            ':season_spring' => $input_check_spring,
            ':season_summer' => $input_check_summer,
            ':season_fall' => $input_check_fall,
            ':season_winter' => $input_check_winter
        ];


        try {

            $db->update(
                "UPDATE temperature_seasons set 
                    min_temp = :min_temp, 
                    max_temp = :max_temp,
                    season_spring = :season_spring,
                    season_summer = :season_summer, 
                    season_fall = :season_fall, 
                    season_winter = :season_winter
            
                 WHERE image_id = :image_id",
                $params
            );
        } catch (Exception $e) {
            echo $e;
            die('error updating temperature_season table');
        }
        //-------------------------------------------------------------------------





        //The variable "data" in the URL will be used inside the "start" function in the script.js file
        Functions::redirect("home&data=$img_type&error=none");
        exit();
    }
    //===================================================================

    public function delete_image($img_id, $img_body_type)
    {

        // #1 deletar no banco de dados, tabelas
        //  Images & temperature seasons

        // #2 se houve sucesso ou apos a remoção no banco de dados,
        //Deletar o arquivo real dentro do sistema 


        //DELETES IMAGE IN THE DATABASDE
        $db = new Database();

        $params = [
            ':id' => $img_id
        ];

        $check_existing_record = $db->select("SELECT * FROM images WHERE id  = :id", $params);

        //Checks if desired image to delete exists in the database
        if (count($check_existing_record) === 0) {
            return false;
        }
        //--------------------------------------------------------------


        //Delete image from "temperature_season" table, it's linked to the "images" table
        $params = [
            ':image_id' => $img_id
        ];
        $db->delete("DELETE FROM temperature_seasons WHERE image_id = :image_id", $params);
        //--------------------------------------------------------------


        //Delete image from "images" table
        $params = [
            ':id' => $img_id
        ];
        $db->delete("DELETE FROM images WHERE id = :id", $params);
        //--------------------------------------------------------------




        //DELETES IMAGE INSIDE THE SYSTEM

        //Gets file name from database 
        $img_file_name = $check_existing_record[0]->image_file_name;

        //Gets system's full path of desired image
        $img_path =  $_SERVER['DOCUMENT_ROOT'] . '/buildlookmvc/public/assets/images/' . $img_body_type . '/' . $img_file_name;

        //Verifies if such file exists on server folder
        if (!file_exists($img_path)) {
            echo 'data does not exists';
            return false;
        }
        //Delete on server folder
        if (!unlink($img_path)) {

            return false;
        }
        //--------------------------------------------------------------

        return true;
    }

    public function delete_all_images()
    {


        $db = new Database();
        $params = [
            ':user_id' => $_SESSION['user_id']
        ];

        //Gets all user's images information in order to delete it
        //from the app's system
        $results = $db->select("SELECT * FROM images WHERE user_id = :user_id", $params);

        foreach ($results as $result) {
            //Gets system's full path of desired image
            $img_path =  $_SERVER['DOCUMENT_ROOT'] . '/buildlookmvc/public/' . $result->image_src;

            //Verifies if such file exists on server folder
            if (file_exists($img_path)) {
                unlink($img_path);
            }
        }

        //-----------------------------------------------------------------


        //Delete all data from "temperature_season" & "images"  tables
        
        //Delete data from "temperature_season" table

        $db->delete(
            "DELETE temperature_seasons FROM temperature_seasons
            JOIN images
            ON temperature_seasons.image_id = images.id
            WHERE images.user_id = :user_id",
            $params
        );


        //Delete data from "images" table
        $db->delete(
            "DELETE FROM images
            WHERE images.user_id = :user_id",
            $params
        );

        //Functions::redirect();
    }
}
