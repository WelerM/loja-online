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
        $product = new Product();

        $data = $admin->list_active_product_questions();
  
        //Header data
        $header_data = [
            'products_count' => $product->get_products_count(),
            'products_questions_count' => $product->get_products_messages_count(),
            'user_messages_count' => $admin->get_user_messages_count()
        ];

        // print_r($data);

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'answer_questions_page',
            'layouts/footer',
            'layouts/html_footer',
        ], $data, $header_data);
    }
    //===============================================================


    public function answer_question()
    {

        //Check if variables come correctly
        $_POST['answer'];
        $_POST['product_id'];
        $_POST['user_id'];


        $admin = new Admin();

        $results = $admin->answer_question();


        if (!$results) {

            $_SESSION['error'] = 'Erro ao responder pergunta';
            Functions::redirect('answer_questions_page');
            return;
        }


        $_SESSION['success'] = 'Pergunta respondida com sucesso';
        Functions::redirect('answer_questions_page');
        return;
    }

    public function list_user_messages_page()
    {

        $admin = new Admin();
        $product = new Product();

        $data = $admin->list_active_user_messasges();

        //Header data
        $header_data = [
            'products_count' => $product->get_products_count(),
            'products_questions_count' => $product->get_products_messages_count(),
            'user_messages_count' => $admin->get_user_messages_count()
        ];

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'list_user_messages_page',
            'layouts/footer',
            'layouts/html_footer',
        ], $data, $header_data);
    }

    public function answer_user_message_page()
    {


        $admin = new Admin();
        $product = new Product();

        $data = $admin->get_user_message_information();

        //Header data
        $header_data = [
            'products_count' => $product->get_products_count(),
            'products_questions_count' => $product->get_products_messages_count(),
            'user_messages_count' => $admin->get_user_messages_count()
        ];

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'answer_user_message_page',
            'layouts/footer',
            'layouts/html_footer',
        ], $data, $header_data);
    }
    public function answer_user_message($chat_message_id)
    {
        //Check if inputs are coming filled
        if (!isset($_POST['answer'])) {
            $_SESSION['error'] = 'É necessário escrever uma resposta';
            Functions::redirect('answer_user_message_page/' . $chat_message_id);
            return;
        }
        if (!isset($_POST['chat-message-id'])) {
            $_SESSION['error'] = 'Erro';
            Functions::redirect('answer_user_message_page/' . $chat_message_id);
            return;
        }
        if (!isset($_POST['product-id'])) {
            $_SESSION['error'] = 'Erro';
            Functions::redirect('answer_user_message_page/' . $chat_message_id);
            return;
        }
        if (!isset($_POST['user-id'])) {
            $_SESSION['error'] = 'Erro';
            Functions::redirect('answer_user_message_page/' . $chat_message_id);
            return;
        }

        $admin = new Admin();
        $result = $admin->answer_user_message();

        // print_r($params);
        // die();

        if (!$result) {
            $_SESSION['error'] = 'Erro ao responder mensagem de usuário';
            Functions::redirect('answer_user_message_page/' . $chat_message_id);
            return;
        }

        $_SESSION['success'] = 'Mensagem respondida com sucesso';
        Functions::redirect('answer_user_message_page/' . $chat_message_id);
        return;
    }
}
