<?php
include '../../../wp-load.php';
include_once dirname(__DIR__, 2) . '/plugins/ApTch/inc/ApTchBOT.class.php';

$origin = get_http_origin();
$allowed_origins = array('https://gh-marketing-services.com');
if ($origin && in_array($origin, $allowed_origins)) {
   header('Access-Control-Allow-Origin: ' . esc_url_raw($origin));
   header('Access-Control-Allow-Methods: POST');
   header('Access-Control-Allow-Credentials: true');
}

function icodaGetIPAddress()
{
   $ip = '';
   if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
   } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
   } else {
      $ip = $_SERVER['REMOTE_ADDR'];
   }
   return $ip;
}

// Проверка Akismet
function check_akismet_spam($name, $email, $message) {
    if (!function_exists('akismet_http_post')) {
        return false;
    }
    
    $data = [
        'blog' => home_url(),
        'user_ip' => $_SERVER['REMOTE_ADDR'],
        'user_agent' => $_SERVER['HTTP_USER_AGENT'],
        'comment_type' => 'contact-form',
        'comment_author' => $name,
        'comment_author_email' => $email,
        'comment_content' => $message
    ];
    
    $query = http_build_query($data);
    $response = akismet_http_post($query, 'rest.akismet.com', '/1.1/comment-check', 80);
    
    return $response[1] === 'true';
}

function isSpamName($name) {
   $name = trim($name);

   if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
      return false;
   }

   $patternName = '/[bcdfghjklmnpqrstvwxz]{6,}/i';
   if(preg_match($patternName, $name) === 1) {
      return true;
   }

   // leave only letters
   $letters = preg_replace('/[^a-zA-Z]/', '', $name);

   // allow name in lowercase or uppercase
   if (ctype_upper($letters) || ctype_lower($letters)) {
      return false;
   }

   // count letters in upper and lower case
   $upper = preg_match_all('/[A-Z]/', $letters);
   $lower = preg_match_all('/[a-z]/', $letters);

   // ratio of large and small (if approximately equal - suspicious)
   $ratio = $upper / max($lower, 1);
   if ($ratio > 0.5 && $ratio < 2 && strlen($letters) > 6) {
      return true;
   }

   // counting the number of register switches
   $switches = 0;
   for ($i = 1; $i < strlen($letters); $i++) {
      if (
         (ctype_upper($letters[$i]) && ctype_lower($letters[$i - 1])) ||
         (ctype_lower($letters[$i]) && ctype_upper($letters[$i - 1]))
      ) {
         $switches++;
      }
   }

   $switchRatio = $switches / max(strlen($letters) - 1, 1);
   if ($switchRatio > 0.6) {
      return true;
   }

   return false;
}

$TGbot = new ApTchBOT;

$name = $_POST["name"];
$telegram = $_POST["telegram"];
$email = trim($_POST["email"]);
$ipAddress = icodaGetIPAddress();

$blockIpAddresses = get_option('icoda_spam_request_block_ips');
$blockIpAddresses = !empty($blockIpAddresses) ? $blockIpAddresses : '';
$blockIpAddresses = explode("\n", $blockIpAddresses);
$blockIpAddresses = array_map('trim', $blockIpAddresses);

$blockEmails = get_option('icoda_spam_request_block_emails');
$blockEmails = !empty($blockEmails) ? $blockEmails : '';
$blockEmails = explode("\n", $blockEmails);
$blockEmails = array_map('trim', $blockEmails);

foreach ($blockIpAddresses as $blockIpAddress) {
   if (strpos($ipAddress, $blockIpAddress) !== false) {
      echo 'You aren\'t able submit form!';
      exit;
   }
}


if (!empty($_POST['email_mob'])) {
   $email = trim($_POST['email_mob']);
}

if (strlen($_POST["email"]) == 0 && strlen($_POST["email_mob"]) == 0) {
   echo 'You aren\'t able submit form!';
   exit;
}

if (!is_email($email)) {
   echo 'You aren\'t able submit form!';
   exit;
}

if (
   stripos($name, 'delay ') !== false
   || stripos($name, 'sysdate') !== false
   || stripos($name, 'dbms') !== false
   || stripos($name, '\ ') !== false
   || stripos($name, 'sleep') !== false
   || stripos($name, 'xor') !== false
   || stripos($name, 'now(') !== false
   || stripos($name, 'waitfor') !== false
   || stripos($name, '@@') !== false
   || stripos($name, 'from(') !== false
   || stripos($name, ' from') !== false
   || stripos($name, 'select') !== false
   || stripos($name, 'tzws') !== false
   || stripos($name, 'lookup') !== false
   || stripos($name, '../') !== false
   || stripos($name, 'print') !== false
   || stripos($name, ' or ') !== false
   || stripos($name, 'MOBX') !== false
   || stripos($name, 'UIOUIO') !== false
) {
   echo 'You aren\'t able submit form!';
   exit;
}

if(isSpamName($name)) {
   echo 'You aren\'t able submit form!';
   exit;
}

if (
   stripos($telegram, 'delay ') !== false
   || stripos($telegram, 'sysdate') !== false
   || stripos($telegram, 'dbms') !== false
   || stripos($telegram, '\ ') !== false
   || stripos($telegram, 'sleep') !== false
   || stripos($telegram, 'xor') !== false
   || stripos($telegram, 'now(') !== false
   || stripos($telegram, 'waitfor') !== false
   || stripos($telegram, '@@') !== false
   || stripos($telegram, 'from(') !== false
   || stripos($telegram, ' from') !== false
   || stripos($telegram, 'select') !== false
   || stripos($telegram, 'tzws') !== false
   || stripos($telegram, 'lookup') !== false
   || stripos($telegram, '../') !== false
   || stripos($telegram, 'print') !== false
   || stripos($telegram, ' or ') !== false
   || stripos($telegram, 'IOPIOP') !== false
) {
   echo 'You aren\'t able submit form!';
   exit;
}

if (
   stripos($email, 'sample@email') !== false
   || stripos($email, 'firef0x') !== false
   || stripos($email, 'example.com') !== false
   || in_array($email, $blockEmails)
) {
   echo 'You aren\'t able submit form!';
   exit;
}

if (isset($_POST["submit"]) && strlen($_POST["submit"]) > 0) {
   // echo 'You aren\'t able submit form!';
   _e('You aren\'t able submit form!', 'icoda');
   exit;
}
if (isset($_POST["dop"])) {
   $dop = $_POST["dop"];
} else {
   $dop = '-';
};


$email_body = "";
$email_body = $email_body . "<h2>Name:</h2><p>" . $name . "</p><h2>WhatsApp / Telegram:</h2><p>" . $telegram . "</p><h2>Email:</h2><p>" . $email . "</p>";

if (!empty($_POST['message']) || !empty($_POST['message_mob'])) {
   $message = !empty($_POST['message']) ? $_POST['message'] : $_POST['message_mob'];
   $email_body .= '<h2>Message:</h2><p>' . $message . '</p>';
}

$utm_keys = array('utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term');
foreach ($utm_keys as $row) {
   $utm_name = 'utm-' . $row;
   if (!empty($_POST[$utm_name])) {
      $email_body .= '<p>' . $row . ': ' . $_POST[$utm_name] . '</p>';
   }
}


$stylesheet_directory_uri = get_stylesheet_directory_uri();
$email_body_to_user = file_get_contents(get_stylesheet_directory() . '/template-parts/emails/confirmation.php');
$email_body_to_user = str_replace('*|YEAR|*', date('Y'), $email_body_to_user);
$email_body_to_user = str_replace('*|SITEURL|*', 'https://icoda.io/?utm_source=email&utm_medium=request&utm_campaign=website_form', $email_body_to_user);
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

// Проверка Akismet
if (check_akismet_spam($_POST['name'], $_POST['email'], $_POST['message'])) {
// Сообщение помечено как спам
_e('You aren\'t able submit form!', 'icoda');
      
}
else
{
if (function_exists('wp_mail')) {
   $headers = array(
      'content-type: text/html',
   );
   $res_mail_send = wp_mail('post@icoda.io', 'ICODA - Request', $email_body, $headers);

   $res_mail_to_user_send = wp_mail($email, 'Successful Request', $email_body_to_user, $headers);
} else {
   require_once 'PHPMailer/PHPMailerAutoload.php';

   $mail = new PHPMailer();
   $mail->CharSet = 'utf-8';

   $mail->From = 'post@icoda.io'; // post@ico-promotion.com   post@icoda.io
   $mail->FromName = 'ICODA';
   $mail->AddAddress('post@icoda.io', 'ANALYTICS');  // post@ico-promotion.com
   $mail->Subject = 'ICODA';

   $mail->MsgHTML($email_body);

   try {
      $mail->send();
      $res_mail_send = true;
   } catch (Exception $e) {
      $res_mail_send = $mail->ErrorInfo;
   }

   // include_once get_stylesheet_directory() . "/amocrm_api/handler.php";

   $mail_to_user = new PHPMailer(true);
   try {
      $mail_to_user->DKIM_private = '/root/dkim/icoda.io.private';
      $mail_to_user->DKIM_selector = 'mail';
      $mail_to_user->CharSet = 'utf-8';
      $mail_to_user->isHTML(true);
      $mail_to_user->setFrom('post@icoda.io');
      $mail_to_user->FromName = 'ICODA';
      $email_user = $email;
      $mail_to_user->addAddress($email_user);
      $mail_to_user->Subject = 'ICODA';
      $mail_to_user->Body    = $email_body_to_user;
      $mail_to_user->send();
      $res_mail_to_user_send = true;
   } catch (Exception $e) {
      $res_mail_to_user_send = $mail_to_user->ErrorInfo;
   }
}

file_put_contents(
   get_stylesheet_directory() . '/submit-logs.txt',
   print_r(date('Y-m-d H:i:s'), true) . "\n",
   FILE_APPEND
);

file_put_contents(
   get_stylesheet_directory() . '/submit-logs.txt',
   print_r(array('res_email' => $email, 'res_mail_to_user_send' => $res_mail_to_user_send, 'res_mail_send' => $res_mail_send), true) . "\n\n",
   FILE_APPEND
);

if (false && !$res_mail_send) {
   _e('Message could not be sent.', 'icoda');
   echo __('Mailer Error: ', 'icoda') . $mail->ErrorInfo;
   exit;
} else {
   echo '1';
   $tg_body = "New request from icoda.io 💪 \n";

   if(!empty($_POST['is-banner-review-block']) && $_POST['is-banner-review-block'] === 'yes') {
      $tg_body = "LISTING\nNew request from icoda.io 💪 \n";
   }
   
   $tg_body .= "Name: " . $name . " \n";
   $tg_body .= "WhatsApp / Telegram: " . $telegram . " \n";
   $tg_body .= "Email: " . $email . " \n";
   if (!empty($ipAddress)) {
      $tg_body .= "IP: " . $ipAddress . " \n";
   }


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


   if ($_POST['lang-source'] == 'de') {
      add_filter("option_botTokenDB", function ($value) {
         return '5271971463:AAFvacGB5TqmjKVfgFU51lbhuw8ePrT6S60';
      });
      add_filter("option_channelIDDB", function ($value) {
         return '-1001565276769';
      });
   }




   $tgRes = $TGbot->sendPost($tg_body);

   $fpT2 = fopen("leads-tg-res.csv", "a");
   fwrite($fpT2, print_r($tgRes, true));
   fclose($fpT2);

   // save into text csv file
   $fp2 = fopen("leads.csv", "a");
   $datenow = date('Y-m-d');
   $timenow = date('H:i:s');
   $inputspace2 = $datenow . ";" . $timenow . ";" . $name . ";" . $telegram . ";" . $email . ";" . $dop . "\n";
   fwrite($fp2, $inputspace2);
   fclose($fp2);


   send_lead_to_bitrix();
}
}
