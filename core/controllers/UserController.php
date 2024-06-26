<?php

namespace core\controllers;

use core\classes\Log;
use core\models\User;
use core\classes\Functions;
use core\classes\SendEmail;
use core\models\Admin;
use core\models\Product;
use Exception;

class UserController
{

    public function home_page()
    {

        // $logger = new Log();
        // $logger->logger('testando kk', 'warning');


        $product = new Product();
        $admin = new Admin();

        //Main data to view
        $data = $product->list_products();

        //Header data
        $header_data = [
            'products_count' => $product->get_products_count(),
            'products_questions_count' => $product->get_products_messages_count(),
            'user_messages_count' => $admin->get_user_messages_count()
        ];




        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'home',
            'layouts/footer',
            'layouts/html_footer',
        ], $data, $header_data);
    }
    //===================================================================

    public function account_page()
    {

        //Verifies if there's an open session
        if (!Functions::user_logged()) {
            Functions::redirect();
            return;
        }

        //Get user data
        $user = new User();
        $admin = new Admin();
        $product = new Product();

        //Main data to view
        $data = $user->get_user_personal_info();

        //Header data
        $header_data = [
            'products_count' => $product->get_products_count(),
            'products_questions_count' => $product->get_products_messages_count(),
            'user_messages_count' => $admin->get_user_messages_count()
        ];

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'minha-conta',
            'layouts/footer',
            'layouts/html_footer',
        ], $data, $header_data);
    }
    //===================================================================


    public function register_page()
    {
        //Verifies if there's an open session
        if (Functions::user_logged()) {
            Functions::redirect();
            return;
        }

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'auth/registrar',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
    //===================================================================

    public function login_page()
    {

        //Verifies if there's an open session
        if (Functions::user_logged()) {
            Functions::redirect();
            return;
        }


        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'auth/entrar',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
    //===================================================================

    public function email_sent_page()
    {
        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'auth/email-enviado',
            'layouts/html_footer',
        ]);
    }
    //===================================================================

    public function reset_password_page()
    {
        if (!isset($_GET['token'])) {
            $_SESSION['error'] = 'Invalid token';
            Functions::redirect('send_recovery_email');
            return;
        }

        $token = $_GET['token'];

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'auth/redefinir-senha',
            'layouts/footer',
            'layouts/html_footer',
        ], $token);
    }
    //===================================================================


    public function my_messages_page()
    {

        $user = new User();
        $admin = new Admin();
        $product = new Product();

        $data = $user->list_user_messages();

        // print_r($data);

        //Header data
        $header_data = [
            'products_count' => $product->get_products_count(),
            'products_questions_count' => $product->get_products_messages_count(),
            'user_messages_count' => $admin->get_user_messages_count()
        ];

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'minhas-mensagens',
            'layouts/footer',
            'layouts/html_footer',
        ], $data, $header_data);
    }
    //===================================================================


    public function send_recovery_email_page()
    {
        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'send_recovery_email',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
    //===================================================================

    public function edit_account_page()
    {

        //Get user old data to fill inputs
        $user = new User();
        $admin = new Admin();
        $product = new Product();

        $data = $user->get_user_personal_info();

        
        // print_r($data);
        //Header data
        $header_data = [
            'products_count' => $product->get_products_count(),
            'products_questions_count' => $product->get_products_messages_count(),
            'user_messages_count' => $admin->get_user_messages_count()
        ];

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'editar-conta',
            'layouts/footer',
            'layouts/html_footer',

        ], $data, $header_data);
    }
    //===================================================================



    //Being used in javascript
    public static function is_user_logged()
    {
        //Verifies if there's an open session

        if (Functions::user_logged()) {
            // Functions::redirect();
            echo 'true';
        } else {
            echo 'false';
        }
    }
    //===================================================================


    //Sign In
    public function login()
    {


        //Verifies if there's an open session
        if (Functions::user_logged()) {
            Functions::redirect();
            return;
        }


        //Verifies if there was a form submition
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Functions::redirect();
            return;
        }


        //Verifies if input fields came correctly filled
        if (
            !isset($_POST['login-email']) ||
            !isset($_POST['login-password'])

        ) {

            $_SESSION['error'] = "Empty fields!";

            Functions::redirect('entrar');
            return;
        }


        //Prepare data to model
        $user_email = trim(strtolower($_POST['login-email']));
        $user_password = trim($_POST['login-password']);


        //Validate login
        $users = new User();

        $result = $users->validate_login($user_email, $user_password);


        if (is_string($result)) {
            $_SESSION['error'] = $result;
            Functions::redirect('entrar');
            return;
        }

        //Valid login
        $_SESSION['user_id'] = $result->id;
        $_SESSION['user_name'] = $result->name;
        $_SESSION['user_email'] = $result->email;
        $_SESSION['user_type'] = $result->user_type;

        Functions::redirect('home');
    }
    //===================================================================


    public function contact_store_page($id)
    {
        //Checks if user is logged
        if (!Functions::user_logged()) {
            $_SESSION['error'] = "É necessário fazer login para entrar em contato";
            Functions::redirect('detalhes-do-produto/' . $id);
            return;
        }

        $product_id = $id;

        $user = new User();
        $admin = new Admin();
        $product = new Product();


        //Show prodcut preview 
        $data = $user->list_user_chat_messages($product_id);

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
            'contatar-loja',
            'layouts/footer',
            'layouts/html_footer',
        ], $data, $header_data);
    }
    //===================================================================

    public function contact_store()
    {
        //Store message into database
        //Sends email to store's admin

        $user_message = $_POST['user-message'];
        $user_id = $_POST['user-id'];
        $product_id = $_POST['product-id'];

        $user = new User();
        $result = $user->contact_store($user_message, $user_id, $product_id);



        if (!$result) {

            Functions::redirect('contatar-loja/' . $product_id);
            $_SESSION['error'] = 'Erro ao enviar mensagem';

            return;
        };

        Functions::redirect('contatar-loja/' . $product_id);
        $_SESSION['success'] = 'Mensagem enviada com sucesso! Aguarde a loja responder.';

        return;
    }

    //===================================================================

    public function register()
    {


        //Verifies if there's an open session
        if (Functions::user_logged()) {
            Functions::redirect();
            exit();
        }


        //Verifies if there was a form submition
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Functions::redirect();
            exit();
        }


        //Checks for unset inputs 
        if (
            !isset($_POST['signup-name']) ||
            !isset($_POST['signup-email']) ||
            !isset($_POST['signup-password']) ||
            !isset($_POST['signup-repeat-password'])
        ) {
            $_SESSION['error'] = "Empty fields!";
            Functions::redirect('register_page');
            exit();
        }

        //Checks for empty fields
        if (
            trim(empty($_POST['signup-name'])) ||
            trim(empty($_POST['signup-email'])) ||
            trim(empty($_POST['signup-password'])) ||
            trim(empty($_POST['signup-repeat-password']))
        ) {
            $_SESSION['error'] = "Empty fields!";
            Functions::redirect('register_page');
            exit();
        }

        //Checks for valid email
        if (filter_var(trim($_POST['signup-email']), FILTER_VALIDATE_EMAIL) === false) {
            $_SESSION['error'] = "Invalid email!";
            Functions::redirect('register_page');
            exit();
        }

        //Verifies if password = repeat-password
        if ($_POST['signup-password'] != $_POST['signup-repeat-password']) {
            $_SESSION['error'] = "Passwords don't match!";
            Functions::redirect('register_page');
            exit();
        }



        //Verifies on DB if a client with same the email exists
        $users = new User();

        if ($users->verify_email_exists($_POST['signup-email'])) {

            $_SESSION['error'] = "Esse email já está sendo utilizado!";
            Functions::redirect('register_page');
            exit();
        }



        //Register user on 'USERS' table & 'LOCATION' table
        //Personal URL is returned after registration
        $purl = $users->register_user();


        $email = new SendEmail();

        $client_email = strtolower(trim($_POST['signup-email']));
        $email->send_email($client_email, $purl);
    }
    //===================================================================


    public function signout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_type']);
        Functions::redirect();
    }
    //===================================================================


    //Sign Up
    public function confirm_email()
    {


        //Verifies if there's an open session
        if (Functions::user_logged()) {
            Functions::redirect();
            return;
        }

        //VErifies if purl exists in the url query
        if (!isset($_GET['purl'])) {
            Functions::redirect();
            return;
        }

        $purl = $_GET['purl'];

        //Verifies if purl is valid
        if (strlen($purl) != 12) {
            die('c');
            Functions::redirect();
            return;
        }


        $users = new User();
        $result = $users->validate_email($purl);

        if (!$result) {

            $_SESSION['error'] = "Error when confirming your email";

            Functions::Layout([
                'layouts/html_header',
                'layouts/header',
                'login/entrar',
                'layouts/html_footer',
            ]);
        }


        $_SESSION['success'] = 'Emal confirmation successfull';
        $logger = new Log();
        $logger->logger('Novo usuário no sistema', 'INFO');

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'login/entrar',
            'layouts/html_footer',
        ]);
    }
    //===================================================================

    public function send_recovery_email()
    {
        //Verifies if there was a form submition
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Functions::redirect();
            return;
        }

        if (!isset($_POST['email']) && trim($_POST['repeat-password']) === '') {
            $_SESSION['error'] = 'Empty fields';
            Functions::redirect('send_recovery_email');
            return;
        }

        $user_email = strtolower(trim($_POST['email']));


        //Checks if user email exists on database
        $users = new User();
        $email = new SendEmail();

        if (!$users->check_email_exists($user_email)) {

            $_SESSION['error'] = "This email doesn't exist on database";
            Functions::redirect('send_recovery_email_page');
            return;
        }


        //If email exists, update user's column 'password_reset_token' with the
        //nearly created token above
        $token = bin2hex(random_bytes(32));

        $users->update_token($user_email, $token);

        //Sends email to reset password
        $email->send_email_reset_password($user_email, $token);

        Functions::redirect('email_sent_page');
    }
    //===================================================================

    public function reset_password()
    {


        $token = $_POST['token'];


        if (!isset($_POST['password']) || !isset($_POST['repeat-password'])) {
            $_SESSION['error'] = "Empty fields";

            Functions::redirect("redefinir-senha&token=$token");
            return;
        }
        if (empty(trim($_POST['password'])) || empty(trim($_POST['repeat-password']))) {
            $_SESSION['error'] = "Empty fields";

            Functions::redirect("redefinir-senha&token=$token");
            return;
        }

        //Chek if  passwords match
        if (trim($_POST['password']) != trim($_POST['repeat-password'])) {
            $_SESSION['error'] = "Passwords don't match";

            Functions::redirect("redefinir-senha&token=$token");
            return;
        }



        //asks  database if toek exists
        $users = new User();

        $result = $users->check_token_exists($token);

        if (count($result) === 0) {
            $_SESSION['error'] = "Invalid token";
            Functions::redirect("redefinir-senha&token=$token");
            return;
        }


        //If exists, get user id and update its password
        $user_id = $result[0]->id;


        $users->update_user_password($user_id, $_POST['password']);

        $_SESSION['success'] = "Your password was redefined!";
        Functions::redirect('login_page');
    }
    //===================================================================


    public function delete_account()
    {

        // $user_password = trim($_POST['password']);

        // $users = new User();
        // $users->delete_account($user_password);


        echo 'delete acc controller';
    }
    //===================================================================

    public function edit_account()
    {
        $user = new User();

        //Verifies if there's an open session
        if (!Functions::user_logged()) {
            Functions::redirect('editar-conta');
            return;
        }
        //Verifies if there was a form submition
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Functions::redirect('editar-conta');
            return;
        }
        //Checks for unset inputs 
        if (
            !isset($_POST['name']) ||
            !isset($_POST['email']) ||
            !isset($_POST['password']) ||
            !isset($_POST['repeat-password'])
        ) {
            $_SESSION['error'] = "Empty fields!";
            Functions::redirect('editar-conta');
            return;
        }

        //Checks for empty fields
        if (
            trim(empty($_POST['name'])) ||
            trim(empty($_POST['email'])) ||
            trim(empty($_POST['password'])) ||
            trim(empty($_POST['repeat-password']))
        ) {
            $_SESSION['error'] = "Empty fields!";
            Functions::redirect('editar-conta');
            return;
        }

        //Verifies if password = repeat-password
        if ($_POST['password'] != $_POST['repeat-password']) {
            $_SESSION['error'] = "Passwords don't match!";
            Functions::redirect('editar-conta');
            return;
        }

        //---------------------------------------------
        //Checks for valid email
        if (filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL) === false) {
            $_SESSION['error'] = "Invalid email!";
            Functions::redirect('editar-conta');
            return;
        }

        //Verifies if new email is available to use
        $check_email_available = $user->verify_available_email();


        if (!$check_email_available) {
            $_SESSION['error'] = "Este email já está em uso. Por favor, escolha outro email";
            Functions::redirect('minha-conta');
            return;
        }


        $result = $user->edit_account();

        if (!$result) {
            $_SESSION['error'] = "Erro ao editar conta!";
            Functions::redirect('minha-conta');
            return;
        }

        $_SESSION['success'] = "Conta editada com sucesso!";
        Functions::redirect('minha-conta');
    }
    //===================================================================
}
