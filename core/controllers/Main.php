<?php

namespace core\controllers;

use core\classes\Functions;
use core\classes\Api;
use core\classes\SendEmail;
use core\models\Image;
use core\models\User;
use core\models\Itens;
use core\models\Product;

class Main
{

    public function home_page()
    {

        if (!Functions::user_logged()) {


            $product = new Product();

            $data = $product->list_product();

            Functions::Layout([
                'layouts/html_header',
                'layouts/header',
                'home',
                'layouts/footer',
                'layouts/html_footer',
            ], $data);
        } else {

            $product = new Product();

            $data = $product->list_product();

            Functions::Layout([
                'layouts/html_header',
                'layouts/header',
                'home',
                'layouts/footer',
                'layouts/html_footer',
            ], $data);
        }
    }
    //===================================================================

    public function signup_page()
    {

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'signup',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
    //===================================================================

    public function signin_page()
    {

        //Verifies if there's an open session
        if (Functions::user_logged()) {
            Functions::redirect();
            return;
        }


        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'signin',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
    //===================================================================

    public function email_sent_page()
    {
        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'email_sent_page',

            'layouts/html_footer',
        ]);
    }
    //===================================================================

    public function reset_password_page()
    {
        if (!isset($_GET['token'])) {
            $_SESSION['error'] = 'Invalid token';
            Functions::redirect('send_recovery_email');
            return;
        }

        $token = $_GET['token'];

        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'reset_password',
            'layouts/footer',
            'layouts/html_footer',
        ], $token);
    }
    //===================================================================

    public function send_recovery_email_page()
    {
        Functions::Layout([
            'layouts/html_header',
            'layouts/header',
            'send_recovery_email',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
    //===================================================================




    //API
    public function weather_api()
    {


        //Verifies if there's an open session
        if (!Functions::user_logged()) {
            Functions::redirect();
        }

        $apiKey = $this->apiKey;
        $lat = $_GET['latitude'];
        $lon = $_GET['longitude'];

        $url = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=$apiKey";

        // Send GET request to the API
        $response = file_get_contents($url);

        // Check if the request was successful
        if ($response !== false) {
            // Convert JSON response to an associative array
            $data = json_decode($response, true);

            // Get temperature
            $temp_kevin = $data['main']['temp'];

            $temp_celcius = $temp_kevin  - 273.15;
            $temp_celcius = round($temp_celcius);
            echo  $temp_celcius;
        } else {

            echo "Failed to retrieve data from the API";
        }
    }
}
