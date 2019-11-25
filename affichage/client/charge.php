<?php

require $_SERVER['DOCUMENT_ROOT'].'/Project-Ekah/utils/stripe-php-7.13.0/vendor/autoload.php';
// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey('sk_test_NZqmLN0M3rIysRWEpo5xza8J00PZodFzrb');

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
$token = $_POST['stripeToken'];
$prix = $_POST['total'];
$charge = \Stripe\Charge::create([
    'amount' => $prix,
    'currency' => 'cad',
    'description' => 'Example charge',
    'source' => $token,
]);


print_r($charge);
 ?>
