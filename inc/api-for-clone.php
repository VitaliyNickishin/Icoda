<?php

function accept_request_from_clone_sites_callback(WP_REST_Request $request)
{
    $origin = get_http_origin();
    $allowed_origins = array( 'https://icoda.io', 'https://promo2.icoda.io', 'https://promo.icoda.io', 'http://icoda.agency', 'https://icoda.agency' );
    if ($origin && in_array($origin, $allowed_origins)) {
        header('Access-Control-Allow-Origin: ' . esc_url_raw($origin));
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Credentials: true');
    }

    include_once dirname(__DIR__, 2) . '/plugins/ApTch/inc/ApTchBOT.class.php';

    $TGbot = new ApTchBOT;

    $name = $_POST["name"];
    $telegram = $_POST["telegram"];
    $email = $_POST["email"];

    $response = array(
        'success' => true,
        'message' => 'Accepted'
    );

    if ( strlen($_POST["email"]) == 0 || ! is_email( $email ) ) {
        return array(
            'success' => false,
            'message' => 'You aren\'t able submit form!'
        );
    }
    
    $dop = '-';

    require_once get_stylesheet_directory() . '/PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer();
    $mail->CharSet = 'utf-8';

    $email_body = "";
    $email_body = $email_body . "<h2>Name:</h2><p>" . $name . "</p><h2>WhatsApp / Telegram:</h2><p>" . $telegram . "</p><h2>Email:</h2><p>" . $email . "</p>";

    $utm_keys = array('utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term');
    foreach ($utm_keys as $row) {
        $utm_name = 'utm-' . $row;
        if (!empty($_POST[$utm_name])) {
            $email_body .= '<p>' . $row . ': ' . $_POST[$utm_name] . '</p>';
        }
    }

    $mail->From = 'post@icoda.io'; // post@ico-promotion.com   post@icoda.io
    $mail->FromName = 'ICODA';
    $mail->AddAddress('post@icoda.io', 'ANALYTICS');  // post@ico-promotion.com
    $mail->Subject = 'ICODA';


    $mail->MsgHTML($email_body);

    include_once get_stylesheet_directory() . "/amocrm_api/handler.php";

    $stylesheet_directory_uri = get_stylesheet_directory_uri();
    $mail_to_user = new PHPMailer(true);
    $mail_to_user->DKIM_private = '/root/dkim/icoda.io.private';
    $mail_to_user->DKIM_selector = 'mail';
    $mail_to_user->CharSet = 'utf-8';
    $mail_to_user->isHTML(true);
    $email_body_to_user = file_get_contents(get_stylesheet_directory() . '/template-parts/emails/confirmation.php');
    $email_body_to_user = str_replace('*|YEAR|*', date('Y'), $email_body_to_user);
    $email_body_to_user = str_replace('*|SITEURL|*', site_url(), $email_body_to_user);
    $email_body_to_user = str_replace('*|LOGO_ICON|*', $stylesheet_directory_uri . '/template-parts/emails/icons/logo.png', $email_body_to_user);
    $email_body_to_user = str_replace('*|MAIL_SVG|*', $stylesheet_directory_uri . '/template-parts/emails/icons/mail.png', $email_body_to_user);
    $email_body_to_user = str_replace('*|LINKEDIN_URL|*', 'https://www.linkedin.com/company/icoda-ico-marketing-solutions/', $email_body_to_user);
    $email_body_to_user = str_replace('*|LINKEDIN_ICON|*', $stylesheet_directory_uri . '/template-parts/emails/icons/linkedin.png', $email_body_to_user);
    $email_body_to_user = str_replace('*|FACEBOOK_URL|*', 'https://www.facebook.com/icodaagency/', $email_body_to_user);
    $email_body_to_user = str_replace('*|FACEBOOK_ICON|*', $stylesheet_directory_uri . '/template-parts/emails/icons/facebook.png', $email_body_to_user);
    $email_body_to_user = str_replace('*|MAIL_URL|*', 'mailto:post@icoda.io', $email_body_to_user);
    $email_body_to_user = str_replace('*|MAIL_ICON|*', $stylesheet_directory_uri . '/template-parts/emails/icons/email.png', $email_body_to_user);
    $email_body_to_user = str_replace('*|TELEGRAM_URL|*', 'https://t.me/icoda', $email_body_to_user);
    $email_body_to_user = str_replace('*|TELEGRAM_ICON|*', $stylesheet_directory_uri . '/template-parts/emails/icons/telegram.png', $email_body_to_user);
    $mail_to_user->setFrom('post@icoda.io');
    $mail_to_user->FromName = 'ICODA';
    $email_user = $email;
    $mail_to_user->addAddress($email_user);
    $mail_to_user->Subject = 'ICODA';
    $mail_to_user->Body    = $email_body_to_user;
    $mail_to_user->send();


    if (!$mail->send()) {
        return array(
            'success' => false,
            'message' => "Message could not be sent.\nMailer Error: " . $mail->ErrorInfo
        );
    } else {
        $request_source = ! empty( $_SERVER['HTTP_ORIGIN'] ) ? $_SERVER['HTTP_ORIGIN'] : $_SERVER['HTTP_REFERER'];
        $request_source_parsed = parse_url( $request_source  );
        $request_source = ! empty( $request_source_parsed['host'] ) ? $request_source_parsed['host'] : $request_source;
        $tg_body = "New request from " . $request_source . " 💪 \n";
        $tg_body .= "Name: " . $name . " \n";
        $tg_body .= "WhatsApp / Telegram: " . $telegram . " \n";
        $tg_body .= "Email: " . $email . " \n";

        foreach ($utm_keys as $row) {
            $utm_name = 'utm-' . $row;
            if (!empty($_POST[$utm_name])) {
                $tg_body .= $row . ": " . $_POST[$utm_name] . " \n";
            }
        }

        if ($_POST['lang-source'] == 'es') {
            add_filter("option_botTokenDB", function ($value) {
                return '1513274321:AAGVC8SAAlJHRXlP9dNiW6xRriPre6f9WGE';
            });
            add_filter("option_channelIDDB", function ($value) {
                return '-1001279589570';
            });
        }
        if ($_POST['lang-source'] == 'zh-hans') {
            add_filter("option_botTokenDB", function ($value) {
                return '1767557474:AAGKLclvOd0GTox60pOuDUkqImnQeyCQou8';
            });
            add_filter("option_channelIDDB", function ($value) {
                return '-1001276561586';
            });
        }

        $TGbot->sendPost($tg_body);
        // save into text csv file
        $fp2 = fopen("leads.csv", "a");
        $datenow = date('Y-m-d');
        $timenow = date('H:i:s');
        $inputspace2 = $datenow . ";" . $timenow . ";" . $name . ";" . $telegram . ";" . $email . ";" . $dop . "\n";
        fwrite($fp2, $inputspace2);
        fclose($fp2);

       
        $response = array(
            'success' => true,
            'message' => "Sended"
        );
    }
    return $response;
}



add_action('rest_api_init', function () {
    register_rest_route('icoda/v1', '/contact_us', [
        'methods'  => 'POST',
        'callback' => 'accept_request_from_clone_sites_callback',
    ]);
});
