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
        $product_id = $_POST['product_id'];
        $product_message_id = $_POST['product_message_id'];

     
        $admin = new Admin();

        $results = $admin->answer_question($product_id, $product_message_id, $answer);


        if (!$results) {

            $_SESSION['error'] = 'Erro ao responder pergunta';
            Functions::redirect('answer_questions_page');
            return;
        }


        $_SESSION['success'] = 'Pergunta respondida com sucesso';
        Functions::redirect('answer_questions_page');
        return;
    }

    public function contact_store_page($id)
    {
        //Checks if user is logged
        if (!Functions::user_logged()) {
            $_SESSION['error'] = "É necessário fazer login para entrar em contato";
            Functions::redirect('product_details_page/' . $id);
            return;
        }

        $product_id = $id;

        $product = new Product();

        //Show prodcut preview 
        $data = $product->show_product($product_id);


        // print_r($data);
        // die();

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'admin/contact_store_page',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }

    public function contact_store()
    {


        //Store message into database
        //Sends email to store's admin

        $user_message = $_POST['user-message'];
        $user_id = $_POST['user-id'];
        $product_id = $_POST['product-id'];

        $admin = new Admin();
        $result = $admin->contact_store($user_message, $user_id, $product_id);


        if (!$result) {

            Functions::redirect('contact_store_page/' . $product_id);
            $_SESSION['error'] = 'Erro ao enviar mensagem';

            return;
        }
        ;

        Functions::redirect('contact_store_page/' . $product_id);
        $_SESSION['success'] = 'Mensagem enviada com sucesso!';

        return;
    }
}
