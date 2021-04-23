<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/php/Config.php";

if(isset($_POST["g-recaptcha-response"])) {
    $config = Config::getConfig();

    $secretKey = $config->captchaSecretKey;
    $response = $_POST['g-recaptcha-response'];
    $remoteIp = $_SERVER['REMOTE_ADDR'];


    $reCaptchaValidationUrl = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response&remoteip=$remoteIp");
    $result = json_decode($reCaptchaValidationUrl, TRUE);

    if ($result['success'] == 1) {
        $name = $_POST["message-name"];
        $phone = $_POST["message-phone"];
        $email = $_POST["message-email"];
        $content = $_POST["message-content"];

        $msgOwner = "Jméno: ".$name."\n";
        $msgOwner .= "Telefon: ".$phone."\n";
        $msgOwner .= "Email: ".$email."\n";
        $msgOwner .= "Zpráva: ".$content;
        $subjectOwner = "revivallucie.cz - Nová zpráva";
        $emailOwner = $config->emailOwner;

        $msgClient = "Kopie odeslané zprávy:\n\n".$msgOwner;
        $subjectClient = "Revival Lucie Morava";

        try {
            require $_SERVER['DOCUMENT_ROOT'] . '/mailer/PHPMailerAutoload.php';
            require $_SERVER['DOCUMENT_ROOT'] . '/php/tools.php';

            if (!send_email([$emailOwner], $subjectOwner, $msgOwner) || !send_email([$email], $subjectClient, $msgClient)) {
                throw new Exception("Error sending email!");
            }

            header("Location: /?email_successful=true");
            die;
        } catch (Exception $ignored) { }
    }
}

header("Location: /?email_successful=false");
die;
