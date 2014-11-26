<?php


use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

session_start();

$_SESSION['user_id'] = 1;

require  __DIR__ . '/../vendor/autoload.php';


//API

$api = new ApiContext(
	new OAuthTokenCredential(
		'clientID',
		'secret'
	)
);


$api->setConfig([
	'mode' => 'sandbox',
	'http.ConnectionTimeOut' => 30,
	'log.LogEnabled' => false,
	'log.FileName' => '',
	'log.LogLevel' => 'FINE',
	'validation.level' => 'log'

]);


$db = new PDO('mysql:host=localhost; dbname=paypaltest', 'root', '');


$user = $db->prepare("
	SELECT * FROM users
	WHERE id = :user_id
	");

$user->execute(['user_id' => $_SESSION['user_id']]);


$user = $user->fetchObject();



