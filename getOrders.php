<?php
function base64UrlDecode($data) {
    return base64_decode(strtr($data, '-_', '+/'));
}

function validateJWT($jwt, $secret) {
    list($headerEncoded, $payloadEncoded, $signatureEncoded) = explode('.', $jwt);
    $dataEncoded = "$headerEncoded.$payloadEncoded";
    $signature = base64UrlDecode($signatureEncoded);

    $validSignature = hash_hmac('sha256', $dataEncoded, $secret, true);

    if (hash_equals($validSignature, $signature)) {
        $payload = json_decode(base64UrlDecode($payloadEncoded), true);

        // Επικύρωση χρόνου-validation of time
        $now = time();
        if ($payload['iat'] <= $now && $payload['exp'] >= $now && $payload['nbf'] <= $now) {
            return $payload['data'];
        }
    }

    return null;
}
header('Content-Type: application/json');
$headers = getallheaders();
$authHeader = $headers['Authorization'] ?? '';
if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
    $jwt = $matches[1];
    $secret = 'secretkey';
    $userData = validateJWT($jwt, $secret);
    if ($userData!=null) {
        //echo json_encode(['success' => true, 'data' => $userData]);
        require_once("Database.php");
        $code = $_GET['code'];

        $D = new Database();
        $conn = $D->connect();
        $res = Database::getOrders($conn, $code);
        echo json_encode(['success' => true, 'data' => $res ]);
        //echo $res;
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid token']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No token provided']);
}
?>