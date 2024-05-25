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

        $results =  $db->select(
            "SELECT *  FROM client_questions
           JOIN products
           ON client_questions.product_id = products.id
           WHERE client_questions.active = :active",
            $params
        );
    }



    public function get_user_questions()
    {
        $db = new Database();

        $params = [
            ':active' => 1
        ];

        $results =  $db->select(
            "SELECT *  FROM client_questions
            JOIN products
            ON client_questions.product_id = products.id
            WHERE client_questions.active = :active",
            $params
        );


        return $results;
    }


    public function get_all_user_questions_by_product($product_id, $client_id)
    {
        $db = new Database();

        $params = [
            ':client_id' => $client_id,
            ':product_id' => $product_id,
        ];

        $results =  $db->select(
            "SELECT * FROM client_questions
            JOIN users
            ON client_questions.client_id = users.id
            WHERE client_id = :client_id
            AND product_id = :product_id", $params
        );


        return $results;
    }
}
