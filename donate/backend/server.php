<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require './../vendor/autoload.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
 if(!empty($_POST['type'])  && !empty($_POST['amount']))
 {
     
     
    $to = 'mahmoud.m.abdelmalek@gmail.com';
    $name = $_POST["fname"];
    $type = $_POST["type"];
    $payment = $_POST["payment"];
    $email = $_POST["email"];
    $amount = $_POST["amount"];
    $subject = 'Donation Invoice';


    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "From: " . $name . "<".$email.">\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $message ='<table style="width:100%">
        <tr>
            <td>'.$name.'  '.$email.'</td>
        </tr>
        <tr><td>Payment Method: '.$payment.'</td></tr>
        <tr><td>Project: '.$type.'</td></tr>
        <tr><td>Amount: '.$amount.'$</td></tr>     
    </table>';
    @mail($to, $subject, $message, $headers);
    
    $post = filter_var_array($_POST, FILTER_SANITIZE_STRING);

     $stripe = new \Stripe\StripeClient('sk_test_51Kf8XRJQA3NsMFFiVNKZE5CdAwhmK2toWlIOET9TNuoJvgfEctVoJ8u7uJ2UWOSMndUVnfBOGiPDENddBjpqRkA800P9Yb0Ff7');
     $session = $stripe->checkout->sessions->create([
        'success_url' => 'http://thespark2.lembo.tech/success.html',
        'cancel_url' => 'http://thespark2.lembo.tech/cancel.html',
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