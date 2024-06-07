<?php

namespace core\models;

use core\classes\Database;
use core\classes\Functions;
use core\classes\Logger;
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

    public function list_active_user_messasges()
    {

        $db = new Database();

        $params = [
            ':is_responded' => 0,
            ':sender_id' => $_SESSION['user_id']
        ];

        $results = $db->select(
            "SELECT
                users.id AS user_id,
                users.name AS user_name,
                
                chat.id AS chat_message_id,
                chat.message AS user_message,
                chat.created_at AS chat_created_at,
                chat.created_at AS chat_created_at,

                products.id AS product_id,
                products.name AS product_name,
                products.price AS product_price,
                products.img_src AS product_img_src
            
            FROM
                chat
            JOIN
                users
            ON
                chat.sender_id = users.id
            JOIN
                products
            ON 
                chat.product_id = products.id
            WHERE
                is_responded = :is_responded
            AND 
                sender_id != :sender_id",
            $params
        );



        $results = json_decode(json_encode($results), true);

        return $results;
    }

    public function get_user_message_information()
    {
        $db = new Database();

        // $params = [
        //     ':chat_id' => $chat_message_id
        // ];

        // $results = $db->select(
        //     "SELECT
        //         users.id AS user_id,
        //         users.name AS user_name,

        //         chat.id AS chat_message_id,
        //         chat.message AS user_message,
        //         chat.created_at AS chat_created_at,
                
        //         products.id AS product_id,
        //         products.name AS product_name,
        //         products.price AS product_price,
        //         products.img_src AS product_img_src
            
        //     FROM
        //         chat
        //     JOIN
        //         users
        //     ON
        //         chat.sender_id = users.id
        //     JOIN
        //         products
        //     ON 
        //         chat.product_id = products.id
        //     WHERE
        //         chat.id = :chat_id",
        //     $params
        // );


        //Admin is responding....
        $params = [
            ':sender_id' => $_SESSION['user_id'],
            ':receiver_id' => trim($_GET['user-id']),
            ':product_id' => trim($_GET['product-id'])
        ];
        $chat_results = $db->select(
            "SELECT 
                users.id AS user_id,
                users.name AS user_name,
                message,
                chat.created_at AS message_created_at
             FROM
                chat    
            JOIN
                users
            ON 
                chat.sender_id = users.id
            WHERE
                product_id = :product_id
            AND
                (sender_id = :sender_id OR sender_id = :receiver_id)
            ORDER BY
                chat.created_at ASC",
            $params
        );



        $results['user_chat_messages'] = '';

        if (count($chat_results) != 0) {
            $results['user_chat_messages'] = json_decode(json_encode($chat_results), true);
        }


        $results = json_decode(json_encode($results), true);

        return $results;




    }

    public function answer_user_message()
    {

        // #1 create a new register in Chat table, responsible for being
        //  The admin answer
        $db = new Database();

        $result_admn_answer = false;
        $result_update_is_responded = false;

        try {

            $params = [
                ':sender_id' => $_SESSION['user_id'],
                ':receiver_id' => $_POST['user-id'],
                ':product_id' => $_POST['product-id'],
                ':message' => $_POST['answer']
            ];


            $db->insert(
                "INSERT INTO
                    chat
                VALUES(
                    0,
                    :sender_id,
                    :receiver_id,
                    :product_id,
                    :message,
                    DEFAULT,
                    NOW()
                )",
                $params
            );

            $result_admn_answer = true;

        } catch (Exception $e) {

            $log = new Logger('error');
            $log = $log->create_log();
            $log->warning('Error when creating admin chat message: ' . $e->getMessage());

            $result_admn_answer = false;
        }
        //------------------------------------------------------------------------------


        if (!$result_admn_answer) {

            return false;
        }
        //------------------------------------------------------------------------------



        // #2 Update user message as is_responded' = 0

        try {
            $params = [
                ':is_responded' => 1,
                ':chat_message_id' => $_POST['chat-message-id']
            ];

            $result = $db->update(
                "UPDATE 
                    chat
                SET
                    is_responded = :is_responded
                WHERE
                    id = :chat_message_id
                ",
                $params
            );

            $result_update_is_responded = true;


        

        } catch (Exception $e) {

            $log = new Logger('error');
            $log = $log->create_log();
            $log->warning('Error when updating user chat table is_responded = 1: ' . $e->getMessage());

            $result_update_is_responded = false;
        }
        //------------------------------------------------------------------------------

        if (!$result_admn_answer || !$result_update_is_responded) {
            return false;
        }

        return true;



    }
}
