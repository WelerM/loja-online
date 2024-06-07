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
            'answer_questions_page',
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

    public function list_user_messages_page()
    {

        $admin = new Admin();

        $data = $admin->list_active_user_messasges();

        // print_r($data);
        // die();
        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'list_user_messages_page',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }

    // public function answer_user_messages_page()
    // {

    //     $admin = new Admin();

    //     $data = '';// $admin->list_active_user_messasges();

    //     // print_r($data);
    //     // die();

    //     Functions::Layout([
    //         'layouts/html_header',
    //         'layouts/header',
    //         'answer_user_message',
    //         'layouts/footer',
    //         'layouts/html_footer',
    //     ], $data);

    // }



    public function answer_user_message_page()
    {

        echo $_GET['user_id'];

        die();
        $_GET['product-id'];

        $admin = new Admin();

        $data = $admin->get_user_message_information();

        // print_r($data);
        // die();
        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'answer_user_message_page',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);

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
