<?php
    include_once '../model/user.php';
    include_once '../model/bill.php';
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
    class UserController{
        public function getUser($idUser){
            $data = user_select_by_id($idUser);
            echo json_encode($data);
        }
        public function viewBought($idUser){
            $data = select_bill_by_id($idUser);
            echo json_encode($data);
        }
        public function updateUser(){
            $data = json_decode(file_get_contents('php://input'), true);
            $id = isset($data['id'])? $data['id']: '';
            $name = isset($data['name'])? $data['name']: '';
            $email = isset($data['email'])? $data['email']: '';
            update_user($name,$email,$id);
        }
        public function updateImage(){
            if(isset($_FILES['file']['name'])){
                // file name
                $filename = $_FILES['file']['name'];
                $id = $_POST['id'];
                // Location
                $location = '/public/images/uploads/'.$filename;
             
                // file extension
                $file_extension = pathinfo($location, PATHINFO_EXTENSION);
                $file_extension = strtolower($file_extension);
             
                // Valid extensions
                $valid_ext = array("pdf","doc","docx","jpg","png","jpeg","webp");
             
                $response = 0;
                if(in_array($file_extension,$valid_ext)){
                     // Upload file
                     if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                          $response = 1;
                     } 
                }
                upload_image($filename,$id);
                echo $response;
                exit;
            }
        }
        public function staffStatistics(){
            $data = user_select_by_role('1');
            echo json_encode($data);
        }
        public function userLogin () {
            $data = json_decode(file_get_contents('php://input'), true);
            if(isset($data['username'])){
                $username = $data['username'];
                $password = $data['password'];
                $result = user_login($username,$password);
                if(!empty($result)){
                    http_response_code(200);
                    $newResult = array(
                        "idUser" => $result[0]["idUser"],
                        "nameUser" => $result[0]["nameUser"]
                    );
                    header('Content-type: text/javascript');
                    echo json_encode($newResult,JSON_PRETTY_PRINT);
                    exit;
                }else{
                    http_response_code(401);
                    echo "Login false!";
                    exit;
                }
            }else{
                $email = $data['email'];
                $name = $data['name'];
                $result = user_login_email($email);
                if(!empty($result)){
                    http_response_code(200);
                    $newResult = array(
                        "idUser" => $result[0]["idUser"],
                        "nameUser" => $result[0]["nameUser"]
                    );
                    header('Content-type: text/javascript');
                    echo json_encode($newResult,JSON_PRETTY_PRINT);
                    exit;
                }else{
                    $parts = explode("@", $email);
                    $idUser = $parts[0];
                    insert_user_with_email($idUser,$name,$email);
                    $resultData= array(
                        "idUser"=>$idUser,
                        "nameUser"=>$name
                    );
                    http_response_code(201);
                    echo json_encode($resultData);
                    exit;
                }
            }
        }
        private function decodeToken ($jwt) {
            $key = new Key(getenv(S_KEY), 'HS256');
            $decoded = JWT::decode($jwt, $$key);
            return $decoded;
        }
    }
?>