<?php


namespace core\controllers;

use core\models\Admin;
use core\models\Product;
use core\classes\Functions;

class ProductController
{

    public function product_details_page($id = null)
    {

        $product_id = $id;

        $product = new Product();

        $data = $product->show_product($product_id);


        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'product/product_details_page',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }

    public function list_products_page()
    {

        $product = new Product();

        $data = $product->list_products();


        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'product/list_products_page',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }

    public function create_product_page()
    {
        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'product/create_product_page',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }

    public function my_products_page()
    {

        $product = new Product();

        $data = $product->list_my_products();



        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'admin/my_products_page',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }

    public function edit_product_page($id = null)
    {

        $product = new Product();

        $data = $product->show_product_details($id);


        // print_r($data);
        // die();

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'admin/edit_product_page',
            'layouts/footer',
            'layouts/html_footer',
        ], $data);
    }




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

        //Gets instruction on which table will be processed. Ex. top, torso, legs, feet



        //-------------------------------------------------------------------




        //Checks if user chose a name for the image
        if (!isset($_POST['product-name'])) {

            Functions::redirect("home&data=&error=noimgname");
            exit();
        }
        if (empty(trim($_POST['product-name']))) {
            Functions::redirect("home&data=&error=noimgname");
            exit();
        }

        //-------------------------------------------------------------------




        //Checks if img extension is valid
        if (!in_array($fileActualExt, $allowed)) {
            Functions::redirect("home&&error=filenotsupported");
            exit();
        }

        //Checks if there was an error uploading the img
        if ($fileError !== 0) {
            Functions::redirect("home&error=uploaderror");
            exit();
        }

        //Checks if img size is under the specific value
        if ($fileSize >= 1000000) {
            Functions::redirect("home&error=filetoobig");
            exit();
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


        //The variable "data" in the URL will be used inside the "start" function in the script.js file
        Functions::redirect("home&data='imgsaved'&error=none");
        exit();
    }
    public function edit_product()
    {

        //Checar se parametros vem corretamente
        // echo $_POST['product-name'] . '<br>';
        // echo $_POST['product-description'] . '<br>';
        // echo $_POST['product-link'] . '<br>';
        // echo $_POST['product-name'] . '<br>';

        $product = new Product();

        $product_id = $_POST['product-id'];

        //Checks whether or not a new image was choosen 
        if ($_FILES['file']['size'] === 0) { //Will not update product image

            $result = $product->edit_product($update_product_img = false);

            if (!$result) {

                Functions::redirect('edit_product_page/' . $product_id);
                $_SESSION['error'] = 'Erro editar produto';

                return;
            } else {

                Functions::redirect('edit_product_page/' . $product_id);
                $_SESSION['success'] = 'Produto editado com sucesso';

                return;
            }
        } else { //Will update product image
            $result = $product->edit_product($update_product_img = true);

            if (!$result) {

                Functions::redirect('answer_questions_page');
                $_SESSION['error'] = 'Erro ao responder pergunta';

                return;
            } else {

                Functions::redirect('answer_questions_page');
                $_SESSION['success'] = 'Pergunta respondida com sucesso';

                return;
            }
        }
    }

    public function delete_product($product_id)
    {


        $product = new Product();

        $result = $product->delete_product($product_id);


        if (!$result) {
            $_SESSION['error'] = 'Falha ao deletar de produto';
            Functions::redirect('my_products_page');
            return;
        }

        $_SESSION['success'] = 'Pergunta respondida com sucesso';
        Functions::redirect('my_products_page');
        return;
    }

    public function make_question()
    {
        $product_id = $_GET['product_id'];

        //checks if user is logged
        if (!isset($_SESSION['user_id'])) {
            Functions::redirect("show_product/" . $product_id);
            exit();
        }

        if (!isset($_GET['product_id'])) {
            Functions::redirect("show_product/" . $product_id);
            exit();

            die('product id not found');
        }


        $product = new Product();

        $result = $product->make_question();

        if (!$result) {
            //The variable "data" in the URL will be used inside the "start" function in the script.js file
            Functions::redirect("product_details_page/" . $product_id . '&error');
            exit();
        }

        //The variable "data" in the URL will be used inside the "start" function in the script.js file
        Functions::redirect("product_details_page/" . $product_id);
        exit();
    }


    public function list_products()
    {
        $products = new Product();
    }

    // public function list_users_with_active_questions()
    // {

    // }

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


}
