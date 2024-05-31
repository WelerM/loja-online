<?php

$routes = [
    
    //User controller
    'home_page' => 'usercontroller@home_page',
    'login_page' => 'usercontroller@login_page',
    'register_page' => 'usercontroller@register_page',
    'send_recovery_email_page' => 'usercontroller@send_recovery_email_page',
    'reset_password_page' => 'usercontroller@reset_password_page',
    'email_sent_page' => 'usercontroller@email_sent_page',
    'account_page' => 'usercontroller@account_page',
    'login' => 'usercontroller@login',
    'register' => 'usercontroller@register',
    'signout' => 'usercontroller@signout',
    'send_recovery_email' => 'usercontroller@send_recovery_email',
    'reset_password' => 'usercontroller@reset_password',
    'confirm_email' => 'usercontroller@confirm_email',
    'is_user_logged' => 'usercontroller@is_user_logged',
    'delete_account' => 'usercontroller@delete_account',
    
    
    //Product
    'create_product_page' => 'productcontroller@create_product_page',
    'create_product' => 'productcontroller@create_product',
    'product_details_page' => 'productcontroller@product_details_page',
    'list_products_page' => 'productcontroller@list_products_page',
    'make_question' => 'productcontroller@make_question',
    'show_product_question_details' => 'productcontroller@show_product_question_details',

    
    //Admin
    'answer_question' => 'admincontroller@answer_question',
    'get_user_questions' => 'admincontroller@get_user_questions',
    'answer_questions_page' => 'admincontroller@answer_questions_page',

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
/* $action = 'home';

//Verifies if action exists on string query
if (isset($_GET['a'])) {

    //Verifies if action exists on routes
    if (!key_exists($_GET['a'], $routes)) {
        $action = 'home';
    } else {
        $action = $_GET['a'];
    }
}

$parts = explode('@', $routes[$action]);
$controller = 'core\\controllers\\' . ucfirst($parts[0]);
$method = $parts[1];

$ctr = new $controller();
$ctr->$method();
 */