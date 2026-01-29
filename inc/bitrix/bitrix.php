<?php

function send_lead_to_bitrix($resource = '')
{
    file_put_contents(__DIR__ . '/bitrix_fields.txt', print_r($_POST, true), FILE_APPEND);
    file_put_contents(__DIR__ . '/bitrix_fields.txt', "\n\n", FILE_APPEND);

    try {
        // $bitrix_url = 'https://icoda.bitrix24.com/rest/63/ymsbww2es4yzx2pu/crm.lead.add.json?';
        $bitrix_url = 'https://icoda.bitrix24.com/rest/59/yd1pw1c6t2m5ffnc/crm.lead.add.json?';

        $bitrix_fields = [
            'FIELDS' => []
        ];


        // 4000800 - Руслан 39
        // 6489145 - Евгений 37
        // 6357817 - Никита 43
        // 6077686 - Влад 25
        // 6115717 - Luis 65
        // 7124977 - Vlad Krasilnikov 41
        // 7636786 - Dan Berbec 27
        // Sergey Nelyubin 47 
        // Ilya Hade 83
        // Ayana Albers 61
        // Oksana Yemelyanenko 89
        // Josh Yoon 91
        // Victor Zhabin 99

        // Artem Voinov 135
        // Katya Vladimirova 123
        // Michael Fogel  177
        // Oleg Tsukerman 179



        $lang_prefix = $_POST['lang-source'];


        // for check calculator requests
        // $_POST['is_calculator']

        // for check requests from section-banner-review
        // $_POST['is-banner-review-block']

        $testLog = [];

        // set responsible person Kate Vladimirova for utm_source=partner
        if( !empty($_POST['utm-utm_source']) && $_POST['utm-utm_source'] === 'partner' ) {
            $last_responsible_user_id = '99'; // return to 99
            $testLog['state'] = 'state_1';
        } else {
            if ($_POST['lang-source'] == 'es' || $_POST['lang-source'] == 'de' || $_POST['lang-source'] == 'zh-hans') {
                if ($_POST['lang-source'] == 'es') {
                    $responsible_es_users = array('99');
                    $last_responsible_user_id = get_option('last_responsible_bitrix_es_user_id');
                    if (empty($last_responsible_user_id) || !in_array($last_responsible_user_id, $responsible_es_users)) {
                        $last_responsible_user_id = $responsible_es_users[0];
                        $testLog['state'] = 'state_2';
                    } else {
                        foreach ($responsible_es_users as $key => $responsible_es_user_id) {
                            if ($last_responsible_user_id == $responsible_es_user_id) {
                                if (isset($responsible_es_users[$key + 1])) {
                                    $last_responsible_user_id = $responsible_es_users[$key + 1];
                                    $testLog['state'] = 'state_3';
                                } else {
                                    $last_responsible_user_id = $responsible_es_users[0];
                                    $testLog['state'] = 'state_4';
                                }
                                break;
                            }
                        }
                    }
                    if (empty($last_responsible_user_id)) {
                        $last_responsible_user_id = $responsible_es_users[0];
                        $testLog['state'] = 'state_5';
                    }
                    update_option('last_responsible_bitrix_es_user_id', $last_responsible_user_id);
                }
                if ($_POST['lang-source'] == 'de') {
                    $last_responsible_user_id = '39'; // 43
                    $testLog['state'] = 'state_5';
                }
                if ($_POST['lang-source'] == 'zh-hans') {
                    $last_responsible_user_id = '99'; // return to 99
                    $testLog['state'] = 'state_6';
                }
            } else {
                $responsible_users = array( '39', '99', '177', '179', '135' );
                $last_responsible_user_id = get_option('last_responsible_bitrix_user_id');
                $add_periodical_users = get_option('bitrix_add_periodical_users');
                $add_periodical_users = !empty($add_periodical_users) ? true : false;
                if ($add_periodical_users) {
                    // $responsible_users[] = '91';
                }
                // if ($_POST['lang-source'] == 'en') {
                //     $responsible_users[] = '91';
                // }
                if (empty($last_responsible_user_id) || !in_array($last_responsible_user_id, $responsible_users)) {
                    $last_responsible_user_id = $responsible_users[0];
                    $testLog['state'] = 'state_7';
                } else {
                    foreach ($responsible_users as $key => $responsible_user_id) {
                        if ($last_responsible_user_id == $responsible_user_id) {
                            if (isset($responsible_users[($key + 1)])) {
                                $last_responsible_user_id = $responsible_users[($key + 1)];
                                $testLog['state'] = 'state_8';
                            } else {
                                update_option('bitrix_add_periodical_users', !$add_periodical_users);
                                $last_responsible_user_id = $responsible_users[0];
                                $testLog['state'] = 'state_9';
                            }
                            break;
                        }
                    }
                }
                if (empty($last_responsible_user_id)) {
                    $last_responsible_user_id = $responsible_users[0];
                    $testLog['state'] = 'state_10';
                }
                update_option('last_responsible_bitrix_user_id', $last_responsible_user_id);
            }
        }

        $testLog['ID'] = $last_responsible_user_id;
        file_put_contents(__DIR__ . '/bitrix_test_log.txt', date('Y-m-d H:i:s') . "\n", FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_test_log.txt', print_r($testLog, true) . "\n\n\n", FILE_APPEND);


        $timeZone = 'Europe/Moscow';
        $moscowDateTime = new DateTime('now', new DateTimeZone($timeZone));
        $moscowDate = $moscowDateTime->format('d-m-Y H-i');


        $utm_keys = array('utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term');

        $utm_fields = array('utm_source' => 'UTM_SOURCE', 'utm_medium' => 'UTM_MEDIUM', 'utm_campaign' => 'UTM_CAMPAIGN', 'utm_content' => 'UTM_CONTENT', 'utm_term' => 'UTM_TERM');
        foreach ($utm_keys as $row) {
            $utm_name = 'utm-' . $row;
            if (!empty($_POST[$utm_name])) {
                $bitrix_fields['FIELDS'][$utm_fields[$row]] =  $_POST[$utm_name];
            }
        }

        if (!empty($_POST['user-country'])) {
            $bitrix_fields['FIELDS']['ADDRESS_COUNTRY'] = $_POST['user-country'];
        }

        $title = 'Заявка с сайта icoda.io ' . $moscowDate;
        if (!empty($_POST['name'])) {
            $title = $_POST['name'] . ' - icoda.io';
        } elseif (!empty($_POST['telegram'])) {
            $title = $_POST['telegram'] . ' - icoda.io';
        }
        $title .= ' (' . $lang_prefix . ')';
        if (!empty($resource)) {
            if (!empty($_POST['name'])) {
                $title = $_POST['name'] . ' - ' . parse_url($resource, PHP_URL_HOST);
            } elseif (!empty($_POST['telegram'])) {
                $title = $_POST['telegram'] . ' - ' . parse_url($resource, PHP_URL_HOST);
            } else {
                $title = 'Заявка с сайта ' . parse_url($resource, PHP_URL_HOST) . ' ' . $moscowDate;
            }
        }

        if( $_POST['user-country'] == 'United States' ) {
            $title = 'USA - ' . $title;
        }

        $bitrix_fields['FIELDS']['TITLE'] = $title;
        $bitrix_fields['FIELDS']['ASSIGNED_BY_ID'] = $last_responsible_user_id;

        $message = !empty($_POST['message']) ? $_POST['message'] : '';

        $questions_content = '';
        if(!empty($_POST['project-name'])) {
            $questions_content .= "\n\n Project Name: " .  $_POST['project-name'];
        }

        if(!empty($_POST['industry'])) {
            if( $_POST['industry'] === 'other' ) {
                $questions_content .= "\n\n Industry: " .  $_POST['other_industry'];
            } else {
                $questions_content .= "\n\n Industry: " .  $_POST['industry'];
            }
        }

        if(!empty($_POST['achieve'])) {
            if( $_POST['achieve'] === 'other' ) {
                $questions_content .= "\n\n Achieve: " .  $_POST['other_achieve'];
            } else {
                $questions_content .= "\n\n Achieve: " .  $_POST['achieve'];
            }
        }

        if(!empty($_POST['country'])) {
            if( $_POST['country'] === 'other' ) {
                $questions_content .= "\n\n Country: " .  $_POST['other_country'];
            } else {
                $questions_content .= "\n\n Country: " .  $_POST['country'];
            }
        }

        if(!empty($_POST['service'])) {
            $questions_content .= "\n\n Service: " .  implode(', ', $_POST['service']);
        }

        if(!empty($_POST['long'])) {
            if( $_POST['long'] === 'other' ) {
                $questions_content .= "\n\n Long: " .  $_POST['other_long'];
            } else {
                $questions_content .= "\n\n Long: " .  $_POST['long'];
            }
        }
        if(!empty($questions_content)) {
            $message = $questions_content . "\n\nAdditional Information: \n" . $message;
        }

        if(!empty($_POST['is-banner-review-block']) && $_POST['is-banner-review-block'] === 'yes') {
            $message = "LISTING \n\n" . $message;
        }

        $bitrix_fields['FIELDS']['COMMENTS'] = $message;


        $bitrix_fields['FIELDS']['NAME'] = $_POST['name'];
        // $bitrix_fields['FIELDS']['LAST_NAME'] ='UC_PIZGE5';
        $bitrix_fields['FIELDS']['EMAIL'] = [[
            'VALUE' => (!empty($_POST['email']) ? $_POST['email'] : $_POST['email_mob']),
            'VALUE_TYPE' => 'WORK'

        ]];

        $bitrix_fields['FIELDS']['PHONE'] = [[
            'VALUE' =>  $_POST['telegram'],
            'VALUE_TYPE' => 'WORK'
        ]];


        $bitrix_fields['FIELDS']['STATUS_ID'] = 'UC_PIZGE5';
        if (empty($resource)) {
            $bitrix_fields['FIELDS']['SOURCE_DESCRIPTION'] = 'From site icoda.io';
            $bitrix_fields['FIELDS']['SOURCE_ID'] = 'WEB';
        } else {
            $bitrix_fields['FIELDS']['SOURCE_DESCRIPTION'] = 'From site ' . parse_url($resource, PHP_URL_HOST);
        }

        $gClientId = false;
        if (isset($_COOKIE['_ga'])) {
            list($version, $domainDepth, $cid1, $cid2) = explode('.', $_COOKIE["_ga"], 4);
            $contents = array('version' => $version, 'domainDepth' => $domainDepth, 'cid' => $cid1 . '.' . $cid2);
            $gClientId = $contents['cid'];
        }
        if (!empty($gClientId)) {
            $bitrix_fields['FIELDS']['UF_CRM_1684321525495'] = $gClientId;
        }

        file_put_contents(__DIR__ . '/bitrix_fields.txt', print_r(date('Y-m-d H:i:s') .  '   ->   ' . $_POST['email'], true), FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_fields.txt', "\n", FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_fields.txt', print_r($_POST['email'], true), FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_fields.txt', "\n", FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_fields.txt', print_r($bitrix_fields, true), FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_fields.txt', "\n\n", FILE_APPEND);

        // $response = wp_remote_get($bitrix_url . http_build_query($bitrix_fields));
        // $responseBody = wp_remote_retrieve_body($response);


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $bitrix_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($bitrix_fields));
        $responseBody = curl_exec($ch);
        curl_close($ch);


        file_put_contents(__DIR__ . '/bitrix_requests.txt', print_r(date('Y-m-d H:i:s') .  '   ->   ' . $_POST['email'], true), FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_requests.txt', "\n", FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_requests.txt', print_r($bitrix_url . http_build_query($bitrix_fields), true), FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_requests.txt', "\n\n", FILE_APPEND);

        file_put_contents(__DIR__ . '/bitrix_results.txt', print_r(date('Y-m-d H:i:s') .  '   ->   ' . $_POST['email'], true), FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_results.txt', "\n", FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_results.txt', print_r($responseBody, true), FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_results.txt', "\n\n", FILE_APPEND);
    } catch (Exception $e) {
        file_put_contents(__DIR__ . '/bitrix_results.txt', "\n\n" . $e->getMessage(), FILE_APPEND);
    }
}

function send_calendly_lead_to_bitrix($data, $owner = false)
{
    file_put_contents(__DIR__ . '/bitrix_calendly_fields.txt', print_r($data, true), FILE_APPEND);
    file_put_contents(__DIR__ . '/bitrix_calendly_fields.txt', "\n\n", FILE_APPEND);

    try {
        $bitrix_url = 'https://icoda.bitrix24.com/rest/59/yd1pw1c6t2m5ffnc/crm.lead.add.json?';

        $bitrix_calendly_fields = [
            'FIELDS' => []
        ];

        $utm_keys = array('utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term');
        $utm_fields = array('utm_source' => 'UTM_SOURCE', 'utm_medium' => 'UTM_MEDIUM', 'utm_campaign' => 'UTM_CAMPAIGN', 'utm_content' => 'UTM_CONTENT', 'utm_term' => 'UTM_TERM');
        foreach ($utm_keys as $row) {
            $utm_name = 'utm-' . $row;
            if (!empty($data[$utm_name])) {
                $bitrix_calendly_fields['FIELDS'][$utm_fields[$row]] =  $data[$utm_name];
            }
        }

        $title = 'Заявка с calendly';
        if (!empty($data['name'])) {
            $title = $data['name'] . ' - calendly';
        } elseif (!empty($data['telegram'])) {
            $title = $data['telegram'] . ' - calendly';
        }

        $bitrix_calendly_fields['FIELDS']['TITLE'] = $title;
        $assignTo = empty($owner) ? 99 : $owner; // return to 99
        $bitrix_calendly_fields['FIELDS']['ASSIGNED_BY_ID'] = $assignTo;

        if (!empty($data['message'])) {
            $bitrix_calendly_fields['FIELDS']['COMMENTS'] = $data['message'];
        }

        $bitrix_calendly_fields['FIELDS']['NAME'] = $data['name'];
        $bitrix_calendly_fields['FIELDS']['EMAIL'] = [[
            'VALUE' => (!empty($data['email']) ? $data['email'] : $data['email_mob']),
            'VALUE_TYPE' => 'WORK'

        ]];

        $bitrix_calendly_fields['FIELDS']['PHONE'] = [[
            'VALUE' =>  $data['telegram'],
            'VALUE_TYPE' => 'WORK'
        ]];

        $bitrix_calendly_fields['FIELDS']['STATUS_ID'] = 'UC_PIZGE5';
        $bitrix_calendly_fields['FIELDS']['SOURCE_DESCRIPTION'] = 'From calendly';
        $bitrix_calendly_fields['FIELDS']['SOURCE_ID'] = 'WEB';

        file_put_contents(__DIR__ . '/bitrix_calendly_fields.txt', print_r(date('Y-m-d H:i:s') .  '   ->   ' . $data['email'], true), FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_calendly_fields.txt', "\n", FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_calendly_fields.txt', print_r($data['email'], true), FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_calendly_fields.txt', "\n", FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_calendly_fields.txt', print_r($bitrix_calendly_fields, true), FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_calendly_fields.txt', "\n\n", FILE_APPEND);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $bitrix_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($bitrix_calendly_fields));
        $responseBody = curl_exec($ch);
        curl_close($ch);


        file_put_contents(__DIR__ . '/bitrix_calendly_requests.txt', print_r(date('Y-m-d H:i:s') .  '   ->   ' . $data['email'], true), FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_calendly_requests.txt', "\n", FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_calendly_requests.txt', print_r($bitrix_url . http_build_query($bitrix_calendly_fields), true), FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_calendly_requests.txt', "\n\n", FILE_APPEND);

        file_put_contents(__DIR__ . '/bitrix_calendly_results.txt', print_r(date('Y-m-d H:i:s') .  '   ->   ' . $data['email'], true), FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_calendly_results.txt', "\n", FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_calendly_results.txt', print_r($responseBody, true), FILE_APPEND);
        file_put_contents(__DIR__ . '/bitrix_calendly_results.txt', "\n\n", FILE_APPEND);
    } catch (Exception $e) {
        file_put_contents(__DIR__ . '/bitrix_calendly_results.txt', "\n\n" . $e->getMessage(), FILE_APPEND);
    }
}


add_action('template_redirect', function () {
    if (!empty($_GET['test_get_leads'])) {

        $q_data = array(
            'filter' => [
                'STATUS_ID' => 'CONVERTED',
                'ASSIGNED_BY_ID' => '43',
            ],
            // 'select' => [
            //     'ID',
            //     'DATE_CREATED'
            // ]
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://icoda.bitrix24.com/rest/59/iwdwl1dmro22z0kv/crm.lead.list.json');
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($q_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $responseBody = curl_exec($ch);
        curl_close($ch);
        $responseBody = json_decode($responseBody, TRUE);

        foreach ($responseBody['result'] as $lead_data) {

            if ($lead_data['ASSIGNED_BY_ID'] == 43) {

                $u_data =  [
                    'id' => $lead_data['ID'],
                    'fields' => [
                        'ASSIGNED_BY_ID' => 135
                    ]
                ];

                file_put_contents(__DIR__ . '/nikita_update.txt', $lead_data['ID'] . ',' . $lead_data['ASSIGNED_BY_ID'] . "\n", FILE_APPEND);

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://icoda.bitrix24.com/rest/59/3yvggbhvtg5j34ht/crm.lead.update.json');
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($u_data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                $responseBodyUpdate = curl_exec($ch);
                curl_close($ch);
                $responseBodyUpdate = json_decode($responseBodyUpdate, TRUE);

                // echo "<pre>";
                // print_r($responseBodyUpdate);
                // echo "</pre>";
            }
        }

        echo "<pre>";
        print_r($responseBody['result']);
        echo "</pre>";
        die;
    }
    if (!empty($_GET['test_get_contacts'])) {

        $q_data = array(
            'filter' => [
                'ASSIGNED_BY_ID' => '43',
            ],
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://icoda.bitrix24.com/rest/59/a647zxt887xwdu6w/crm.contact.list.json');
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($q_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $responseBody = curl_exec($ch);
        curl_close($ch);
        $responseBody = json_decode($responseBody, TRUE);

        foreach ($responseBody['result'] as $contact_data) {

            if ($contact_data['ASSIGNED_BY_ID'] == 43) {

                $u_data =  [
                    'id' => $contact_data['ID'],
                    'fields' => [
                        'ASSIGNED_BY_ID' => 135
                    ]
                ];

                file_put_contents(__DIR__ . '/nikita_contacts.txt', $contact_data['ID'] . ',' . $contact_data['ASSIGNED_BY_ID'] . "\n", FILE_APPEND);

                if( true || $contact_data['ID'] == 99 ) {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://icoda.bitrix24.com/rest/59/8p0l7dgpg9rwftjc/crm.contact.update.json');
                    curl_setopt($ch, CURLOPT_POST, TRUE);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($u_data));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                    $responseBodyUpdate = curl_exec($ch);
                    curl_close($ch);
                    $responseBodyUpdate = json_decode($responseBodyUpdate, TRUE);

                    // echo "<pre>";
                    // print_r($responseBodyUpdate);
                    // echo "</pre>";
                }
                
            }
        }

        echo "<pre>";
        print_r($responseBody['result']);
        echo "</pre>";
        die;
    }

    if (!empty($_GET['test_get_lead_specified'])) {

        $q_data = array(
            "id" => 27125
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://icoda.bitrix24.com/rest/59/iwdwl1dmro22z0kv/crm.lead.get.json');
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($q_data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $responseBody = curl_exec($ch);
        curl_close($ch);
        $responseBody = json_decode($responseBody, TRUE);

        echo "<pre>";
        print_r($responseBody['result']);
        echo "</pre>";
        die;
    }
});
