<?php

$routes = [
    
    //User controller
    'home_page' => 'usercontroller@home_page',
    'login_page' => 'usercontroller@login_page',
    'register_page' => 'usercontroller@register_page',
    'send_recovery_email_page' => 'usercontroller@send_recovery_email_page',
    'redefinir-senha' => 'usercontroller@reset_password_page',
    'email_sent_page' => 'usercontroller@email_sent_page',
    'account_page' => 'usercontroller@account_page',
    'my_messages_page' => 'usercontroller@my_messages_page',
    'edit_account_page' => 'usercontroller@edit_account_page',

    'login' => 'usercontroller@login',
    'register' => 'usercontroller@register',
    'signout' => 'usercontroller@signout',
    'send_recovery_email' => 'usercontroller@send_recovery_email',
    'reset_password' => 'usercontroller@reset_password',
    'confirm_email' => 'usercontroller@confirm_email',
    'is_user_logged' => 'usercontroller@is_user_logged',
    'delete_account' => 'usercontroller@delete_account',
    'edit_account' => 'usercontroller@edit_account',
    
    
    //Product
    'create_product_page' => 'productcontroller@create_product_page',
    'create_product' => 'productcontroller@create_product',
    'product_details_page' => 'productcontroller@product_details_page',
    'list_products_page' => 'productcontroller@list_products_page',
    'make_question' => 'productcontroller@make_question',
    'show_product_question_details' => 'productcontroller@show_product_question_details',
    'my_products_page' => 'productcontroller@my_products_page',
    'edit_product_page' => 'productcontroller@edit_product_page',
    'edit_product' => 'productcontroller@edit_product',
    'delete_product' => 'productcontroller@delete_product',
    'delete-product-question' => 'productcontroller@delete_product_message',

    
    //Admin
    //product questions
    'answer_question' => 'admincontroller@answer_question',
    'perguntas-em-produtos/nao-respondidas' => 'admincontroller@product_questions_page',

    'list_user_messages_page' => 'admincontroller@list_user_messages_page',
    'answer_user_message_page' => 'admincontroller@answer_user_message_page',
    'answer_user_message' => 'admincontroller@answer_user_message',

    'get_user_questions' => 'admincontroller@get_user_questions',
    'contact_store_page' => 'usercontroller@contact_store_page',
    'contact_store' => 'usercontroller@contact_store',

];



$action = 'home_page';
$id = null; // Initialize ID as null

// Verifies if action exists on string query
if (isset($_GET['a'])) {
    // Split the query to extract action and ID if present
    $queryParts = explode('/', $_GET['a']);
    $actionPart = $queryParts[0]; // This is the action
    $idPart = isset($queryParts[1]) ? $queryParts[1] : null; // This is the ID if present

    // Verifies if action exists in routes
    if (array_key_exists($actionPart, $routes)) {
        $action = $actionPart;
        if (is_numeric($idPart)) {
            $id = (int)$idPart; // Convert ID to integer
        }
    } else {
        $action = 'home_page';
    }
}

$parts = explode('@', $routes[$action]);
$controller = 'core\\controllers\\' . ucfirst($parts[0]);
$method = $parts[1];


$ctr = new $controller();
if ($id !== null) {
    $ctr->$method($id); // Pass the ID to the method if it exists
} else {
    $ctr->$method(); // Call the method without ID if no ID is provided
}
