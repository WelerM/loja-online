<?php

namespace core\models;

use core\classes\Database;
use core\classes\Functions;
use core\models\Image;
use Exception;

class Admin
{


    public function answer_question($product_id, $product_message_id, $answer)
    {

        $db = new Database();
        $last_inserted_answer_id = null;

        try {

            //Create registry on table 'products answers'
            $params = [
                ':answer' => $answer,
                ':product_id' => $product_id,
            ];

            $last_inserted_answer_id = $db->insert(
                "INSERT INTO 
                    product_answers
                 VALUES(
                    0,
                    :product_id,
                    :answer,
                    NOW()
                )",
                $params
            );

            //------------------------------------


            //Update table product_messages answer_id & active 
            $params = [
                ':last_inserted_answer_id' => $last_inserted_answer_id,
                ':active' => 0,
                ':id' => $product_message_id
            ];

            $db->update(
                "UPDATE
                    product_messages
                SET
                    answer_id = :last_inserted_answer_id,
                    active = :active
                WHERE
                    id = :id",
                $params
            );

            return true;

        } catch (Exception $e) {
            return false;
        }
    }



    public function list_active_product_questions()
    {

        try {

            $db = new Database();

            $params = [
                ':active' => 1
            ];

            $results = $db->select(
                "SELECT 
                    product_messages.id AS product_message_id,
                    product_messages.message AS product_message,
                    product_messages.created_at AS message_created_at,

                    users.id AS user_id,
                    users.name AS user_name,

                    products.id AS product_id,
                    products.name AS product_name,
                    products.price AS product_price,
                    products.img_src AS img_src
                FROM 
                    product_messages
                JOIN 
                    users 
                ON 
                    product_messages.user_id = users.id
                JOIN
                    products
                ON
                    product_messages.product_id = products.id
                WHERE 
                    product_messages.active = :active",
                $params
            );

            $results = json_decode(json_encode($results), true);
            return $results;
        } catch (Exception $e) {
            echo $e;
        }
    }
}
