<?php


namespace core\controllers;

use core\models\Admin;
use core\models\Product;
use core\classes\Functions;

class ProductController
{

    public function product_details_page($id)
    {

        $product_id = $id;

        $product = new Product();
        $admin = new Admin();
        $product = new Product();


        $data = $product->show_product($product_id);

        // print_r($data);
        // die();

        //Header data
        $header_data = [
            'products_count' => $product->get_products_count(),
            'products_questions_count' => $product->get_products_messages_count(),
            'user_messages_count' => $admin->get_user_messages_count()
        ];

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'product/detalhes-do-produto',
            'layouts/footer',
            'layouts/html_footer',
        ], $data, $header_data);
    }
    //================================================

    public function list_products_page($segment = null)
    {

        if (!Functions::user_logged() || $_SESSION['user_id'] != 1) {

            Functions::redirect();
            return;
        }


        $product = new Product();
        $admin = new Admin();
        $product = new Product();
        $data = null;

        if ($segment === 'deletados') {
            $data = $product->list_deleted_products();
        } else if ($segment === NULL) {

            $data = $product->list_products();
        }

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
            'product/meus-produtos',
            'layouts/footer',
            'layouts/html_footer',
        ], $data, $header_data);
    }
    //================================================

    public function create_product_page()
    {

   
        if (!Functions::user_logged() || $_SESSION['user_id'] != 1) {

            Functions::redirect();
            return;
        }

        $admin = new Admin();
        $product = new Product();

        //Header data
        $header_data = [
            'products_count' => $product->get_products_count(),
            'products_questions_count' => $product->get_products_messages_count(),
            'user_messages_count' => $admin->get_user_messages_count()
        ];

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'product/criar-produto',
            'layouts/footer',
            'layouts/html_footer',
        ], null, $header_data);
    }
    //================================================


    public function edit_product_page($id = null)
    {
        $admin = new Admin();
        $product = new Product();

        $data = $product->show_product_details($id);

        //Header data
        $header_data = [
            'products_count' => $product->get_products_count(),
            'products_questions_count' => $product->get_products_messages_count(),
            'user_messages_count' => $admin->get_user_messages_count()
        ];

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'product/editar-produto',
            'layouts/footer',
            'layouts/html_footer',
        ], $data, $header_data);
    }
    //================================================



    public function create_product()
    {



        //Verifies if there was a form submition
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            Functions::redirect();
            return;
        }
        //-------------------------------------------------------------------

        //Image file data
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');


        $product_name = $_POST['product-name'];
        $product_price = $_POST['product-price'];
        $product_link = $_POST['product-link'];
        //-------------------------------------------------------------------



        //Checks if user chose a name for the image
        if (!isset($_POST['product-name'])) {
            $_SESSION['error'] = "Nome do arquivo não informado";
            Functions::redirect("criar-produto");
            return;
        }
        if (empty(trim($_POST['product-name']))) {
            $_SESSION['error'] = "Nome do arquivo não pode estar vazio";
            Functions::redirect("criar-produto");
            return;
        }

        //-------------------------------------------------------------------




        //Checks if img extension is valid
        if (!in_array($fileActualExt, $allowed)) {
            $_SESSION['error'] = "Arquivo não suportado";
            Functions::redirect("criar-produto");
            return;
        }

        //Checks if there was an error uploading the img
        if ($fileError !== 0) {
            $_SESSION['error'] = "Erro ao fazer upload do arquivo";
            Functions::redirect("criar-produto");
            return;
        }

        //Checks if img size is under the specific value
        if ($fileSize >= 1000000) {
            $_SESSION['error'] = "O arquivo é grande demais";
            Functions::redirect("criar-produto");
            return;
        }



        //Save image info into the database
        $product = new Product();

        $product->create_product(
            //data for images table

            $product_name,
            $product_price,
            $fileActualExt,
            $fileTmpName,
            $product_link

        );


        $_SESSION['success'] = "Produto inserido com sucesso";
        Functions::redirect("meus-produtos");
        return;
    }
    //================================================
    public function edit_product()
    {

        $product_id = $_POST['product-id'];


        //Check if params come correctly
        //Product name
        if (!isset($_POST['product-name']) || empty(trim($_POST['product-name']))) {
            $_SESSION['error'] = 'É necessário adicionar um nome para o produto';
            Functions::redirect('edit_product_page/' . $product_id);
            return;
        }
        //Produt price
        if (!isset($_POST['product-price']) || empty(trim($_POST['product-price']))) {
            $_SESSION['error'] = 'É necessário adicionar um preço para o produto';
            Functions::redirect('edit_product_page/' . $product_id);
            return;
        }
        //Produt description
        if (!isset($_POST['product-description']) || empty(trim($_POST['product-description']))) {
            $_SESSION['error'] = 'É necessário adicionar uma descrição para o produto';
            Functions::redirect('edit_product_page/' . $product_id);
            return;
        }
        //Produt link
        if (!isset($_POST['product-link']) || empty(trim($_POST['product-link']))) {
            $_SESSION['error'] = 'É necessário adicionar um link para o produto';
            Functions::redirect('edit_product_page/' . $product_id);
            return;
        }
        //--------------------------------------------------------------------


        $product = new Product();

        //Checks whether or not a new image was choosen:
        if ($_FILES['file']['size'] === 0) { //Will not update product image

            $result = $product->edit_product();

            if (!$result) {

                $_SESSION['error'] = 'Erro editar produto';
                Functions::redirect('my_products_page');
                return;
            }

            $_SESSION['success'] = 'Produto editado com sucesso';
            Functions::redirect('meus-produtos');
            return;
        };
        //---------------------------------------------------------------



        //Checks whether or not a new image was choosen:
        if ($_FILES['file']['size'] != 0) { //Will update product image

            //Checks if an image file was choosen by the user

            $result = $product->edit_product();

            if (!$result) {

                $_SESSION['error'] = 'Erro ao editar produto';
                Functions::redirect('my_products_page');
                return;
            }


            $_SESSION['success'] = 'Produto editado com sucesso';
            Functions::redirect('meus-produtos');
            return;
        };
    }
    //================================================


    public function make_question()
    {
        $product_id = $_GET['product_id'];

        //checks if user is logged
        if (!isset($_SESSION['user_id'])) {
            Functions::redirect("detalhes-do-produto/" . $product_id);
            exit();
        }

        if (!isset($_GET['product_id'])) {
            Functions::redirect("detalhes-do-produto/" . $product_id);
            exit();

            die('product id not found');
        }


        $product = new Product();

        $result = $product->make_question();


        if (!$result) {
            $_SESSION['error'] = 'Erro ao fazer pergunta';
            //The variable "data" in the URL will be used inside the "start" function in the script.js file
            Functions::redirect("detalhes-do-produto/" . $product_id . '&error');
            return;
        }

        //The variable "data" in the URL will be used inside the "start" function in the script.js file
        $_SESSION['success'] = 'Pergunta realizada com sucesso';
        Functions::redirect("detalhes-do-produto/" . $product_id);
        return;
    }
    //================================================


    public function show_product_question_details()
    {


        $product_message_id = $_GET['product_message_id'];

        $product = new Product();

        $results = $product->show_product_question_details($product_message_id);

        // echo 'f';
        // die();
        $results = json_encode($results);
        print_r($results);
    }
    //================================================

    public function delete_product($product_id)
    {


        $product = new Product();

        $result = $product->delete_product($product_id);
        // print_r($result);
        // die();

        if (!$result) {
            $_SESSION['error'] = 'Falha ao deletar de produto';
            Functions::redirect('meus-produtos');
            return;
        }

        $_SESSION['success'] = 'Produto deletado com sucesso';
        Functions::redirect('meus-produtos');
        return;
    }
    //================================================

    public function delete_product_message($message_id)
    {

        $product = new Product();
        $result = $product->delete_product_message($message_id);


        if (!$result) {
            $_SESSION['error'] = 'Erro ao deletar mensagem de produto';
            Functions::redirect("perguntas-em-produtos");
            return;
        }

        $_SESSION['success'] = 'Mensagem de produto deletada com sucesso';
        Functions::redirect("perguntas-em-produtos");
        return;
    }
    //================================================


    public function delete_user_message($message_id)
    {


        $product = new Product();
        $result = $product->delete_user_message($message_id);

        if (!$result) {
            $_SESSION['error'] = 'Erro ao deletar mensagem de usuário';
            Functions::redirect("mensagens-de-usuarios");
            return;
        }

        
        $_SESSION['success'] = 'Mensagem de usuário deletada com sucesso';
        Functions::redirect("mensagens-de-usuarios");
        return;

    }
//===============================================================
public function product_questions_page($segment = null)
{



    //Checks if user is admin
    if (!Functions::user_logged() || $_SESSION['user_id'] != 1) {

        Functions::redirect();
        return;
    }

    $data = null;
    $admin = new Admin();
    $product = new Product();


    if ($segment === NULL) {

        $data = $product->list_active_product_questions();
    } else if ($segment === 'nao-respondidas') {

        $data = $product->list_active_product_questions();

    } else if ($segment === 'respondidas') {

        $data = $product->list_answered_product_questions();

    } else if ('deletadas') {

        $data = $product->list_deleted_product_questions();
    }

    //Header data
    $header_data = [
        'products_count' => $product->get_products_count(),
        'products_questions_count' => $product->get_products_messages_count(),
        'user_messages_count' => $admin->get_user_messages_count()
    ];


    Functions::Layout([
        'layouts/html_header',
        'layouts/header',
        'product/perguntas-em-produtos',
        'layouts/footer',
        'layouts/html_footer',
    ], $data, $header_data);
}
}
