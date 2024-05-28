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
            "SELECT * FROM user_questions
            WHERE user_questions.product_id = :id"
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
                                GROUP_CONCAT(CONCAT(user_questions.question, '::', users.name, '::', user_questions.created_at)) AS user_questions
                                FROM products
                                JOIN user_questions ON products.id = user_questions.product_id
                                JOIN users ON user_questions.user_id = users.id
                                WHERE products.id = :id",
                $params
            );

            // Convert the result object to an array
            $resultsArray = json_decode(json_encode($results), true);

            $result = $resultsArray[0]; // Assuming there is only one product for the given id
            // Split user_questions into an array
            $userQuestionsArray = explode(',', $result['user_questions']);
            $parsedQuestions = [];

            foreach ($userQuestionsArray as $question) {
                list($questionText, $userName, $questionCreated_at) = explode('::', $question);
                $parsedQuestions[] = [
                    'user_question' => $questionText,
                    'user_name' => $userName,
                    'question_created_at' => $questionCreated_at,
                ];
            }

            $result['user_questions'] = $parsedQuestions;

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

            die('aqui');

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

    public function get_all_user_questions_by_product($product_id, $client_id)
    {
        $db = new Database();

        $params = [
            ':client_id' => $client_id,
            ':product_id' => $product_id,
        ];

        $results = $db->select(
            "SELECT 
             users.name AS user_name,
             user_questions.id AS question_id,
             user_questions.question AS user_question,
             user_questions.answer AS store_answer,
             user_questions.active AS question_active,
             user_questions.created_at AS question_created_at
            
            FROM user_questions
            JOIN users
            ON user_questions.client_id = users.id
            WHERE client_id = :client_id
            AND product_id = :product_id
            ORDER BY question_id DESC",
            $params//REsolver esse errro
        );


        return $results;
    }
}
