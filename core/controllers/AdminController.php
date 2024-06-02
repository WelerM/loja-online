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

        $admin = new Admin();

        $results = $admin->list_active_product_questions();
        $data = json_decode(json_encode($results), true);

        // print_r($results);
        // die();

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'admin/answer_questions_page',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }
    //===============================================================


    public function answer_question()
    {

        $answer = $_POST['answer'];
        $product_message_id = $_POST['product_message_id'];

        //  $prod

        $admin = new Admin();

        $results = $admin->answer_question($product_message_id, $answer);

        if (!$results) {

            Functions::redirect('answer_questions_page');
            $_SESSION['error'] = 'Erro ao responder pergunta';

            return;
        }


            Functions::redirect('answer_questions_page');
            $_SESSION['success'] = 'Pergunta respondida com sucesso';

            return;
    }
}
