<?php 
    include '../model/comment.php';
    class CommentController{
        public function getAll(){
            $data = comment_select_all();
            echo json_encode($data);
        }
        public function commentInsert(){
            $data = json_decode(file_get_contents('php://input'), true);
            $id = $data['id'];
            $idProduct=$data['idProduct'];
            $value = $data['value'];
            $date = $data['date'];
            comment_insert($id,$idProduct,$value,$date);
        }
        public function commentDelete(){
            $data = json_decode(file_get_contents('php://input'), true);
            $id = $data['id'];
            comment_delete($id);
        }
    }
?>