<?php
global $key;

// Define a key here:
$jwt_key = $key;

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}
function base64url_decode($data) {
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

function generate_jwt($payload, $expire){
    // Header
    $headers = ['alg'=>'HS256', 'type'=>'JWT', 'expire' => time()+$expire];
    if($expire){
        $headers['expire'] = time()+$expire;
    }
    $headers_encoded = base64url_encode(json_encode($headers));

    //Payload
    $payload_encoded = base64url_encode(json_encode($payload));

    //Signature
    $signature = hash_hmac('SHA256',$headers_encoded.$payload_encoded, $jwt_key);
    $signature_encoded = base64url_encode($signature);

    //Token
    $token = $headers_encoded . '.' . $payload_encoded .'.'. $signature_encoded;

    return $token;
}

function verify_jwt($token){
    //Break token parts
    $token_parts = explode('.', $token);

    //Verify Signature
    $signature = base64url_encode(hash_hmac('SHA256',$token_parts[0].$token_parts[1], $jwt_key));
    if($signature != $token_parts[2]){
        return false;
    }

    //Decode headers & payload
    $headers = json_decode(base64url_decode($token_parts[0]), true);
    $payload = json_decode(base64url_decode($token_parts[1]), true);

    //Verify validity
    if(isset($headers['expire']) && $headers['expire'] < time()){
        return false;
    }

    //If token successfully verified
    return $payload;
}