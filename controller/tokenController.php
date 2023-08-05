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
        public function getNewToken(){
            $token = $this->getToken();
            $idUser = $this->verifyToken($token);
            $expAccess = time() + 600;
            $newAccessToken = $this->createToken($expAccess,$idUser,'access');
            $result = array(
                'accessToken'=>$newAccessToken,
                'expAccess'=>$expAccess
            );
            echo json_encode($result);
        }
        public function getToken(){
            $headers = getallheaders();
            if(isset($headers['Authorization'])){
                $authorization = $headers['Authorization'];
                $token = str_replace('Bearer ', '', $authorization);
                return $token;
            }
            
        }
        public function verifyToken($token) {
            $key = getenv("S_KEY");
            $token_parts = explode('.',$token);
            $signature = base64_encode(hash_hmac('SHA256',$token_parts[0] .$token_parts[1], $key));
            $header = json_decode(base64_decode($token_parts[0]),true);
            
            if($signature != $token_parts[2]){
                echo "Invalid Token";
                return false;
            }
            if (isset($header['exp']) && time() > $header['exp']) {
                echo "Token has expired";
                return false;
            }
            $payload = json_decode(base64_decode($token_parts[1]),true);
            $payload = trim($payload,'"');

            return $payload;
        }
    } 
?>