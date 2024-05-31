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
        //-----------------------------------------------------------



        //Checks if there are user's questions on this product
        $results = $db->select(
            "SELECT * FROM product_messages    
            WHERE product_messages.product_id = :id"
            ,
            $params
        );

        if (count($results) === 0) {//No user's questions for this product

            try {
                $results = $db->select(
                    "SELECT 
                    products.id AS product_id,
                    products.name AS product_name,
                    products.price AS product_price,
                    products.description AS product_description,
                    products.link AS product_link,
                    products.img_src AS product_img_src
    
                     FROM products
                    WHERE products.id = :id"
                    ,
                    $params
                );

                $results = json_decode(json_encode($results[0]), true);

                return $results;

            } catch (Exception $e) {
                echo $e;
            }
        }
        //-----------------------------------------------------------


        //User's questions exist for this project
        try {

            $results = $db->select(
                "SELECT 
                    products.id AS product_id,
                    products.name AS product_name,
                    products.price AS product_price,
                    products.description AS product_description,
                    products.link AS product_link,
                    products.img_src AS product_img_src,
                    products.created_at AS product_created_at,
                    GROUP_CONCAT(CONCAT(product_messages.question, '::', users.name, '::', product_messages.created_at) ORDER BY product_messages.id DESC) AS product_messages
                FROM products
                JOIN product_messages ON products.id = product_messages.product_id
                JOIN users ON product_messages.user_id = users.id
                WHERE products.id = :id
                GROUP BY products.id, products.name, products.price, products.description, products.link, products.img_src, products.created_at",
                $params
            );

            // Convert the result object to an array
            $resultsArray = json_decode(json_encode($results), true);

            $result = $resultsArray[0]; // Assuming there is only one product for the given id
            // Split user_messages into an array
            $userQuestionsArray = explode(',', $result['product_messages']);
            $parsedQuestions = [];

            foreach ($userQuestionsArray as $question) {
                list($questionText, $userName, $questionCreated_at) = explode('::', $question);
                $parsedQuestions[] = [
                    'user_question' => $questionText,
                    'user_name' => $userName,
                    'question_created_at' => $questionCreated_at,
                ];
            }

            $result['product_messages'] = $parsedQuestions;

            return $result;

        } catch (Exception $e) {
            return $e;
        }
        //-----------------------------------------------------------

    }


    public function list_products()
    {

        $db = new Database();

        $results = $db->select("SELECT * FROM products");

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
        $root = $_SERVER["DOCUMENT_ROOT"] . '/loja/public';

        $uniqueName = round(microtime(true) * 1000);
        $file_new_name = $product_name . "_" . $uniqueName . "." . $fileActualExt;
        $fileDestination = $root . '/assets/images/products/' . $file_new_name;
        $file_src = 'assets/images/products/' . $file_new_name;

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
                ':user_id' => $_SESSION['user_id'],
                ':question' => trim($_POST['question-text'])
            ];

            $db->insert(
                "INSERT INTO user_questions VALUES(
                         0,
                        :product_id,
                        :user_id,
                        DEFAULT,
                        :question,
                        DEFAULT,
                        NOW()
                    )",
                $params
            );

            return true;

        } catch (Exception $e) {
            return false;
        }
    }









    public function list_questions($product_id)
    {
        try {

            $db = new Database();

            $params = [
                ':product_id' => $product_id

            ];
            $results = $db->select(
                "SELECT client_questions.question, client_questions.created_at, users.name FROM client_questions
                JOIN products
                ON client_questions.product_id = products.id
                JOIN users
                ON client_questions.client_id = users.id
                WHERE products.id = :product_id
                ORDER BY client_questions.id DESC",
                $params
            );

            $results = (array) $results;
            $results = json_decode(json_encode($results), true);

            return $results;
        } catch (Exception $e) {

            echo $e;

            die();
        }
    }

    public function show_product_question_details($product_message_id)
    {
        $db = new Database();

        $params = [
            ':product_message_id' => $product_message_id,
            ':active' => 1
        ];

        try {


            $results = $db->select(
                "SELECT
                    product_messages.question AS user_question,
                    product_messages.created_at AS question_created_at,
                    users.name AS user_name
                FROM 
                    product_messages
                JOIN 
                    users
                ON 
                    product_messages.user_id = users.id
                WHERE 
                    product_messages.id = :product_message_id
                AND 
                    product_messages.active = :active",
                $params
            );

            //    print_r($results);
            //  die();

            return $results;

        } catch (Exception $e) {
            echo $e;
        }
    }
}
