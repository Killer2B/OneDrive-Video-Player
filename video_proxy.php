<?php
include 'token.php';

$user_id = '-';
$item_id = $_GET['id'] ?? '';
if (!$item_id) {
    die("Missing item ID");
}

$access_token = getAccessToken();

$url = "https://graph.microsoft.com/v1.0/users/$user_id/drive/items/$item_id/content";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $access_token"
]);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_exec($ch);
curl_close($ch);
?>