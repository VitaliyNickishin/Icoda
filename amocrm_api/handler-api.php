<?php

// error_reporting(E_ALL);
// ini_set('display_errors','on');

define('TOKEN_FILE', __DIR__ . DIRECTORY_SEPARATOR . 'token_info.json');

use AmoCRM\OAuth2\Client\Provider\AmoCRM;

include_once __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/vendor/amocrm/oauth2-amocrm/src/AmoCRM.php';
session_start();

/**
 * Создаем провайдера
 */
$provider = new AmoCRM([
    'clientId' => 'a9c596b1-4732-4b6b-ae66-6601e71627e9',
    'clientSecret' => 'OwmORGe6aaWnEOCOLDz7UidbtWYjETk7RhdFvzdrl9eyozpLb63pvKRryyBw0cfc',
    'redirectUri' => 'https://icoda.io/',
]);

$accessToken = icodaAmoGetToken();

$provider->setBaseDomain($accessToken->getValues()['baseDomain']);

/**
 * Проверяем активен ли токен и делаем запрос или обновляем токен
 */
if ($accessToken->hasExpired()) {
    /**
     * Получаем токен по рефрешу
     */
    try {
        $accessToken = $provider->getAccessToken(new League\OAuth2\Client\Grant\RefreshToken(), [
            'refresh_token' => $accessToken->getRefreshToken(),
        ]);
        icodaAmoSaveToken([
            'accessToken' => $accessToken->getToken(),
            'refreshToken' => $accessToken->getRefreshToken(),
            'expires' => $accessToken->getExpires(),
            'baseDomain' => $provider->getBaseDomain(),
        ]);
    } catch (Exception $e) {
        file_put_contents(__DIR__ . '/process_log.txt', print_r("Step 7" . "\n", true), FILE_APPEND);
        file_put_contents(__DIR__ . '/process_log.txt', print_r("ERROR: " . $e->getMessage() . "\n", true), FILE_APPEND);
        return;
    }
}

$token = $accessToken->getToken();

try {
    /**
     * Делаем запрос к АПИ  
     */

    $data = $provider->getHttpClient()
        ->request('GET', $provider->urlAccount() . 'api/v2/leads?responsible_user_id=6077686&limit_rows=10&status=19976545', [
            'headers' => $provider->getHeaders($accessToken)
        ]);

    $parsedBody = json_decode($data->getBody()->getContents(), true);

    $leads = $parsedBody['_embedded']['items'];

    if (!empty($leads)) {
        file_put_contents( __DIR__ . '/updated_leads.txt', "\n\n\n", FILE_APPEND );
        file_put_contents( __DIR__ . '/updated_leads.txt', print_r('------------------------------' . "\n", true), FILE_APPEND );
        file_put_contents( __DIR__ . '/updated_leads.txt', print_r(date( 'Y-m-d H:i:s' ) . "\n", true), FILE_APPEND );
        foreach ($leads as $key => $lead_data) {
            file_put_contents( __DIR__ . '/updated_leads.txt', print_r('Start Lead: '.$lead_data['id'] . "\n", true), FILE_APPEND );
            if ($key > 5) {
                break;
            }

            // 4000800 - Руслан
            // 6489145 - Евгений
            // 6357817 - Никита
            // 6077686 - Влад
            // 6115717 - Luis
            // 7124977 - Vlad Krasilnikov

            $responsible_user_id = 6077686;
            switch ($key) {
                case 0:
                case 3:
                    $responsible_user_id = 6357817;
                    break;
                case 1:
                case 4:
                    $responsible_user_id = 6489145;
                    break;
                case 2:
                case 5:
                    $responsible_user_id = 4000800;
                    break;
                case 6:
                case 7:
                    $responsible_user_id = 6115717;
                    break;
            }

            $lead_custom_fields = array(
                array(
                    "id" => "589985",
                    "values" => array(
                        array(
                            "value" => "COLD",
                            "enum" => "1121117"
                        )
                    )
                )
            );

            $update_data = array(
                array(
                    "id" => (string) $lead_data['id'],
                    "updated_at" => $lead_data['updated_at'],
                    "name" => $lead_data['name'],
                    "responsible_user_id" => (string) $responsible_user_id,
                    "status_id" => "36514204",
                    "custom_fields" => $lead_custom_fields
                )
            );

            file_put_contents( __DIR__ . '/updated_leads.txt', print_r('Do request by Lead: '.$lead_data['id'] . "\n", true), FILE_APPEND );

            $data_update = $provider->getHttpClient()
                ->request('POST', $provider->urlAccount() . 'api/v2/leads', [
                    'headers' => $provider->getHeaders($accessToken),
                    'body' => json_encode(array(
                        "update" => $update_data
                    ))
                ]);

            $parsedBodyUpdate = json_decode($data_update->getBody()->getContents(), true);

            file_put_contents( __DIR__ . '/updated_leads.txt', print_r('Ready: '.$lead_data['id'] . "\n", true), FILE_APPEND );
        }
        file_put_contents( __DIR__ . '/updated_leads.txt', print_r('------------------------------', true), FILE_APPEND );
    }

    return;
} catch (GuzzleHttp\Exception\GuzzleException $e) {
    return [];
}


function icodaAmoSaveToken($accessToken)
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
        return false;
    }
}

/**
 * @return \League\OAuth2\Client\Token\AccessToken
 */
function icodaAmoGetToken()
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
        return false;
    }
}
