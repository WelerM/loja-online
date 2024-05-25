<?php

namespace core\controllers;

use core\classes\Database;
use core\models\User;
use core\classes\Functions;
use core\classes\SendEmail;
use core\models\Admin;
use core\models\Product;

class AdminController
{
    public function answer_questions_page()
    {


        $user = new Admin();
        $results  = $user->get_user_questions();

        $data = json_decode(json_encode($results), true);

        // print_r($data);
        // die();
        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'answer_questions_page',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }
    //===============================================================


    public function answer_question()
    {



        $answer =  $_POST['answer'];
        $product_id =  $_POST['product_id'];

    
        $admin = new Admin();

        $results = $admin->answer_question($product_id, $answer);

        print_r($results);
    }


    public function get_all_user_questions_by_product(){
  
        $product_id =  $_GET['product_id'];
        $client_id =  $_GET['client_id'];

        $admin = new Admin();

        $results = $admin->get_all_user_questions_by_product($product_id, $client_id);

        $results = json_encode($results);
        print_r($results);

    }

}
