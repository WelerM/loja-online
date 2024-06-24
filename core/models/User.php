<?php

namespace core\models;

use core\classes\Database;
use core\classes\Functions;
use core\classes\SendEmail;
use core\models\Image;
use Exception;

class User
{

    public static function get_user_personal_info()
    {
        $db = new Database();

        //Get user's personal data
        $params = [
            ':id' => $_SESSION['user_id']
        ];

        $results = $db->select(
            "SELECT *  FROM
                 users 
             WHERE
                 users.id = :id",
            $params
        );

      // $results = json_decode(json_encode($results[0]), true);


        return $results;
    }
    //============================================================

    public function list_user_messages()
    {
        $db = new Database();

        $params = [
            ':id' => $_SESSION['user_id']
        ];

        $result = $db->select(
            "SELECT 
                users.id AS user_id,
                users.name AS user_name,
                products.name AS product_name,
                products.price AS product_price,
                products.img_src AS product_img_src,
                chat.message,
                chat.message_created_at AS chat_created_at,
                chat.answer AS answer,
                chat.answer_created_at AS answer_created_at
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
                chat.user_id = :id
            ORDER BY chat.id DESC ",
            $params
        );

        $result = json_decode(json_encode($result), true);

        return $result;
    }
    //===================================================================


    public function validate_email($purl)
    {


        $db = new Database();
        $params = [
            ':purl' => $purl
        ];

        $result = $db->select("SELECT * FROM users WHERE purl = :purl", $params);

        if (count($result) != 1) {
            return false;
        }

        $user_id = $result[0]->id;


        //Update client's
        $params = [
            ':id' => $user_id
        ];
        $db->update(
            "UPDATE users
            SET purl = NULL,
            active = 1,
            updated_at = NOW()
            WHERE id = :id",
            $params
        );

        return true;
    }
    //============================================================

    public function list_user_chat_messages($product_id)
    {


        $db = new Database();


        //Get details of the product
        $params = [
            ':product_id' => $product_id
        ];

        $product_results = $db->select(
            "SELECT * FROM
                products
            WHERE
                id = :product_id",
            $params
        );

        // if (count($results) === 0) {
        //     return false;
        // }

        //$results['product_details'] = $results;
        $results['product_details'] = json_decode(json_encode($product_results[0]), true);
        //-------------------------------------------------------------



        //Get chat related to the product
        $params = [
            // ':user_id' => $_SESSION['user_id'],
            ':product_id' => $product_id,
        ];
        $chat_results = $db->select(
            "SELECT 
                users.id AS user_id,
                users.name AS user_name,
                message,
                chat.message_created_at AS message_created_at,
                answer AS admin_answer,
                answer_created_at 
             FROM
                chat
            JOIN
                users
            ON 
                chat.user_id = users.id
            WHERE
                product_id = :product_id",
            $params
        );



        $results['user_chat_messages'] = '';

        if (count($chat_results) != 0) {
            $results['user_chat_messages'] = json_decode(json_encode($chat_results), true);
        }


          $results = json_decode(json_encode($results), true);
        //------------------------------------------------------





        //Checks if user can send a new message
        $params = [
            ':user_id' => $_SESSION['user_id'],
            ':product_id' => $product_id,
        ];

        $result = $db->select(
            "SELECT 
                active
            FROM
                chat
            WHERE
                user_id = :user_id
            AND
                product_id = :product_id
            ORDER BY(id)
            DESC
            LIMIT 1",
            $params
        );

        // print_r($result[0]);
        // die('opa');
        $results['send_new_message'] = true;

        if (count($result) >0 && $result[0]->active != 0) {
            $results['send_new_message'] = false;
        }

        return $results;
    }

    //===================================================================



    public static function verify_email_exists($email)
    {

        $db = new Database();
        $params = [
            ':e' => strtolower(trim($email))
        ];
        $results = $db->select("SELECT * FROM users WHERE email = :e", $params);

        //Verifies if there is a username registered with the same name
        if (count($results) != 0) {
            return true;
        } else {
            return false;
        }
    }
    //============================================================

    public function verify_available_email()
    {

        //REturns false if not available to use
        $db = new Database();

        $params = [
            ':user_id' => $_SESSION['user_id'],
            ':user_email' => trim(strtolower($_POST['email']))
        ];

        $result = $db->select(
            "SELECT * FROM
                users
            WHERE
                email = :user_email
            AND 
                id != :user_id",
            $params
        );

        if (count($result) != 0) {
            return false;
        }

        return true;
    }
    //============================================================




    //Sign in
    public static function validate_login($email, $user_password)
    {

        $db = new Database();

        $params = [
            ':email' => $email
        ];




        //Verify if email exists
        $results = $db->select(
            "SELECT * FROM users 
            WHERE email = :email",
            $params
        );
        if (count($results) === 0) {
            return 'email doesnt exist';
        }
        //---------------------------------------------------



        //Verify if email is confirmed
        $results = $db->select(
            "SELECT * FROM users 
            WHERE email = :email
            AND active = 1",
            $params
        );

        if (count($results) === 0) {
            return 'email not confirmed';
        }
        //---------------------------------------------------


        //User's email exists
        $user = $results[0];


        //Verify if passwords match
        if (!password_verify($user_password, $user->password)) {

            return "Invalid email or password";
        }

        //---------------------------------------------------



        return $user;
    }

    //============================================================

    //Sign Up
    public static function register_user()
    {



        $db = new Database();

        $params = [
            ':email' => strtolower(trim($_POST['signup-email']))
        ];

        //Verifies on DB if a client with same the email exists
        $result = $db->select(
            "SELECT email FROM users WHERE email = :email",
            $params
        );


        if (count($result) != 0) {
            $_SESSION['error'] = "Email already exists!";
            Functions::redirect('register_page');
            exit();
        }




        //Create personal url
        $purl = Functions::createHash();


        //User information is inserted to the "USERS" table
        $params = [
            ':name' => trim($_POST['signup-name']),
            ':email' => strtolower(trim($_POST['signup-email'])),
            ':user_type' => 'client',
            ':password' => password_hash(trim($_POST['signup-password']), PASSWORD_DEFAULT),
            ':active' => 0,
            ':purl' => $purl

        ];

        try {

            $result = $db->insert(
                "INSERT INTO users VALUES(
                                0,
                                :name,
                                :email,
                                :user_type,
                                :password,
                                 NULL,
                                :active,
                                :purl,
                                NOW(),
                                NOW()
                            )",
                $params
            );


            return $purl;
        } catch (Exception $e) {
            echo $e;
        }
    }
    //============================================================
    public function edit_account()
    {

        //edit in the database
        $db = new Database();

        try {

            $params = [
                ':user_id' => $_SESSION['user_id'],
                ':user_name' => $_POST['name'],
                ':user_email' => $_POST['email'],
                ':user_password' => password_hash(trim($_POST['password']), PASSWORD_DEFAULT)
            ];

            $db->update(
                "UPDATE
                    users
                SET
                    name = :user_name,
                    email = :user_email,
                    password = :user_password,
                    updated_at = NOW()
                WHERE
                    id = :user_id",
                $params
            );

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }


    //Recover password
    public function check_email_exists($email)
    {
        $db = new Database();

        $params = [
            ':email' => $email
        ];

        $result = $db->select("
        SELECT * FROM users WHERE email = :email", $params);

        //Verifies on DB if a client with same the email exists
        if (count($result) === 0) {
            return false;
        }

        return true;
    }
    //============================================================

    public function update_token($email, $token)
    {
        $db = new Database();

        $params = [
            ':email' => $email,
            ':password_reset_token' => $token
        ];

        try {

            $db->update("
            UPDATE users 
            SET password_reset_token = :password_reset_token
            WHERE email = :email", $params);
        } catch (Exception $e) {
            echo $e;
        }
    }
    //============================================================

    public function check_token_exists($token)
    {
        $db = new Database();

        $params = [
            ':password_reset_token' => $token
        ];

        $result = $db->select("
        SELECT * FROM users
        WHERE password_reset_token = :password_reset_token", $params);

        return $result;
    }
    //============================================================

    public function update_user_password($user_id, $passowrd)
    {
        $db = new Database();

        $params = [
            ':id' => $user_id,
            ':password' => password_hash(trim($passowrd), PASSWORD_DEFAULT),
        ];


        $db->update("
            UPDATE users
            SET password = :password
            WHERE id = :id", $params);
    }
    //============================================================


    public function get_all_user_questions_by_product($product_id)
    {
        $db = new Database();

        $params = [
            ':id' => $product_id
        ];

        try {

            $results = $db->select(
                "SELECT 
                    products.name AS product_name,
                    products.price AS product_price,
                    products.description AS product_description,
                    products.created_at AS product_created_at,
                    GROUP_CONCAT(user_questions.question) AS user_questions
                    FROM products
                    JOIN user_questions
                    ON products.id = user_questions.product_id 
                    WHERE products.id = :id",
                $params
            );

            // Assume $results is the array you want to modify
            $userQuestionsArray = [];

            foreach ($results as $row) {
                // Explode the comma-separated string into an array and merge with existing questions
                $userQuestionsArray = array_merge($userQuestionsArray, explode(',', $row->user_questions));
            }

            // Remove duplicates
            $userQuestionsArray = array_unique($userQuestionsArray);

            // Assign the combined array to the user_questions field in the first result
            $results[0]->user_questions = $userQuestionsArray;

            // Remove the user_questions field from other results
            for ($i = 1; $i < count($results); $i++) {
                unset($results[$i]->user_questions);
            }

            // Convert the modified array to JSON and send it as the response


            return $results;
        } catch (Exception $th) {
            return $th;
        }
    }
    //============================================================



    public static function delete_account($user_password)
    {


        $db = new Database();

        $params = [
            ':id' => $_SESSION['user_id']
        ];

        $result = $db->select(
            "SELECT * FROM users
            WHERE id = :id",
            $params
        );



        //Verify if passwords match
        if (!password_verify($user_password, $result[0]->password)) {

            $_SESSION['error'] = "Invalid password";
            Functions::redirect('account_page');
            exit();
        }
        //-----------------------------------------------------------------



        //Delete all user's images from the system's folders and database

        //-----------------------------------------------------------------



        //Delete all user's information from the database
        $db->delete(
            "DELETE FROM users
            WHERE id = :id",
            $params
        );

        session_unset();
        session_destroy();

        //Redirect to the home page
        Functions::redirect();
    }
    //===================================================================



    public function contact_store($user_message, $user_id, $product_id)
    {

        //Store message into database
        //Sends email to store's admin

        $db = new Database();


        // Store message into database
        $params = [
            ':user_id' => $user_id,
            ':product_id' => $product_id,
            ':message' => $user_message
        ];

        $insert_result = $db->insert(
            "INSERT INTO
                chat
             VALUES(
                0,
                :user_id,
                :product_id,
                :message,
                DEFAULT,
                DEFAULT,
                NOW(),
                DEFAULT
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
    //===================================================================



}
