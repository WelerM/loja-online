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

        try {

            // $results = $db->select(
            //     "SELECT 
            //         products.name AS product_name,
            //         products.price AS product_price,
            //         products.description AS product_description,
            //         products.link AS product_link,
            //         products.img_src AS product_img_src,
            //         products.created_at AS product_created_at,
            //         GROUP_CONCAT(user_questions.question) AS user_questions
            //         FROM products
            //         JOIN user_questions
            //         ON products.id = user_questions.product_id 
            //         WHERE products.id = :id",
            //     $params
            // );

            // Assume $results is the array you want to modify


            // $userQuestionsArray = [];

            // foreach ($results as $row) {
            //     // Explode the comma-separated string into an array and merge with existing questions
            //     $userQuestionsArray = array_merge($userQuestionsArray, explode(',', $row->user_questions));
            // }

            // // Remove duplicates
            // $userQuestionsArray = array_unique($userQuestionsArray);

            // // Assign the combined array to the user_questions field in the first result
            // $results[0]->user_questions = $userQuestionsArray;

            // // Remove the user_questions field from other results
            // for ($i = 1; $i < count($results); $i++) {
            //     unset($results[$i]->user_questions);
            // }

            // // Convert the modified array to JSON and send it as the response
            // $results = json_decode(json_encode($results), true);


            //2




            // $results = $db->select(
            //     "SELECT 
            //         products.name AS product_name,
            //         products.price AS product_price,
            //         products.description AS product_description,
            //         products.link AS product_link,
            //         products.img_src AS product_img_src,
            //         products.created_at AS product_created_at,
            //         GROUP_CONCAT(CONCAT(user_questions.question, '::', users.name, '::', users.email)) AS user_questions
            //     FROM products
            //     JOIN user_questions ON products.id = user_questions.product_id
            //     JOIN users ON user_questions.client_id = users.id
            //     WHERE products.id = :id",
            //     $params
            // );


            // // Assume $results is the array returned from the database query
            // $result = $results[0]; // Assuming there is only one product for the given id
            // // Split user_questions into an array
            // $userQuestionsArray = explode(',', $result['user_questions']);
            // $parsedQuestions = [];


            // foreach ($userQuestionsArray as $question) {
            //     list($questionText, $userName, $userEmail) = explode('::', $question);
            //     $parsedQuestions[] = [
            //         'question' => $questionText,
            //         'user_name' => $userName,
            //         'user_email' => $userEmail
            //     ];

            // }


            // $result['user_questions'] = $parsedQuestions;



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
                    JOIN users ON user_questions.client_id = users.id
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

        } catch (Exception $th) {
            return $th;
        }




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
        $root = $_SERVER["DOCUMENT_ROOT"] . '/loja/PHP-MVC-CRUD-Login-System/public';
        $uniqueName = round(microtime(true) * 1000);
        $file_new_name = $product_name . "_" . $uniqueName . "." . $fileActualExt;
        $fileDestination = $root . '/assets/images/' . $file_new_name;
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
}
