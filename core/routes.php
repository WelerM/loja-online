<?php

$routes = [
    
    //Views
    'home' => 'main@home_page',
    'signin_page' => 'main@signin_page',
    'signup_page' => 'main@signup_page',
    'send_recovery_email_page' => 'main@send_rC:\xampp\htdocs\lojaecovery_email_page',
    'reset_password_page' => 'main@reset_password_page',
    'email_sent_page' => 'main@email_sent_page',
    'account_page' => 'usercontroller@account_page',
    'products' => 'productcontroller@products_page',
    'create_product_page' => 'productcontroller@create_product_page',
    'answer_questions_page' => 'admincontroller@answer_questions_page',


    
    //Product
    'create_product' => 'productcontroller@create_product',
    'show_product_page' => 'productcontroller@show_product_page',
    'make_question' => 'productcontroller@make_question',

    //User controller
    'signin' => 'usercontroller@signin',
    'signup' => 'usercontroller@signup',
    'signout' => 'usercontroller@signout',
    'send_recovery_email' => 'usercontroller@send_recovery_email',
    'reset_password' => 'usercontroller@reset_password',
    'confirm_email' => 'usercontroller@confirm_email',
    'is_user_logged' => 'usercontroller@is_user_logged',
    'delete_account' => 'usercontroller@delete_account',
    
    //Admin
    'answer_question' => 'admincontroller@answer_question',
    'get_user_questions' => 'admincontroller@get_user_questions',
    'get_all_user_questions_by_product' => 'productcontroller@get_all_user_questions_by_product',


    //Image Crud
    'display_img' => 'imageController@display_img',
    'search_img_by_name' => 'imageController@search_img_by_name',
    'show_wearing_parts' => 'imageController@show_wearing_parts',
    'show_suggestion' => 'imageController@show_suggestion',
    'show_img_info' => 'imageController@show_img_info',
    'save_image' => 'imageController@save_image',
    'use_image' => 'imageController@use_image',
    'edit_image' => 'imageController@edit_image',
    'delete_image' => 'imageController@delete_image',
];



$action = 'home';
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
        $action = 'home';
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