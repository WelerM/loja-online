<?php


namespace core\controllers;

use core\models\Admin;
use core\models\Product;
use core\classes\Functions;

class ProductController
{

    public function show_product_page($id = null)
    {

        $product_id = $id;

        $product = new Product();

        $data = $product->show_product($product_id);

        // print_r($data);
        // die();
        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'product/show_product_page',
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

        $product->save_product(
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

        $product->make_question();

        die();
        //The variable "data" in the URL will be used inside the "start" function in the script.js file
        Functions::redirect("show_product/" . $product_id);
        exit();
    }


    public function list_products()
    {
        $products = new Product();
    }



    public function get_all_user_questions_by_product()
    {

        $product_id = $_GET['product_id'];
        $user_id = $_GET['user_id'];

        $product = new Product();

        $results = $product->get_all_user_questions_by_product($product_id, $user_id);

        $results = json_encode($results);
        print_r($results);

    }

}
