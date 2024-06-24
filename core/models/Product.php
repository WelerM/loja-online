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
                link,
                created_at
            FROM
                products
            WHERE 
                products.id = :id",
            $params
        );

        $result['product_details'] = json_decode(json_encode($product_details[0]), true);
        //------------------------------------------------

        try {
            $params = [
                ':product_id' => $product_id
            ];

            // Get user's questions made on this product along with admin answers
            $product_messages = $db->select(
                "SELECT 
                    users.name AS user_name,
                    product_messages.message AS user_message,
                    product_messages.message_created_at AS message_created_at,
                    product_messages.answer AS admin_answer,
                    product_messages.answer_created_at AS answer_created_at
                FROM
                    product_messages
                JOIN
                    users
                ON
                    product_messages.user_id = users.id
                WHERE
                    product_messages.product_id = :product_id
                AND
                    product_messages.deleted_at IS NULL
                ORDER BY
                    product_messages.id
                DESC",
                $params
            );

            $result['product_messages'] = json_decode(json_encode($product_messages), true);

            return $result;
        } catch (Exception $e) {

            return false;
        }
    }


    public function list_products()
    {

        $db = new Database();

        $results = $db->select(
            "SELECT * FROM 
                products
            WHERE
                products.deleted_at
            IS NULL 
            ORDER BY
                 id
             DESC"
        );

        $results = json_decode(json_encode($results), true);

        return $results;
    }
    //===================================================
    public function list_deleted_products()
    {

        $db = new Database();

        $results = $db->select(
            "SELECT * FROM 
                products
            WHERE
                products.deleted_at
            IS NOT NULL 
            ORDER BY
                 id
             DESC"
        );

        $results = json_decode(json_encode($results), true);

        return $results;
    }
    //===================================================

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
                        NOW(),
                        NULL
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

            $admin_id = 1;

            $params = [
                ':user_id' => $_SESSION['user_id'],
                ':product_id' => $_GET['product_id'],
                ':message' => trim($_POST['question-text'])
            ];

            $db->insert(
                "INSERT INTO 
                    product_messages 
                VALUES(
                         0,
                        :user_id,
                        :product_id,
                        :message,
                        NULL,
                        DEFAULT,
                        NOW(),
                        NULL,
                        NULL
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
                "SELECT 
                    client_questions.question,
                    client_questions.created_at,
                    users.name
                FROM
                    client_questions
                JOIN 
                    products
                ON 
                    client_questions.product_id = products.id
                JOIN 
                    users
                ON 
                    client_questions.client_id = users.id
                WHERE
                     products.id = :product_id
                ORDER BY
                    client_questions.id
                DESC",
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
                    products.id AS product_id,
                    product_messages.message AS user_question,
                    product_messages.message_created_at AS question_created_at,
                    users.id AS user_id,
                    users.name AS user_name
                FROM 
                    product_messages
                JOIN
                    products
                ON
                    product_messages.product_id = products.id
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

        $results = $db->select(
            "SELECT * FROM 
                products
            ORDER BY
                products.id
            DESC"
        );

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


    public function edit_product()
    {

        $db = new Database();

        //Will not update product image
        if ($_FILES['file']['size'] === 0) {

            try {

                $params = [
                    ':id' => $_POST['product-id'],
                    ':product_name' => $_POST['product-name'],
                    ':product_price' => $_POST['product-price'],
                    ':product_description' => $_POST['product-description'],
                    ':product_link' => $_POST['product-link'],
                ];

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
        }
        //--------------------------------------------




        //Will update image file

        //Update database
        //Update file system
        //Deletar img file from system
        //Add new file into system

        $update_result = false;
        $product_name = trim($_POST['product-name']);
        $file = $_FILES['file'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $root = APP_DOCUMENT_ROOT . '/public';
        $uniqueName = round(microtime(true) * 1000);
        $file_new_name = $product_name . "_" . $uniqueName . "." . $fileActualExt;
        $fileDestination = $root . '/assets/images/products/' . $file_new_name;
        $file_src = 'assets/images/products/' . $file_new_name;
        //-----------------------------------------


        //Gets img_file_name from database
        //To delete old img file in the sytem

        $select_result = null;

        try {
            $params = [
                'product_id' => $_POST['product-id']
            ];

            $select_result = $db->select(
                "SELECT
                    img_src
                FROM 
                    products
                WHERE
                    id = :product_id",
                $params
            );
        } catch (Exception $e) {
            //    echo $e;
            //return false;
        }

        if (count($select_result) === 0) {
            //    echo 'count failed';
            //return false;
        }
        //-----------------------------------------


        //Delete img from system
        $path_to_delete_img = APP_DOCUMENT_ROOT . '/public/' . $select_result[0]->img_src;

        //Verifies if file  exists on server's folder
        if (!file_exists($path_to_delete_img)) {
            //   echo 'file does not exists';
            //return false;
        }

        //Delete on server folder
        if (!unlink($path_to_delete_img)) {
            //      echo 'failed to delete path';
            //return false;
        }



        //Update database

        try {

            $params = [
                ':id' => $_POST['product-id'],
                ':product_name' => $_POST['product-name'],
                ':product_price' => $_POST['product-price'],
                ':product_description' => $_POST['product-description'],

                ':img_src' => $file_src,
                ':img_file_name' => $file_new_name,

                ':product_link' => $_POST['product-link']
            ];

            $update_result = $db->update(
                "UPDATE 
                    products
                SET
                    name = :product_name,
                    price = :product_price,
                    description = :product_description,
                    img_src = :img_src,
                    img_file_name = :img_file_name,
                    link = :product_link,
                    updated_at = NOW()
                WHERE
                    id = :id",
                $params
            );
        } catch (Exception $e) {
            //     echo $e;
            //return false;
        }
        //  ------------------------------------------------------


        //Checks if update failed
        if (!$update_result) {
            echo 'update result failed';
            die('');
            //   return false;
        }


        move_uploaded_file($fileTmpName, $fileDestination);

        return true;
    }


    public function delete_product($product_id)
    {
        $db = new Database();

        $params = [
            ':id' => $product_id
        ];

        $result = null;
        $handle_deletion_result = false;




        //Checks if produc exists on database
        try {
            $result = $db->select(
                "SELECT  * FROM
                    products
                WHERE
                    id = :id",
                $params
            );
        } catch (Exception $e) {
            echo $e;
            return false;
        }

        if (count($result) === 0) {
            return false;
        }

        $img_file_name = $result[0]->img_file_name;
        //---------------------------------------


        //Proceeds to update product to "deleted" on database
        try {
            $db->update(
                "UPDATE
                    products
                 SET
                    deleted_at = NOW()
                WHERE
                    id = :id",
                $params
            );

            $handle_deletion_result = true;
        } catch (Exception $e) {

            $handle_deletion_result = false;
        }

        //Checks if product was deleted
        if (!$handle_deletion_result) {
            return false;
        }
        //---------------------------------------


        //Proceeds to delete product from server's folder
        $path_to_delete_img = APP_DOCUMENT_ROOT . '/public/assets/images/products/' . $img_file_name;


        //Verifies if file  exists on server's folder
        if (!file_exists($path_to_delete_img)) {

            return false;
        }

        //Delete on server folder
        if (!unlink($path_to_delete_img)) {
            return false;
        }

        return true;
    }

    public function get_products_count()
    {
        $db = new Database();

        $result = $db->select("SELECT COUNT(*) AS products_count FROM products");


        $result = json_decode(json_encode($result[0]), true);
        return $result['products_count'];
    }

    public function get_products_messages_count()
    {
        $db = new Database();
        $params = [
            ':active' => 1

        ];
        $result = $db->select(
            "SELECT COUNT(*) AS products_messages_count 
             FROM
                 product_messages
            WHERE
                 active = :active",
            $params
        );

        $result = json_decode(json_encode($result[0]), true);
        return $result['products_messages_count'];
    }

    public function delete_product_message($message_id)
    {

        //Update product message table
        //Set deleted_at

        try {

            $db = new Database();

            $params = [
                ':id' => $message_id
            ];

            $db->update(
                "UPDATE
                    product_messages
                SET 
                    active = 0,
                    deleted_at = NOW()
                WHERE
                    id = :id",
                $params
            );

            return true;
        } catch (Exception $e) {

            return false;
        }
    }
}
