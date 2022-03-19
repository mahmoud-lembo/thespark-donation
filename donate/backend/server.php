<?php

require './../vendor/autoload.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
 if(!empty($_POST['type'])  && !empty($_POST['amount']))
 {
    $post = filter_var_array($_POST, FILTER_SANITIZE_STRING);

     $stripe = new \Stripe\StripeClient('sk_test_51Kf8XRJQA3NsMFFiVNKZE5CdAwhmK2toWlIOET9TNuoJvgfEctVoJ8u7uJ2UWOSMndUVnfBOGiPDENddBjpqRkA800P9Yb0Ff7');
     $session = $stripe->checkout->sessions->create([
        'success_url' => 'http://localhost/thespark/donate/frontend/index.html?status=success',
        'cancel_url' => 'http://localhost/thespark/donate/frontend/index.html?status=failure',
        'mode' => 'payment',
        'submit_type' => 'donate',
        'payment_method_types'  => ['card', 'alipay'],
        'line_items' => [
            [
                'quantity' => 1,
                'price_data' =>[
                    'currency' => 'usd',
                    'unit_amount' => $post['amount']*100,
                    'product_data' => [
                        'name' => $post['type']
                    ]
                ]
            ]
        ]
        
     ]);

    echo $session->id;
 }


}




?>