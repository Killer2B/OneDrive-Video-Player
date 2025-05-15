<?php
include 'token.php';

$user_id = '--user_id--'; // عدل هذا المعرف حسب المستخدم المطلوب
$file_path = '/Videos/anime/ep1.mp4'; // عدل هذا المسار حسب الملف المطلوب

$access_token = getAccessToken();

$url = "https://graph.microsoft.com/v1.0/users/$user_id/drive/root:" . rawurlencode($file_path);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $access_token"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

header('Content-Type: application/json');
echo $response;
?>