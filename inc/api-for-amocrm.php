<?php

function distribution_cold_leads_callback(WP_REST_Request $request)
{
	$timeZone = 'Europe/Moscow';
	$moscowDateTime = new DateTime('now', new DateTimeZone($timeZone));
	$moscowDate = $moscowDateTime->format('d-m-Y');
	$moscowDateHour = (int) $moscowDateTime->format('H');
	$lastDate = get_option('icoda_amo_last_request_update_leads');
	if ($moscowDateHour == 10 && $lastDate != $moscowDate) {
		// include_once get_stylesheet_directory() . "/amocrm_api/handler-api.php";
		update_option('icoda_amo_last_request_update_leads', $moscowDate);
		return '{"accepted":0}';
	} else {
		return '{"accepted":1}';
	}
}

add_action('rest_api_init', function () {
	register_rest_route('amo/v1', '/distribution_cold_leads', [
		'methods'  => 'POST',
		'callback' => 'distribution_cold_leads_callback',
	]);
});



function telegram_lead_callback(WP_REST_Request $request)
{
	$lead_params = $request->get_params();
	$lead_id = include_once get_stylesheet_directory() . "/amocrm_api/handler-tg.php";

	// include_once get_stylesheet_directory() . "/inc/bitrix/bitrix-tg.php";

	$response = [
		'accepted' => 1
	];
	if (!empty($lead_id)) {
		$response['lead_id'] = $lead_id;
		$response['lead_url'] = 'https://icoda.amocrm.ru/leads/detail/' . $lead_id;
	}
	return json_encode($response);
}

function telegram_bc_lead_callback(WP_REST_Request $request)
{
	$lead_params = $request->get_params();
	$lead_id = include_once get_stylesheet_directory() . "/amocrm_api/handler-bc-tg.php";

	// include_once get_stylesheet_directory() . "/inc/bitrix/bitrix-bc-tg.php";

	$response = [
		'accepted' => 1
	];
	if (!empty($lead_id)) {
		$response['lead_id'] = $lead_id;
		$response['lead_url'] = 'https://icoda.amocrm.ru/leads/detail/' . $lead_id;
	}
	return json_encode($response);
}

add_action('rest_api_init', function () {
	register_rest_route('amo/v1', '/telegram_lead', [
		'methods'  => 'POST',
		'callback' => 'telegram_lead_callback',
	]);

	register_rest_route('amo/v1', '/telegram_bc_lead', [
		'methods'  => 'POST',
		'callback' => 'telegram_bc_lead_callback',
	]);
});
