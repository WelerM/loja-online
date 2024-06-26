<?php

namespace core\models;

use core\classes\Database;
use core\classes\Functions;
use core\classes\Log;
use core\classes\SendEmail;
use core\models\Image;
use Exception;
use stdClass;

class Admin
{


    public function answer_question()
    {

        $db = new Database();

        try {

            //Update registry on table 'products_messages'
            $params = [
                ':product_message_id' => trim($_POST['product-message-id']),
                ':answer' => trim($_POST['answer']),
                ':active' => 0
            ];

            $db->update(
                "UPDATE
                    product_messages
                SET
                    answer = :answer,
                    active = :active,
                    answer_created_at = NOW()
                WHERE
                    product_messages.id = :product_message_id",
                $params
            );



            return true;
        } catch (Exception $e) {
            echo $e;
        }
    }







    public function list_active_user_messasges()
    {

        $db = new Database();


        try {

            $params = [
                ':active' => 1
            ];

            $results = $db->select(
                "SELECT
                    users.id AS user_id,
                    users.name AS user_name,
                    
                    chat.id AS chat_message_id,
                    chat.message AS user_message,
                    chat.message_created_at AS chat_created_at,
    
                    products.id AS product_id,
                    products.name AS product_name,
                    products.price AS product_price,
                    products.img_src AS product_img_src
                
                FROM
                    chat
                JOIN
                    products
                ON
                    chat.product_id = products.id
                JOIN
                    users
                ON 
                    chat.user_id = users.id
                WHERE
                    chat.active = :active
                AND
                    products.deleted_at IS NULL
                ORDER BY
                    chat.id
                DESC
                ",
                $params
            );

            $results = json_decode(json_encode($results), true);
            return $results;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function get_user_message_information()
    {
        $db = new Database();


        try {

            //Admin is responding....
            $params = [
                ':user_id' => trim($_GET['user_id']),
                ':product_id' => trim($_GET['product-id']),
                ':active' => 1
            ];
            $chat_results = $db->select(
                "SELECT 
                    users.id AS user_id,
                    users.name AS user_name,

                    chat.id AS chat_message_id,
                    chat.message AS message,
                    chat.message_created_at AS message_created_at,

                    products.id AS product_id

                 FROM
                    chat    
                JOIN
                    users
                ON 
                    chat.user_id = users.id
                JOIN
                    products
                ON
                    chat.product_id = products.id
                WHERE
                    product_id = :product_id
                AND
                    chat.user_id = :user_id
                AND 
                    chat.active = :active",
                $params
            );



            $results['user_chat_messages'] = '';

            if (count($chat_results) != 0) {
                $results['user_chat_messages'] = json_decode(json_encode($chat_results), true);
            }

            $results = json_decode(json_encode($results), true);

            return $results;
        } catch (Exception $e) {
            echo $e;
        }




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


    }

    public function get_admin_data()
    {
        $db = new Database();
        $result = new stdClass;

        $result->products_number = count($db->select("SELECT * FROM products"));
        $result->products_messages = count($db->select("SELECT * FROM product_messages"));
        $result->user_messages = count($db->select("SELECT * FROM chat WHERE is_responded != 1"));

        $results = json_decode(json_encode($result), true);
        return $results;
    }

    public function answer_user_message()
    {

        // #1 create a new register in Chat table, responsible for being
        //  The admin answer
        $db = new Database();

        $result_admn_answer = false;

        try {

            $params = [
                ':chat_message_id' => $_POST['chat-message-id'],
                ':answer' => $_POST['answer'],
                ':active' => 0
            ];


            $db->update(
                "UPDATE
                    chat
                SET
                    answer = :answer,
                    active = :active,
                    answer_created_at = NOW()
                WHERE
                    id = :chat_message_id",
                $params
            );

            $result_admn_answer = true;
        } catch (Exception $e) {

            $log = new Log('error');
       
            $result_admn_answer = false;
        }
        //------------------------------------------------------------------------------


        if (!$result_admn_answer) {

            return false;
        }


        return true;
    }

    public function get_user_messages_count()
    {
        $db = new Database();

        $params = [
            ':active' => 1
        ];

        $result = $db->select(
            "SELECT COUNT(*) AS user_messages_count 
             FROM
                 chat
            WHERE
                 active = :active",
            $params
        );

        $result = json_decode(json_encode($result[0]), true);
        return $result['user_messages_count'];
    }



}
