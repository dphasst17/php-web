<?php 
    class TokenController{
        public function createToken($exp, $data, $type) {
            $key = getenv("S_KEY");
            $header = ['alg' => 'HS256', 'type' => 'JWT', 'exp' => $exp, 'token_type' => $type];
            $header_encode = base64_encode(json_encode($header));
            $payload_encode = base64_encode(json_encode($data));
            $signature = hash_hmac('SHA256', $header_encode . $payload_encode, $key);
            $signature_encode = base64_encode($signature);
            return $header_encode . '.' . $payload_encode . '.' . $signature_encode;
        }
        public function verifyToken($token) {
            $key = getenv("S_KEY");
            $token_parts = explode('.',$token);
            $signature = base64_encode(hash_hmac('SHA256',$token_parts[0] .$token_parts[1], $key));
            if($signature != $token_parts[2]){
                return false;
            }
            $payload = base64_decode($token_parts[1],true);
            return $payload;
        }
    } 
?>