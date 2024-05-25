<?php

namespace core\models;

use core\classes\Database;
use core\classes\Functions;
use core\models\Image;
use Exception;

class Product
{

    public function show_product($product_id)
    {
        $db = new Database();

        $params = [
            ':id' => $product_id
        ];

        $results =  $db->select(
            "SELECT * FROM products WHERE id = :id",
            $params
        );

        $results = json_decode(json_encode($results), true);

        return $results;
    }

    public function list_product()
    {

        $db = new Database();

        $results =  $db->select("SELECT * FROM products");

        $results = json_decode(json_encode($results), true);

        return $results;
    }

    public function save_product(

        $product_name,
        $product_price,
        $fileActualExt,
        $fileTmpName,
        $product_link
    ) {


        //Inserts new image into system's folder
        $root = $_SERVER["DOCUMENT_ROOT"] . '/loja/PHP-MVC-CRUD-Login-System/public';
        $uniqueName = round(microtime(true) * 1000);
        $file_new_name = $product_name . "_"   . $uniqueName . "." . $fileActualExt;
        $fileDestination = $root . '/assets/images/'  . $file_new_name;
        $file_src = 'assets/images/' . $file_new_name;

        move_uploaded_file($fileTmpName, $fileDestination);
        //===================================================================




        try {

            //Inserts product into database
            $db = new Database();

            $params = [
                ':name' => trim($_POST['product-name']),
                ':price' => $product_price,
                ':description' => strtolower(trim($_POST['product-description'])),
                ':img_src' => $file_src,
                ':link' => $product_link
            ];
            $db->insert(
                "INSERT INTO products VALUES(
                        0,
                        :name,
                        :price,
                        :description,
                        :img_src,
                        :link,
                        NOW(),
                        NOW()
                    )",
                $params
            );
        } catch (Exception $e) {

            echo $e;

            die();
        }
    }

    public function make_question()
    {

        
        try {

            //Inserts product into database
            $db = new Database();

            $params = [
                ':product_id' => $_GET['product_id'],
                ':client_id' => $_SESSION['user_id'],
                ':question' => trim($_POST['question-text'])
            ];

            $db->insert(
                "INSERT INTO client_questions VALUES(
                         0,
                        :product_id,
                        :client_id,
                        :question,
                        NOW()
                    )",
                $params
            );

        } catch (Exception $e) {

            echo $e;

            die();
        }
    }

    public function list_questions($product_id)
    {
        try {

            $db = new Database();

            $params = [
                ':product_id' => $product_id

            ];
            $results =  $db->select(
                "SELECT client_questions.question, client_questions.created_at, users.name FROM client_questions
                JOIN products
                ON client_questions.product_id = products.id
                JOIN users
                ON client_questions.client_id = users.id
                WHERE products.id = :product_id
                ORDER BY client_questions.id DESC", $params
            );
/* 

            print_r($results);
            die("product model");


            $results['user'] = 'weler';
            */
            $results = (array)$results;
             $results = json_decode(json_encode($results), true);

            return $results;
        } catch (Exception $e) {

            echo $e;

            die();
        }
    }
}
