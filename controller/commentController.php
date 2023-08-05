<?php 
    include_once '../model/comment.php';
    class CommentController extends tokenController{
        public function getAll(){
            $data = comment_select_all();
            echo json_encode($data);
        }
        public function commentInsert(){
            $data = json_decode(file_get_contents('php://input'), true);
            $token = $this->getToken();
            $idUser = $this->verifyToken($token);
           /*  $id = $data['id']; */
            $idProduct=$data['idProduct'];
            $value = $data['value'];
            $date = $data['date'];
            comment_insert($idUser,$idProduct,$value,$date);
        }
        public function commentDelete(){
            $data = json_decode(file_get_contents('php://input'), true);
            $id = $data['id'];
            comment_delete($id);
        }
        public function commentByIdProduct($idProduct){
            $data = comment_select_by_hang_hoa_user($idProduct);
            echo json_encode($data);
        }
    }
?>