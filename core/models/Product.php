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
        $product_details = $db->select(
            "SELECT
                id, 
                name,
                price,
                description,
                img_src,
                link
            FROM
                products
            WHERE products.id = :id",
            $params
        );

        $result['product_details'] = json_decode(json_encode($product_details[0]), true);


        $product_messages = $db->select(
            "SELECT
                message,
                name,
                product_messages.created_at AS message_created_at
            FROM
                product_messages
            JOIN
                users
            ON
                product_messages.user_id = users.id
            WHERE 
                product_messages.product_id = :id
            ORDER BY product_messages.id DESC",
            $params
        );


        $result['product_messages'] =   json_decode(json_encode($product_messages), true);


        return $result;


        //-----------------------------------------------------------

    }


    public function list_products()
    {

        $db = new Database();

        $results = $db->select("SELECT * FROM products");

        $results = json_decode(json_encode($results), true);

        return $results;
    }

    public function create_product(

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
                ':img_file_name' => $file_new_name,
                ':link' => $product_link
            ];
            $db->insert(
                "INSERT INTO products VALUES(
                        0,
                        :name,
                        :price,
                        :description,
                        :img_src,
                        :img_file_name,
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
                ':message' => trim($_POST['question-text'])
            ];

            $db->insert(
                "INSERT INTO product_messages VALUES(
                         0,
                        :product_id,
                        :user_id,
                        DEFAULT,
                        :message,
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
                    product_messages.id AS product_message_id,
                    product_messages.message AS user_question,
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



    public function list_my_products()
    {
        $db = new Database();

        $results = $db->select("SELECT * FROM products");

        $results = json_decode(json_encode($results), true);

        return $results;
    }

    public function show_product_details($id)
    {
        $db = new Database();

        $params = [
            ':id' => $id
        ];
        $results = $db->select("SELECT * FROM products WHERE id = :id", $params);

        $results = json_decode(json_encode($results), true);

        return $results;
    }


    public function edit_product($update_product_img)
    {

        $db = new Database();

        if (!$update_product_img) { //Will not update product image

            $params = [
                ':id' => $_POST['product-id'],
                ':product_name' => $_POST['product-name'],
                ':product_price' => $_POST['product-price'],
                ':product_description' => $_POST['product-description'],
                ':product_link' => $_POST['product-link'],
            ];

            try {

                $db->update(
                    "UPDATE 
                                            products
                                         SET
                                            name = :product_name,
                                            price = :product_price,
                                            description = :product_description,
                                            link = :product_link,
                                            updated_at = NOW()
                                         WHERE
                                            id = :id",
                    $params
                );

                return true;
            } catch (Exception $e) {
                return false;
            }
        } else { //Will update product image
            echo ' not kk';
        }
    }


    public function delete_product($id)
    {

        $db = new Database();

        $params = [
            ':id' => $id
        ];

        // //Deletar de
        //  products,
        //  products_messages,
        //  products_answers




        //Delete register from products_answers table
        try {

            $db->delete(
                "DELETE FROM
                            product_answers
                        WHERE
                            answer_id = :product_message_id?????",
                $params
            );
        } catch (Exception $e) {
            echo $e;
            die();
            $_SESSION['error'] = 'Falha ao deletar de products_answersar';
            return false;
        }
        //-------------------------------------------------------------


        //Delete register from products_messages table
        try {

            $db->delete(
                "DELETE FROM
                            product_messages
                        WHERE
                            answer_id = :id",
                $params
            );
        } catch (Exception $e) {
            echo $e;
            die();
            $_SESSION['error'] = 'Falha ao deletar de products_messages';
            return false;
        }
        //-------------------------------------------------------------



        //Delete register from products table
        try {
            $db->delete(
                "DELETE FROM
                    products
                WHERE
                    id = :id",
                $params
            );
        } catch (Exception $e) {
            echo $e;
            die();
            $_SESSION['error'] = 'Falha ao deletar de products';
            return false;
        }
        //-------------------------------------------------------------




        $_SESSION['success'] = 'Pergunta respondida com sucesso';

        return true;
        //-------------------------------------------------------------


    }
}
