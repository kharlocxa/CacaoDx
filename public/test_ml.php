<?php
$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => 'http://192.168.1.18:8080/health',  // Test endpoint
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 10
]);

$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

echo "Response: " . $response . "\n";
echo "Error: " . $error . "\n";
?>