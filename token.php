<?php
function getAccessToken() {
    $tenant_id = '--tenant_id--'; // Replace with your actual tenant ID
    $client_id = '--client_id--'; // Replace with your actual client ID
    $client_secret = '--secret--'; // Replace with your actual client secret
    
    $cache_file = __DIR__ . '/token_cache.json';

    if (file_exists($cache_file)) {
        $cached = json_decode(file_get_contents($cache_file), true);
        if ($cached && time() < $cached['expires_at']) {
            return $cached['access_token'];
        }
    }

    $url = "https://login.microsoftonline.com/$tenant_id/oauth2/v2.0/token";
    $data = [
        "client_id" => $client_id,
        "scope" => "https://graph.microsoft.com/.default",
        "client_secret" => $client_secret,
        "grant_type" => "client_credentials"
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($response, true);
    if (!isset($json['access_token'])) {
        die("فشل في جلب التوكن");
    }

    file_put_contents($cache_file, json_encode([
        'access_token' => $json['access_token'],
        'expires_at' => time() + $json['expires_in'] - 60
    ]));

    return $json['access_token'];
}
?>