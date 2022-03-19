<?php
    $to = 'mahmoud.m.abdelmalek@gmail.com';
    $name = $_POST["fname"];
    $type = $_POST["type"];
    $payment = $_POST["payment"];
    $email = $_POST["email"];
    $amount = $_POST["amount"];


    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= "From: " . $name . "\r\n"; // Sender's E-mail
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $message ='<table style="width:100%">
Charity Donation
        <tr>
            <td>'.$name.'  '.$email.'</td>
        </tr>
        <tr><td>Payment Method: '.$payment.'</td></tr>
        <tr><td>Project: '.$type.'</td></tr>
        <tr><td>Amount: '.$amount.'</td></tr>     
    </table>';

    if (@mail($to, $email, $message, $headers))
    {
        echo 'The message has been sent.';
        if($_POST["type"] == "paypal"){
        echo '<meta http-equiv="refresh" content="0;url=https://www.paypal.com/cgi-bin/webscr?business=mahmoud.m.abdelmalek@gmail.com&cmd=_xclick&currency_code=USD&amount='.$_POST["amount"].'&item_name=Donate">';
        }
    }else{
        echo 'failed';
    }

?>
