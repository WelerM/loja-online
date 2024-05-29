<?php

namespace core\models;

use core\classes\Database;
use core\classes\Functions;
use core\models\Image;
use Exception;

class Admin
{


    public function answer_question($product_id, $answer)
    {

        $db = new Database();


        //Criar registro na tabela 'answers'


        //Dar update em 'active' para 'falso'no registro correto
        //dentro da tabela client_questions


        $params = [
            ':active' => 1
        ];

        $results = $db->select(
            "SELECT *  FROM client_questions
           JOIN products
           ON client_questions.product_id = products.id
           WHERE client_questions.active = :active",
            $params
        );
    }



    public function list_users_with_active_questions()
    {

        try {

            $db = new Database();

            $params = [
                ':active' => 1
            ];



            $results = $db->select(
                "SELECT 
                    users.id AS user_id,
                    users.name AS user_name,
                    uq.question AS last_active_question,
                    uq.created_at AS last_active_question_date,
                    products.img_src
                FROM users
                JOIN (
                    SELECT 
                    user_id, 
                    question, 
                    created_at, 
                    product_id
                    FROM user_questions
                    WHERE active = :active
                    AND (user_id, created_at) IN (
                        SELECT user_id, MAX(created_at)
                        FROM user_questions
                        WHERE active = :active
                        GROUP BY user_id
                    )
                ) AS uq
                ON users.id = uq.user_id
                JOIN products
                ON uq.product_id = products.id",
                $params
            );
            // Remove the 'last_active_question_date' if you don't want to include it in the final results
            // foreach ($results as &$user) {
            //     unset($user->last_active_question_date);
            // }




            return $results;

        } catch (Exception $e) {
            echo $e;
        }
    }



}
