
<?php
    /* Uses "SendGrid" third party e-mail API to send e-mail. This is a placeholder
   since I don't know what the ps11 SMTP workings are */
    require("C:\sendgrid-php\sendgrid-php\sendgrid-php.php"); //ALTER FOR LIVE
    //$sendgridAPI = '';
    
    $toUser = $_POST['toUser'];
    $toEmail = $_POST['toEmail'];
    $fromUser = $_POST['fromUser'];
    $fromEmail = $_POST['fromEmail'];
    $item = $_POST['item'];
    
    $subject = "GearShare: An item has been requested!";
                $headers = "From: $fromEmail";
                $message = "Greetings $toUser! User $fromUser on GearShare has requested your $item for use!\n"
                        . "Feel free to contact them at $fromEmail.\n\n"
                        . "-The GearShare Team";
                
//API from SendGrid for mail service

$email = new \SendGrid\Mail\Mail(); 
$email->setFrom($fromEmail, $fromUser);
$email->setSubject($subject);
$email->addTo($toEmail, $toUser);
$email->addContent("text/plain", $message);
$sendgrid = new \SendGrid($sendgridAPI);
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
?>

