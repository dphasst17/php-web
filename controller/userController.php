<?php 
    include '../model/user.php';
    include '../model/bill.php';
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
            $update = update_user($name,$email,$id);
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
                $valid_ext = array("pdf","doc","docx","jpg","png","jpeg");
             
                $response = 0;
                if(in_array($file_extension,$valid_ext)){
                     // Upload file
                     if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                          $response = 1;
                     } 
                }
                $upload = upload_image($filename,$id);
                echo $response;
                exit;
            }
        }
    }
?>