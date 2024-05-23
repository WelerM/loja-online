<?php


namespace core\controllers;

use core\models\Image;
use core\classes\Functions;

class ImageController
{


    //Displays all images
    public function display_img()
    {

        //Verifies if there's an open session
        if (Functions::user_logged()) {



            $body_part = $_GET['body_part'];

            $img_upload = new Image();

            $results = $img_upload->display_img($body_part, $_SESSION['user_id']);

            $jsonArray = json_encode($results);
            echo $jsonArray;
            // echo $data;
        }
    }
    //===================================================================

    //Show wearing images
    public function show_wearing_parts()
    {

        //Verifies if there's an open session
        if (Functions::user_logged()) {

            $img_upload = new Image();

            $user_id = $_SESSION['user_id'];

            $result = $img_upload->show_wearing_parts($user_id);

            $jsonArray = json_encode($result);
            echo $jsonArray;
        }
    }
    //===================================================================

    public function show_img_info()
    {
        $img_id = $_GET['data'];

        $img_upload = new Image();

        $result = $img_upload->show_img_info($img_id);


        $jsonArray = json_encode($result);

        echo $jsonArray;
    }
    //===================================================================


    ///Show suggestion 
    public function show_suggestion()
    {
        $user_current_temperature = $_GET['data'];

        $img_upload = new Image();

        $results = $img_upload->show_suggestion($user_current_temperature);

        $jsonArray = json_encode($results);

        echo $jsonArray;
    }
    //===================================================================

    public function use_image()
    {

        $user_id = $_SESSION['user_id'];
        $img_id = $_GET['id'];
        $img_body_type = $_GET['name'];

        $img_upload = new Image();

        $img_upload->use_image($user_id, $img_body_type, $img_id);
    }
    //===================================================================


    //Save image
    public function save_image()
    {
        //Verifies if there was a form submition
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Functions::redirect();
            return;
        }
        //-------------------------------------------------------------------

        //Image file data
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');

        //Gets instruction on which table will be processed. Ex. top, torso, legs, feet
        $img_body_part = $_POST['data-type'];

        $input_check_spring = false;
        $input_check_summer = false;
        $input_check_fall  = false;
        $input_check_winter = false;
        //-------------------------------------------------------------------




        //Checks if user chose a name for the image
        if (!isset($_POST['input-img-name'])) {

            Functions::redirect("home&data=$img_body_part&error=imgnameempty");
            exit();
        }
        if (empty(trim($_POST['input-img-name']))) {
            Functions::redirect("home&data=$img_body_part&error=imgnameempty");
            exit();
        }

        //-------------------------------------------------------------------




        //Checks if img extension is valid
        if (!in_array($fileActualExt, $allowed)) {
            Functions::redirect("home&data=$img_body_part&error=filenotsupported");
            exit();
        }

        //Checks if there was an error uploading the img
        if ($fileError !== 0) {
            Functions::redirect("home&data=$img_body_part&error=uploaderror");
            exit();
        }

        //Checks if img size is under the specific value
        if ($fileSize >= 1000000) {
            Functions::redirect("home&data=$img_body_part&error=filetoobig");
            exit();
        }



        //Save image info into the database
        $img_upload = new Image();

        $img_upload->save_image(
            //data for images table
            0,
            $_SESSION['user_id'],
            $img_body_part,
            $fileActualExt,
            $_POST['input-img-name'],
            $fileTmpName,
            0,

            //data for temperature_seasons table
            $input_check_spring,
            $input_check_summer,
            $input_check_fall,
            $input_check_winter
        );


        //The variable "data" in the URL will be used inside the "start" function in the script.js file
        Functions::redirect("home&data=$img_body_part&error=none");
        exit();
    }
    //===================================================================

    //Edit image
    public function edit_image()
    {
        //Verifies if there was a form submition
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Functions::redirect();
            return;
        }
        //=============================================



        //Checks if user chose a name for the image
        if (!isset($_POST['input-img-name'])) {
            Functions::redirect("home&data=" . $_POST['data-type'] . "&error=imgnameempty");
            exit();
        }

        if (empty(trim($_POST['input-img-name']))) {

            Functions::redirect("home&data=" . $_POST['data-type'] . "&error=imgnameempty");
            exit();
        }

        //=============================================================





        //Handle input check seasons and call function to edit
        $input_check_spring = true;
        $input_check_summer = true;
        $input_check_fall = true;
        $input_check_winter = true;


        //If users hasn't check "All seasons", the program will work on the specific seasons they choose
        //check separately if each "season" input checks are checked

        //Spring
        if (isset($_POST['spring-check'])) {

            $input_check_spring = true;
        } else {
            $input_check_spring = false;
        }


        //Summer
        if (isset($_POST['summer-check'])) {

            $input_check_summer = true;
        } else {
            $input_check_summer = false;
        }


        //Fall
        if (isset($_POST['fall-check'])) {

            $input_check_fall = true;
        } else {
            $input_check_fall = false;
        }


        //Winter
        if (isset($_POST['winter-check'])) {

            $input_check_winter = true;
        } else {
            $input_check_winter = false;
        }


        $img_upload = new Image();

        $img_upload->edit_image(
            $_POST['input-img-id'],
            $_POST['input-img-name'],
            $_POST['input-min-range'],
            $_POST['input-max-range'],

            $input_check_spring,
            $input_check_summer,
            $input_check_fall,
            $input_check_winter,


            $_POST['data-type'],
            $_FILES['file']
        );
    }
    //===================================================================

    public function delete_image()
    {
        $img_id = $_GET['id'];
        $img_body_part = $_GET['name'];

        $img_upload = new Image();

        $result =  $img_upload->delete_image($img_id, $img_body_part);

        print_r($result);
    }

    //VAZIO
    public function search_img_by_name()
    {
        $name = $_GET['data'];


        /*         $params = [
            ':img_name' => $name,
            ':id_owner' => $_SESSION['user_id']

        ];

        $results =  $db->select(
            "SELECT * FROM images 
             WHERE img_name 
             LIKE CONCAT('%', :img_name, '%') 
             AND id_owner = :id_owner ",
            $params
        );



         $jsonArray = json_encode($results);
         echo $jsonArray;
          */
    }
}
