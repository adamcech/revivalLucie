<?php

ini_set('gd.jpeg_ignore_warning', 1);

function getShortcut($fileName)
{
    $shortcut = "";
    $hasShortcut = false;

    for ($i = 0; $i < strlen($fileName); $i++)
    {
        if ($fileName[$i] == ".") { $hasShortcut = true; break; }
    }

    if ($hasShortcut)
    {
        for ($i = strlen($fileName) - 1; $i > 0 && $fileName[$i] != "."; $i--)
        {
            $shortcut = $fileName[$i].$shortcut;
        }
    }

    return $shortcut;
}

function makeThumb($src, $dest, $desiredWidth)
{
    if (exif_imagetype($src) == IMAGETYPE_PNG)
    {
        make_png_thumb($src, $dest, $desiredWidth);
    }
    else if (exif_imagetype($src) == IMAGETYPE_JPEG)
    {
        make_jpg_thumb($src, $dest, $desiredWidth);
    }
}

function make_png_thumb($src, $dest, $desiredWidth)
{
    $sourceImage = imagecreatefrompng($src);

    $width = imagesx($sourceImage);
    $height = imagesy($sourceImage);

    $desiredHeight = floor($height * ($desiredWidth / $width));

    $virtualImage = imagecreatetruecolor($desiredWidth, $desiredHeight);
    imagealphablending($virtualImage, false);
    imagesavealpha($virtualImage,true);

    $transparent = imagecolorallocatealpha($virtualImage, 255, 255, 255, 127);

    imagefilledrectangle($virtualImage, 0, 0, $width, $height, $transparent);
    imagecopyresampled($virtualImage, $sourceImage, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $width, $height);

    imagepng($virtualImage, $dest);

    imagedestroy($sourceImage);
    imagedestroy($virtualImage);
}

function make_jpg_thumb($src, $dest, $desiredWidth)
{
    $sourceImage = imagecreatefromjpeg($src);

    $width = imagesx($sourceImage);
    $height = imagesy($sourceImage);

    $desiredHeight = floor($height * ($desiredWidth / $width));

    $virtualImage = imagecreatetruecolor($desiredWidth, $desiredHeight);

    imagecopyresampled($virtualImage, $sourceImage, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $width, $height);


    imagejpeg($virtualImage, $dest);

    imagedestroy($sourceImage);
    imagedestroy($virtualImage);
}


/**
 * @param string[] $dest_emails Reciever address
 * @param string $subject Subject
 * @param string $body Body of email (Message to sent)
 * @param int $port 465, 587
 * @param string $smtp_secure "ssl", "tls"
 * @return bool Wheter email was successfully sent
 */
function send_email($dest_emails, $subject, $body, $port = 587, $smtp_secure = "tls")
{
    date_default_timezone_set('Etc/UTC');

    if ( $dest_emails == null ) { return false; }
    if ( count($dest_emails) == 0 ) { return false; }

    try {
        $config = Config::getConfig();

        $mail = new PHPMailer;
        $mail->isSMTP();

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;

        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        $mail->Host = $config->smtpHost;

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = $port;

        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = $smtp_secure;

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = $config->smtpUsername;

        //Password to use for SMTP authentication
        $mail->Password = $config->smtpPassword;

        $mail->CharSet = 'UTF-8';

        //Set who the message is to be sent from
        $mail->setFrom($config->smtpUsername, 'Alexandr Škoda');

        //Set an alternative reply-to address
        $mail->addReplyTo($config->smtpUsername, 'Alexandr Škoda');

        foreach ($dest_emails as $email)
        {
            $mail->addAddress($email);
            $mail->AddCC($email);
        }

        $mail->Subject = "=?utf-8?B?".base64_encode($subject)."?=";
        $mail->Body = $body;

        if (!$mail->send()) {
            throw new phpmailerException($mail->ErrorInfo);
        }
    } catch (phpmailerException $e) {
        return false;
    }
    return true;
}
