<?php

function icoda_bitrix_lead_created_callback(WP_REST_Request $request)
{
    $sales = [
        99 => '5716040119',  // Victor Zhabin  vic_icoda
        89 => '5903399891',  // Oksana  OksanaYko_ICODA
        43 => '5629770628',  // Nikita  SharonICODA
        39 => '5825917032',  // Ruslan  ruslan_icoda
        37 => '579134',  // Eugenij Stepanov  genowayy
        61 => '6015300119',  // Ayana  Ayanamix
        25 => '179399251',  // Vlad
        65 => '748176905',  // Luis
    ];

    $params = $request->get_params();

    file_put_contents(__DIR__ . '/test-create-lead-data.txt', print_r($params, true) . "\n\n", FILE_APPEND);
    $lead_id = $params['data']['FIELDS']['ID'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://icoda.bitrix24.com/rest/59/1dpqw8l56mynp00o/crm.lead.get.json?ID=' . $lead_id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $responseBody = curl_exec($ch);
    curl_close($ch);
    $responseBody = json_decode($responseBody, TRUE);

    file_put_contents(__DIR__ . '/test-create-lead-data.txt', print_r($responseBody, true) . "\n\n", FILE_APPEND);

    $COMMENTS = $responseBody['result']['COMMENTS'];
    $ASSIGNED_BY_ID = $responseBody['result']['ASSIGNED_BY_ID'];
    if (isset($sales[$ASSIGNED_BY_ID])) {
        $tg_data = array(
            'chat_id' => $sales[$ASSIGNED_BY_ID],
            'text' => "You have new LEAD https://icoda.bitrix24.com/crm/lead/details/{$lead_id}/\n\n"
                . "Comment: " . ( $COMMENTS ? $COMMENTS : '-' ),
            'parse_mode' => 'html'
        );

        $url = 'https://api.telegram.org/bot1513274321:AAGVC8SAAlJHRXlP9dNiW6xRriPre6f9WGE/sendMessage';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($tg_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $res = curl_exec($ch);
        curl_close($ch);

        file_put_contents(__DIR__ . '/test-create-lead-data.txt', print_r($tg_data, true) . "\n\n", FILE_APPEND);
        file_put_contents(__DIR__ . '/test-create-lead-data.txt', print_r($res, true) . "\n\n", FILE_APPEND);
    }

    return '{"accepted":1}';
}

add_action('rest_api_init', function () {
    register_rest_route('bitrix/v1', '/lead_created', [
        'methods'  => 'POST',
        'callback' => 'icoda_bitrix_lead_created_callback',
        'permission_callback' => '__return_true',
    ]);
});

add_action('rest_api_init', function () {
    register_rest_route('icoda/v1', '/get_ip_info', [
        'methods'  => 'POST',
        'callback' => 'icoda_get_ip_info_callback',
        'permission_callback' => '__return_true',
    ]);
});

function icoda_get_ip_info_callback(WP_REST_Request $request) {
    $ip = $request->get_param('ip');

    if (empty($ip)) {
        return [
            'country' => null,
            'country_code' => null,
        ];
    }

    $country = null;
    $countryCode = null;

    if( ! empty( $ip ) ) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://ip-api.com/php/' . $ip );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $geoData = curl_exec($ch);
        curl_close($ch);
        $geoData = unserialize($geoData);

        if (!empty($geoData) && !empty($geoData['status']) && $geoData['status'] === 'success' && !empty($geoData['country'])&& !empty($geoData['countryCode']) ) {
            $country = $geoData['country'] ?? null;
            $countryCode = $geoData['countryCode'] ?? null;
        } else {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://reallyfreegeoip.org/json/' . $ip );
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            $geoData = curl_exec($ch);
            curl_close($ch);
            $geoData = json_decode($geoData, TRUE);
            if (!empty($geoData) && !empty($geoData['country_name']) && !empty($geoData['country_code'])) {
                $country = $geoData['country_name'] ?? null;
                $countryCode = $geoData['country_code'] ?? null;
            }
        }

        // return ['country'=>$output];
          return [
                'country'      => $country,
                'country_code' => $countryCode,
            ];
    }
}

function icoda_bitrix_test_tg_sale_callback()
{
    $ASSIGNED_BY_ID = 43;

    $sales = [
        99 => '5716040119',  // Victor Zhabin  vic_icoda
        89 => '5903399891',  // Oksana  OksanaYko_ICODA
        43 => '5629770628',  // Nikita  SharonICODA
        39 => '5825917032',  // Ruslan  ruslan_icoda
        37 => '579134',  // Eugenij Stepanov  genowayy
        61 => '6015300119',  // Ayana  Ayanamix
        25 => '179399251',  // Vlad
        65 => '748176905',  // Luis
    ];

    $tg_data = array(
        'chat_id' => $sales[$ASSIGNED_BY_ID],
        'text' => 'You have new LEAD',
        'parse_mode' => 'html'
    );

    $url = 'https://api.telegram.org/bot1513274321:AAGVC8SAAlJHRXlP9dNiW6xRriPre6f9WGE/sendMessage';
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($tg_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    $res = curl_exec($ch);
    curl_close($ch);

    file_put_contents(__DIR__ . '/test-create-tg-test-sale.txt', print_r($tg_data, true));
    file_put_contents(__DIR__ . '/test-create-tg-test-sale.txt', print_r($res, true) . "\n\n", FILE_APPEND);

    return '{"accepted":1}';
}

add_action('rest_api_init', function () {
    register_rest_route('bitrix/v1', '/test_tg_sale', [
        'methods'  => 'GET',
        'callback' => 'icoda_bitrix_test_tg_sale_callback',
        'permission_callback' => '__return_true',
    ]);
});
