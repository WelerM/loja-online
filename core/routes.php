<?php

$routes = [
    // User controller
    'home' => 'usercontroller@home_page',
    'editar-conta' => 'usercontroller@edit_account_page',
    'minha-conta' => 'usercontroller@account_page',
    'minhas-mensagens' => 'usercontroller@my_messages_page',
    'contatar-loja' => 'usercontroller@contact_store_page',
    
    'delete_account' => 'usercontroller@delete_account',
    'edit_account' => 'usercontroller@edit_account',


    //auth
    'entrar' => 'usercontroller@login_page',
    'registrar' => 'usercontroller@register_page',
    'login' => 'usercontroller@login',
    'register' => 'usercontroller@register',
    'signout' => 'usercontroller@signout',
    'redefinir-senha' => 'usercontroller@reset_password_page',

    //Email    
    'recuperar-senha' => 'usercontroller@send_recovery_email_page',
    'email-enviado' => 'usercontroller@email_sent_page',
    'send_recovery_email' => 'usercontroller@send_recovery_email',
    'reset_password' => 'usercontroller@reset_password',
    'confirm_email' => 'usercontroller@confirm_email',
    'is_user_logged' => 'usercontroller@is_user_logged',
    

    
    // Product
    'criar-produto' => 'productcontroller@create_product_page',
    'detalhes-do-produto' => 'productcontroller@product_details_page',
    'meus-produtos' => 'productcontroller@list_products_page',    
    'editar-produto' => 'productcontroller@edit_product_page',

    'create_product' => 'productcontroller@create_product',
    'make_question' => 'productcontroller@make_question',
    'show_product_question_details' => 'productcontroller@show_product_question_details',
    'edit_product' => 'productcontroller@edit_product',
    'delete_product' => 'productcontroller@delete_product',
    'delete-product-question' => 'productcontroller@delete_product_message',
    

    // Admin
    'perguntas-em-produtos' => 'productcontroller@product_questions_page',
    'mensagens-de-usuarios' => 'admincontroller@list_user_messages_page',
    'delete-user-message' => 'productcontroller@delete_user_message',
    
    
    
    'responder-mensagem-de-usuario' => 'admincontroller@answer_user_message_page',
    'answer_user_message' => 'admincontroller@answer_user_message',
    'answer_question' => 'admincontroller@answer_question',

    'get_user_questions' => 'admincontroller@get_user_questions',

    'contact_store' => 'usercontroller@contact_store',
];

$action = 'home';
$id = null; // Initialize ID as null
$extraSegment = null; // Initialize extra segment as null

// Verifies if action exists on string query
if (isset($_GET['a'])) {
    $query = $_GET['a'];

    // Check if the query exactly matches any defined route
    if (array_key_exists($query, $routes)) {
        $action = $query;
    } else {
        // Split the query to extract action and ID if present
        $queryParts = explode('/', $query);
        $potentialAction = implode('/', array_slice($queryParts, 0, 1));
        $extraSegment = implode('/', array_slice($queryParts, 1)); // Everything after the action

        // Verifies if the potential action exists in routes
        if (array_key_exists($potentialAction, $routes)) {
            $action = $potentialAction;
            if (is_numeric($extraSegment)) {
                $id = (int)$extraSegment; // Convert ID to integer
                $extraSegment = null; // Clear extra segment if it's an ID
            }
        } else {
            $action = 'home';
        }
    }
}

$parts = explode('@', $routes[$action]);
$controller = 'core\\controllers\\' . ucfirst($parts[0]);
$method = $parts[1];

$ctr = new $controller();
if ($id !== null) {
    $ctr->$method($id); // Pass the ID to the method if it exists
} else {
    $ctr->$method($extraSegment); // Pass the extra segment to the method if it exists
}
