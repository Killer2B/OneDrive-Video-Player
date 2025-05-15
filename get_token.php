<?php

$url = "https://login.microsoftonline.com/$tenant_id/oauth2/v2.0/token";

$data = [
    "client_id" => $client_id,
    "scope" => "https://graph.microsoft.com/.default",
    "client_secret" => $client_secret,
    "grant_type" => "client_credentials"
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

header('Content-Type: application/json');
echo $response;
