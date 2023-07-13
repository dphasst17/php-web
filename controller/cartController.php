<?php 
 class CartController{
    public function index(){
        $data = json_decode(file_get_contents('php://input'), true);
        $fname = isset($data['fname']) ? $data['fname']:'add';
        $idCart = isset($data['idCart']) ? $data['idCart'] :'';
        $idUser = isset($data['idUser']) ? $data['idUser'] :'';
        $idProduct = isset($data['idProduct'])? $data['idProduct'] : '';
        $count = isset($data['count'])? $data['count'] : 1;
        switch($fname){
            case 'view':
                $data = select_product_in_cart($idUser);
                echo json_encode($data);
                break;
            case 'add':
                add_to_cart($idUser,$idProduct,$count);
                break;
            case 'update':
                update_cart($count,$idCart);
                break;
            case 'delete':
                delete_cart($idCart);
                break;
            case 'deleteAll':
                delete_cart_all($idUser);
                break;
            
        }

    }
 }

?>