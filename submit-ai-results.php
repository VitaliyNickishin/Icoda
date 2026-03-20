<?php
include '../../../wp-load.php';
include_once dirname(__DIR__, 2) . '/plugins/ApTch/inc/ApTchBOT.class.php';

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

$TGbot = new ApTchBOT;

$email = trim($_POST["email"]);

$ipAddress = icodaGetIPAddress();

$blockIpAddresses = get_option('icoda_spam_request_block_ips');
$blockIpAddresses = !empty($blockIpAddresses) ? $blockIpAddresses : '';
$blockIpAddresses = explode("\n", $blockIpAddresses);
$blockIpAddresses = array_map('trim', $blockIpAddresses);

foreach ($blockIpAddresses as $blockIpAddress) {
    if (strpos($ipAddress, $blockIpAddress) !== false) {
        echo 'You aren\'t able submit form!';
        exit;
    }
}

if (strlen($_POST["email"]) == 0) {
    echo 'You aren\'t able submit form!';
    exit;
}

if (!is_email($email)) {
    echo 'You aren\'t able submit form!';
    exit;
}

if (
    stripos($email, 'sample@email') !== false
    || stripos($email, 'firef0x') !== false
    || stripos($email, 'example.com') !== false

) {
    echo 'You aren\'t able submit form!';
    exit;
}

$email_body = "";
$email_body = $email_body . "<h2>Email:</h2><p>" . $email . "</p>";

if (function_exists('wp_mail')) {
    $headers = array(
        'content-type: text/html',
    );
    $res_mail_send = wp_mail('post@icoda.io', 'ICODA - AI Results Request', $email_body, $headers);
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
}

file_put_contents(
    get_stylesheet_directory() . '/submit-ai-results-logs.txt',
    print_r(date('Y-m-d H:i:s'), true) . "\n",
    FILE_APPEND
);

file_put_contents(
    get_stylesheet_directory() . '/submit-ai-results-logs.txt',
    print_r(array('res_email' => $email, 'res_mail_send' => $res_mail_send), true) . "\n\n",
    FILE_APPEND
);

echo '1';
$tg_body = "New AI Email Report request from icoda.io 💪 \n";
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


$TGbot->sendPost($tg_body);
// save into text csv file
$fp2 = fopen("ai-leads.csv", "a");
$datenow = date('Y-m-d');
$timenow = date('H:i:s');
$inputspace2 = $datenow . ";" . $timenow . ";" . $email . "\n";
fwrite($fp2, $inputspace2);
fclose($fp2);


send_ai_results_lead_to_bitrix(['email' => $email, 'data' => $_POST]);
