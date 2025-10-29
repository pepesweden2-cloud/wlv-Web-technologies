<?php

require_once("Database.php");
require_once("User.php");

function base64UrlEncode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function createJWT($header, $payload, $secret) {
    $headerEncoded = base64UrlEncode(json_encode($header));
    $payloadEncoded = base64UrlEncode(json_encode($payload));
    $signature = hash_hmac('sha256', "$headerEncoded.$payloadEncoded", $secret, true);
    $signatureEncoded = base64UrlEncode($signature);
    return "$headerEncoded.$payloadEncoded.$signatureEncoded";
}

function validateUser($username, $password) {
    $D = new Database();
    $conn = $D->connect();
    $jsonUser = Database::login($conn, $username, $password);
    return $jsonUser;
}

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$username = $data['username'] ?? '';
$password = $data['password'] ?? '';
$jsuser = validateUser($username, $password);
if ($jsuser!=null) {
    $header = ['alg' => 'HS256', 'typ' => 'JWT'];
    $payload = [
        'iss' => 'locahost',
        'aud' => 'locahost',
        'iat' => time(),
        'nbf' => time(),
        'exp' => time() + (60 * 60), // 1 ώρα
        'data' => [
            'username' => $username, 'email' => $jsuser['email']
        ]
    ];
    $secret = "secretkey";
    $jwt = createJWT($header, $payload, $secret);

    echo json_encode(['success' => true, 'token' => $jwt, 'code' => $jsuser['email']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
}
?>
