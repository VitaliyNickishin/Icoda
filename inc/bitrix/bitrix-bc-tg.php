<?php

// error_reporting(E_ALL);
// ini_set('display_errors','on');

// 4000800 - Руслан
// 6357817 - Никита
// 7636786 - Dan Berbec
// Sergey Nelyubin 47
// Ilya Hade 83
// Ayana Albers 61
// Oksana Yemelyanenko 89
// Victor Zhabin 99
// Michael Fogel  177
// Oleg Tsukerman 179

$managers = [
    '4000800' => '39',
    '6489145' => '37',
    '6357817' => '43',
    '6077686' => '25',
    '7124977' => '41',
    '7636786' => '27',
    '6115717' => '65',
    '10000001' => '83',
    '10000002' => '61',
    '10000004' => '99',
    '10000005' => '135',
    '10000006' => '123',
    '10000007' => '177',
    '10000008' => '179',
];

if (empty($lead_params) || empty($lead_params['name']) || empty($lead_params['telegram']) || empty($lead_params['email'])) {
    return false;
}


if (empty($lead_params['manager_id'])) {
    $responsible_users = array( '39', '99', '177', '179', '135' );
    $last_responsible_user_id = get_option('last_responsible_bc_tg_bitrix_user_id');
    $add_periodical_users = get_option('bitrix_add_periodical_users');
    $add_periodical_users = !empty($add_periodical_users) ? true : false;
    if ($add_periodical_users) {
        // $responsible_users[] = '89';
    }
    if (empty($last_responsible_user_id) || !in_array($last_responsible_user_id, $responsible_users)) {
        $last_responsible_user_id = $responsible_users[0];
    } else {
        foreach ($responsible_users as $key => $responsible_user_id) {
            if ($last_responsible_user_id == $responsible_user_id) {
                if (isset($responsible_users[$key + 1])) {
                    $last_responsible_user_id = $responsible_users[$key + 1];
                } else {
                    update_option('bitrix_add_periodical_users', !$add_periodical_users);
                    $last_responsible_user_id = $responsible_users[0];
                }
                break;
            }
        }
    }
    if (empty($last_responsible_user_id)) {
        $last_responsible_user_id = $responsible_users[0];
    }
    update_option('last_responsible_bc_tg_bitrix_user_id', $last_responsible_user_id);
} else {
    $last_responsible_user_id = (string)$lead_params['manager_id'];
    $last_responsible_user_id = trim($last_responsible_user_id);
    $last_responsible_user_id = $managers[$last_responsible_user_id];
}


try {

    // $bitrix_url = 'https://icoda.bitrix24.com/rest/63/ymsbww2es4yzx2pu/crm.lead.add.json?';
    $bitrix_url = 'https://icoda.bitrix24.com/rest/59/yd1pw1c6t2m5ffnc/crm.lead.add.json?';

    $bitrix_fields = [
        'FIELDS' => []
    ];

    $timeZone = 'Europe/Moscow';
    $moscowDateTime = new DateTime('now', new DateTimeZone($timeZone));
    $moscowDate = $moscowDateTime->format('d-m-Y H-i');


    $utm_keys = array('utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term');
    $utm_fields = array('utm_source' => 'UTM_SOURCE', 'utm_medium' => 'UTM_MEDIUM', 'utm_campaign' => 'UTM_CAMPAIGN', 'utm_content' => 'UTM_CONTENT', 'utm_term' => 'UTM_TERM');
    
    $lead_params['utm_source'] = 'telegram';
    
    foreach ($utm_keys as $row) {
        if (!empty($lead_params[$row])) {
            $bitrix_fields['FIELDS'][$utm_fields[$row]] =  urldecode($lead_params[$row]);
        }
    }

    $group_site = '';
    if ($lead_params['group_site'] == '1') {
        $group_site = 'bc.team';
    } elseif ($lead_params['group_site'] == '2') {
        $group_site = 'icoda.io';
    }

    $lead_source = '';
    if (!empty($lead_params['source'])) {
        $lead_source = '(' . $lead_params['source'] . ')';
    }

    $title = 'Заявка с группы ' . $group_site . ' '  . $lead_source . ' ' . $moscowDate;
    if (!empty($lead_params['name'])) {
        $title = $lead_params['name'] . ' - ' . $group_site . ' '  . $lead_source;
    } elseif (!empty($lead_params['telegram'])) {
        $title = $lead_params['telegram'] . ' - ' . $group_site . ' '  . $lead_source;
    }

    $bitrix_fields['FIELDS']['TITLE'] = $title;
    $bitrix_fields['FIELDS']['ASSIGNED_BY_ID'] = $last_responsible_user_id;


    if (!empty($lead_params['message'])) {
        $message = $lead_params['message'];
        $bitrix_fields['FIELDS']['COMMENTS'] = $message;
    }


    $bitrix_fields['FIELDS']['NAME'] = $lead_params['name'];

    $bitrix_fields['FIELDS']['EMAIL'] = [[
        'VALUE' => trim($lead_params['email']),
        'VALUE_TYPE' => 'WORK'

    ]];

    $bitrix_fields['FIELDS']['PHONE'] = [[
        'VALUE' =>  $lead_params['telegram'],
        'VALUE_TYPE' => 'WORK'
    ]];


    $bitrix_fields['FIELDS']['STATUS_ID'] = 'UC_PIZGE5';
    $bitrix_fields['FIELDS']['SOURCE_DESCRIPTION'] = 'Заявка с группы ' . $group_site . ' '  . $lead_source;


    file_put_contents(__DIR__ . '/bitrix_bc_tg_fields.txt', print_r($lead_params['email'], true), FILE_APPEND);
    file_put_contents(__DIR__ . '/bitrix_bc_tg_fields.txt', "\n", FILE_APPEND);
    file_put_contents(__DIR__ . '/bitrix_bc_tg_fields.txt', print_r($bitrix_fields, true), FILE_APPEND);
    file_put_contents(__DIR__ . '/bitrix_bc_tg_fields.txt', "\n\n", FILE_APPEND);

    // $response = wp_remote_get($bitrix_url . http_build_query($bitrix_fields));
    // $responseBody = wp_remote_retrieve_body($response);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $bitrix_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($bitrix_fields));
    $responseBody = curl_exec($ch);
    curl_close($ch);

    file_put_contents(__DIR__ . '/bitrix_bc_tg_requests.txt', print_r(date('Y-m-d H:i:s') .  '   ->   ' . $lead_params['email'], true), FILE_APPEND);
    file_put_contents(__DIR__ . '/bitrix_bc_tg_requests.txt', "\n", FILE_APPEND);
    file_put_contents(__DIR__ . '/bitrix_bc_tg_requests.txt', print_r($bitrix_url . http_build_query($bitrix_fields), true), FILE_APPEND);
    file_put_contents(__DIR__ . '/bitrix_bc_tg_requests.txt', "\n\n", FILE_APPEND);


    file_put_contents(__DIR__ . '/bitrix_bc_tg_results.txt', print_r($lead_params['email'], true), FILE_APPEND);
    file_put_contents(__DIR__ . '/bitrix_bc_tg_results.txt', "\n", FILE_APPEND);
    file_put_contents(__DIR__ . '/bitrix_bc_tg_results.txt', print_r($responseBody, true), FILE_APPEND);
    file_put_contents(__DIR__ . '/bitrix_bc_tg_results.txt', "\n\n", FILE_APPEND);

    $responseBody = json_decode($responseBody, TRUE);
    $lead_id = $responseBody['result'];
} catch (Exception $e) {
    file_put_contents(__DIR__ . '/bitrix_bc_tg_results.txt', "\n\n" . $e->getMessage() . "\n\n", FILE_APPEND);
}


return $lead_id;
