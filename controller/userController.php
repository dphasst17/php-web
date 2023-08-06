<?php
    include_once '../model/user.php';
    include_once '../model/bill.php';
    class UserController extends tokenController{
        public function getUser(){
            $token = $this->getToken();
            $idUser = $this->verifyToken($token);
            $data = user_select_by_id($idUser);
            echo json_encode($data);
        }
        public function getIdAdmin($idUser){
            $data = user_select_by_id($idUser);
            echo json_encode($data);
        }
        public function viewBought(){
            $token = $this->getToken();
            $idUser = $this->verifyToken($token);
            $data = select_bill_by_id($idUser);
            echo json_encode($data);
        }
        public function updateUser(){
            $data = json_decode(file_get_contents('php://input'), true);
            $token = $this->getToken();
            $id = $this->verifyToken($token);
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
                $location = '../public/images/uploads/'.$filename;
             
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
        public function userLogin() {
            $data = json_decode(file_get_contents('php://input'), true);
            if(isset($data['username'])){
                $username = $data['username'];
                $password = $data['password'];
                $result = user_login($username,$password);
                if(!empty($result)){
                    http_response_code(200);
                    $expAccess = time() + 600;
                    $expRefresh = time() + 5 * 24 * 60 * 60;
                    $accessToken = $this->createToken($expAccess, $result[0]['idUser'], 'access');
                    $refreshToken = $this->createToken($expRefresh, $result[0]['idUser'], 'refresh');
                    $resultData = array(
                        "nameUser" => $result[0]["nameUser"],
                        "accessToken" => $accessToken,
                        "expAccess" => $expAccess,
                        "refreshToken" => $refreshToken,
                        "expRf" => $expRefresh
                    );
                    echo json_encode($resultData,JSON_PRETTY_PRINT);
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
                    $expAccess = time() + 600;
                    $expRefresh = time() + 5 * 24 * 60 * 60;
                    $accessToken = $this->createToken($expAccess, $result[0]['idUser'], 'access');
                    $refreshToken = $this->createToken($expRefresh, $result[0]['idUser'], 'refresh');
                    $resultData = array(
                        "nameUser" => $result[0]["nameUser"],
                        "accessToken" => $accessToken,
                        "expAccess" => $expAccess,
                        "refreshToken" => $refreshToken,
                        "expRf" => $expRefresh
                    );
                    echo json_encode($resultData,JSON_PRETTY_PRINT);
                    exit;
                }else{
                    $parts = explode("@", $email);
                    $idUser = $parts[0];
                    insert_user_with_email($idUser,$name,$email);

                    http_response_code(201);
                    $expAccess = time() + 600;
                    $expRefresh = time() + 5 * 24 * 60 * 60;
                    $accessToken = $this->createToken($expAccess, $idUser, 'access');
                    $refreshToken = $this->createToken($expRefresh, $idUser, 'refresh');
                    $resultData = array(
                        "nameUser" => $name,
                        "accessToken" => $accessToken,
                        "expAccess" => $expAccess,
                        "refreshToken" => $refreshToken,
                        "expRf" => $expRefresh
                    );
                    echo json_encode($resultData,JSON_PRETTY_PRINT);
                    exit;
                }
            }
        }
    }
?>
