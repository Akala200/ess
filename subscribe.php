<?php
    require_once "Mail.php";
    $valid_referers = array(
        'http://example.com/', 
        'http://www.example.com/'
    );
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && in_array($_SERVER['HTTP_REFERER'], $valid_referers)){
        $subscriber_email = $_POST['email'];
        if ($subscriber_email <> '') {
            $headers = array (
                'To' => 'List Subscribe <info@example.com>',
                'From' => 'List Subscribe <webmaster@example.com>',
                'X-Mailer' => 'PHP/'.phpversion(),
                'Subject' => 'Mailing list add: '.$subscriber_email
             );
             $message = $headers['Subject'];
             $smtp = Mail::factory('smtp', array (
                 'host' => 'mail.example.com',
                 'auth' => TRUE,
                 'username' => 'example@example.com',
                 'password' => 'example'
             ));
             $mail_status = $smtp->send(
                 $headers['To'],
                 $headers,
                 $message
             );
             if (!PEAR::isError($mail_status)) {
                 include_once('thank_you.html'); // This is only displayed when the submit fails with AJAX
             } else {
                 header("HTTP/1.1 500 Internal Server Error");
                 echo $mail_status->getMessage();
             }
         } else {
             header("HTTP/1.1 400 Bad Request");
             echo 'Bad Request';
         }
     } else {
         header("HTTP/1.1 400 Bad Request");
         echo 'Bad Referrer';
     }
?>