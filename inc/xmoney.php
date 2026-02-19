<?php

function createXMoneyOrder($orderData)
{
    /**
     * Requires libcurl
     */

    $curl = curl_init();

    $payload = http_build_query($orderData);

    curl_setopt_array($curl, [
        CURLOPT_HTTPHEADER => [
            "Authorization: Bearer <YOUR_JWT_HERE>",
            "Content-Type: application/x-www-form-urlencoded"
        ],
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_URL => "https://docs.xmoney.com/_mock/api/reference/order",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
    ]);

    $response = curl_exec($curl);
    $error = curl_error($curl);

    curl_close($curl);

    if ($error) {
        echo "cURL Error #:" . $error;
    } else {
        echo $response;
    }
}

?>

<?php

function getBase64JsonRequest(array $orderData)
{
    return base64_encode(json_encode($orderData));
}

function getBase64Checksum(array $orderData, $secretKey)
{
    $hmacSha512 = hash_hmac('sha512', json_encode($orderData), $secretKey, true);
    return base64_encode($hmacSha512);
}


add_action('wp_ajax_getXMoneySignatures', 'getXMoneySignatures'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_getXMoneySignatures', 'getXMoneySignatures'); // wp_ajax_nopriv_{action}

function getXMoneySignatures()
{
    $customer_identifier = wp_generate_uuid4();
    $customer_identifier = str_replace('-', '', $customer_identifier);

    $order_identifier = wp_generate_uuid4();
    $order_identifier = str_replace('-', '', $order_identifier);

    // Sample order data
    $orderData = [
        "siteId" => 11972,
        "customer" => [
            "identifier" => $customer_identifier,
            "email" => $_POST['email']
        ],
        "order" => [
            "orderId" => substr($order_identifier, 0, 10),
            "type" => "purchase",
            "amount" => 29.99,
            "currency" => "USD"
        ],
        "cardTransactionMode" => "authAndCapture",
        "backUrl" => "https://icoda.io/?book-payment-success=1"
    ];

    $secretKey = "fe6b5f7f8a3b040d030b683f4e507c41";

    file_put_contents(__DIR__ . '/test-xmoney.txt', print_r($orderData, true) . "\n\n", FILE_APPEND);

    $base64JsonRequest = getBase64JsonRequest($orderData);
    $base64Checksum = getBase64Checksum($orderData, $secretKey);
    wp_send_json_success([
        'base64JsonRequest' => $base64JsonRequest,
        'base64Checksum' => $base64Checksum
    ]);
}
