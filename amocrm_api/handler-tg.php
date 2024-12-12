<?php

// error_reporting(E_ALL);
// ini_set('display_errors','on');

// 4000800 - Руслан
// 6429391 - Давид
// 6489145 - Евгений
// 6549421 - Дана
// 6357817 - Никита
// 6077686 - Влад
// 6115717 - Luis
// 7124977 - Vlad Krasilnikov
// 7636786 - Dan Berbec
// 8007289 - Prado Mariette

if (empty($lead_params) || empty($lead_params['name']) || empty($lead_params['telegram'])) {
    return false;
}

function saveToken($accessToken)
{
    if (
        isset($accessToken)
        && isset($accessToken['accessToken'])
        && isset($accessToken['refreshToken'])
        && isset($accessToken['expires'])
        && isset($accessToken['baseDomain'])
    ) {
        $data = [
            'accessToken' => $accessToken['accessToken'],
            'expires' => $accessToken['expires'],
            'refreshToken' => $accessToken['refreshToken'],
            'baseDomain' => $accessToken['baseDomain'],
        ];

        file_put_contents(TOKEN_FILE, json_encode($data));
    } else {
        file_put_contents(__DIR__ . '/responsed_data.txt', print_r('Invalid access token', true));
        return false;
    }
}


function getToken()
{
    $accessToken = json_decode(file_get_contents(TOKEN_FILE), true);

    if (
        isset($accessToken)
        && isset($accessToken['accessToken'])
        && isset($accessToken['refreshToken'])
        && isset($accessToken['expires'])
        && isset($accessToken['baseDomain'])
    ) {
        return new \League\OAuth2\Client\Token\AccessToken([
            'access_token' => $accessToken['accessToken'],
            'refresh_token' => $accessToken['refreshToken'],
            'expires' => $accessToken['expires'],
            'baseDomain' => $accessToken['baseDomain'],
        ]);
    } else {
        file_put_contents(__DIR__ . '/responsed_data.txt', print_r('Invalid access token', true));
        return false;
    }
}

if (empty($lead_params['manager_id'])) {
    $responsible_users = array('4000800', '6357817', '7124977', '7636786', '6489145');
    $last_responsible_user_id = get_option('last_responsible_tg_user_id');
    if (empty($last_responsible_user_id)) {
        $last_responsible_user_id = $responsible_users[0];
    } else {
        foreach ($responsible_users as $key => $responsible_user_id) {
            if ($last_responsible_user_id == $responsible_user_id) {
                if (isset($responsible_users[$key + 1])) {
                    $last_responsible_user_id = $responsible_users[$key + 1];
                } else {
                    $last_responsible_user_id = $responsible_users[0];
                }
                break;
            }
        }
    }
    if (empty($last_responsible_user_id)) {
        $last_responsible_user_id = $responsible_users[0];
    }
    update_option('last_responsible_tg_user_id', $last_responsible_user_id);
} else {
    $last_responsible_user_id = $lead_params['manager_id'];
}


file_put_contents(__DIR__ . '/process_log_tg.txt', print_r("START  " . date('Y-m-d H:i:s') . "\n", true));
define('TOKEN_FILE', __DIR__ . DIRECTORY_SEPARATOR . 'token_info.json');

use AmoCRM\OAuth2\Client\Provider\AmoCRM;

file_put_contents(__DIR__ . '/process_log_tg.txt', print_r("Step 1" . "\n", true), FILE_APPEND);
include_once __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/vendor/amocrm/oauth2-amocrm/src/AmoCRM.php';
file_put_contents(__DIR__ . '/process_log_tg.txt', print_r("Step 2" . "\n", true), FILE_APPEND);
session_start();


$provider = new AmoCRM([
    'clientId' => 'a9c596b1-4732-4b6b-ae66-6601e71627e9',
    'clientSecret' => 'OwmORGe6aaWnEOCOLDz7UidbtWYjETk7RhdFvzdrl9eyozpLb63pvKRryyBw0cfc',
    'redirectUri' => 'https://icoda.io/',
]);

file_put_contents(__DIR__ . '/process_log_tg.txt', print_r("Step 3" . "\n", true), FILE_APPEND);
$accessToken = getToken();

$provider->setBaseDomain($accessToken->getValues()['baseDomain']);
file_put_contents(__DIR__ . '/process_log_tg.txt', print_r("Step 4" . "\n", true), FILE_APPEND);


if ($accessToken->hasExpired()) {
    file_put_contents(__DIR__ . '/process_log_tg.txt', print_r("Step 5" . "\n", true), FILE_APPEND);


    try {
        file_put_contents(__DIR__ . '/process_log_tg.txt', print_r("Step 6" . "\n", true), FILE_APPEND);

        file_put_contents(__DIR__ . '/process_log_tg.txt', print_r("getRefreshToken  =  " . $accessToken->getRefreshToken() . "\n", true), FILE_APPEND);

        file_put_contents(__DIR__ . '/process_log_tg.txt', print_r("accessToken  =  " . $accessToken->getToken() . "\n", true), FILE_APPEND);
        file_put_contents(__DIR__ . '/process_log_tg.txt', print_r("expires  =  " . $accessToken->getExpires() . "\n", true), FILE_APPEND);
        file_put_contents(__DIR__ . '/process_log_tg.txt', print_r("baseDomain  =  " . $provider->getBaseDomain() . "\n", true), FILE_APPEND);

        $accessToken = $provider->getAccessToken(new League\OAuth2\Client\Grant\RefreshToken(), [
            'refresh_token' => $accessToken->getRefreshToken(),
        ]);

        file_put_contents(__DIR__ . '/process_log_tg.txt', print_r("access token = " . $accessToken . "\n", true), FILE_APPEND);

        saveToken([
            'accessToken' => $accessToken->getToken(),
            'refreshToken' => $accessToken->getRefreshToken(),
            'expires' => $accessToken->getExpires(),
            'baseDomain' => $provider->getBaseDomain(),
        ]);
    } catch (Exception $e) {
        file_put_contents(__DIR__ . '/process_log_tg.txt', print_r("Step 7" . "\n", true), FILE_APPEND);
        file_put_contents(__DIR__ . '/process_log_tg.txt', print_r("ERROR: " . $e->getMessage() . "\n", true), FILE_APPEND);
        return false;
    }
}

$token = $accessToken->getToken();

try {
    file_put_contents(__DIR__ . '/process_log_tg.txt', print_r("Step 8" . "\n", true), FILE_APPEND);

    $timeZone = 'Europe/Moscow';
    $moscowDateTime = new DateTime('now', new DateTimeZone($timeZone));
    $moscowDate = $moscowDateTime->format('d-m-Y H-i');

    $lead_custom_fields = array(
        array(
            "id" => "589985",
            "values" => array(
                array(
                    "value" => 'HOT',
                    "enum" => '1121117'
                )
            )
        )
    );

    $data = $provider->getHttpClient()
        ->request('POST', $provider->urlAccount() . 'api/v2/leads', [
            'headers' => $provider->getHeaders($accessToken),
            'body' => json_encode(array(
                "add" => array(
                    array(
                        "name" => 'Заявка с телеграма ' . $moscowDate,
                        "responsible_user_id" => $last_responsible_user_id,
                        "custom_fields" => $lead_custom_fields
                    )
                )
            ))
        ]);

    $parsedBody = json_decode($data->getBody()->getContents(), true);

    $lead_id = $parsedBody['_embedded']['items'][0]['id'];

    file_put_contents(__DIR__ . '/created_leads.txt', print_r($lead_id . "\n", true), FILE_APPEND);

    if (!empty($lead_params['message'])) {
        $message = $lead_params['message'];
        $dataNotes = $provider->getHttpClient()
            ->request('POST', $provider->urlAccount() . 'api/v2/notes', [
                'headers' => $provider->getHeaders($accessToken),
                'body' => json_encode(array(
                    "add" => array(
                        array(
                            "element_id" => $lead_id,
                            "element_type" => "2",
                            "text" => "Client message: " . $message,
                            "note_type" => "4"
                        )
                    )
                ))
            ]);
    }

    $clientAddsList = array(
        "add" => array(
            array(
                "name" => $lead_params['name'],
                "leads_id" => array(
                    $lead_id
                ),
                "custom_fields" => array(
                    array(
                        "id" => "308347",
                        "values" => array(
                            array(
                                "value" => $lead_params['telegram']
                            )
                        )
                    )
                )
            )
        )
    );

    $dataClients = $provider->getHttpClient()
        ->request('POST', $provider->urlAccount() . 'api/v2/contacts', [
            'headers' => $provider->getHeaders($accessToken),
            'body' => json_encode($clientAddsList)
        ]);

    file_put_contents(__DIR__ . '/process_log_tg.txt', print_r("Step 9" . "\n", true), FILE_APPEND);
} catch (GuzzleHttp\Exception\GuzzleException $e) {
    file_put_contents(__DIR__ . '/process_log_tg.txt', print_r("Step 10" . "\n", true), FILE_APPEND);
    return false;
}
file_put_contents(__DIR__ . '/process_log_tg.txt', print_r("END" . "\n", true), FILE_APPEND);

return $lead_id;
