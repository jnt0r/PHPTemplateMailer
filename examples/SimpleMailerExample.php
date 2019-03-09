<?php
/*
 * setup and include PHPTemplateMailer
 *
 * example with composer ...
 */

use jnt0r\mailer\Address;
use jnt0r\mailer\Mail;
use jnt0r\mailer\Mailer;

$config_file = __DIR__ . 'config.json';
$mailer = new Mailer($config_file);

$sender = new Address('myemail@example.com', 'My Email');
$recipient = new Address('recipient@example.com', 'Recipient');

$mail = new Mail('My Subject', $sender, $recipient, 'example.tpl', 'example_alt.tpl');

$myParams = [
    'name' => 'Any Name'
];

$mailer->send($mail, $myParams);