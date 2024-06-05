<?php

namespace core\models;

use core\classes\Database;
use core\classes\Functions;
use core\classes\SendEmail;
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
                ':product_id' => $product_id,
                ':answer' => $answer
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
            return $e;
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

    public function contact_store($user_message, $user_id, $product_id)
    {

        //Store message into database
        //Sends email to store's admin

        $db = new Database();


        // Store message into database
        $params = [
            ':user_id' => $user_id,
            ':receiver_id' => 1,
            ':product_id' => $product_id,
            ':user_message' => $user_message
        ];

        $insert_result = $db->insert(
            "INSERT INTO
                chat
             VALUES(
                0,
                :user_id,
                :receiver_id,
                :product_id,
                :user_message,
                NOW()
             )",
            $params
        );

        if (!$insert_result) {
            return false;
        }
        //---------------------------------------




        //Sends email to store's admin

        //Gets user information
        $params = [
            ':user_id' => $user_id
        ];

        $select_result = $db->select(
            "SELECT
                name,
                email
            FROM
                users
            WHERE 
                id = :user_id",
            $params
        );

        $user_name = $select_result[0]->name;
        $user_email = $select_result[0]->email;

        //Sends email to admin
        $email = new SendEmail();
        $result = $email->send_email_to_admin($user_message, $user_name, $user_email, $product_id);

        return $result;
    }
}
