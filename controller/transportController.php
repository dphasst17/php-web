<?php 
    include_once '../model/transport.php';
    class TransController{
        public function switchToTransport(){
            $data = json_decode(file_get_contents('php://input'), true);
            $idUser = $data['idUser'];
            $name = $data['name'];
            $phone = $data['phone'];
            $city = $data['city'];
            $methods = $data['methods'];
            $costs = $data['costs'];

            insert_product_onTransport_table($idUser);
            add_infor_user_onTransport_table($name,$phone,$city,$methods,$costs,$idUser);
            delete_cart_all($idUser);
            echo "Success";
        }
        public function getAll(){
            $data = select_transport();
            echo json_encode($data);
        }
        public function viewTransportByUser($idUser){
            $data = view_transport_by_user($idUser);
            echo json_encode($data);
        }
        public function updateStatusTransport(){
            $data = json_decode(file_get_contents('php://input'), true);
            $fname = $data['fname'];
            $status = isset($data['status']) ? $data['status'] :'';
            $id = isset($data['id']) ? $data['id'] :'';
            $newStatus = isset($data['newStatus']) ? $data['newStatus'] :'';
            $oldStatus = isset($data['oldStatus']) ? $data['oldStatus'] :'';
            switch($fname){
                case 'id':
                    update_status_by_id($status,$id);
                    break;
                case 'all':
                    update_status_all($newStatus,$oldStatus);
            }
        }
        public function deleteItem(){
            $data = json_decode(file_get_contents('php://input'), true);
            $id = isset($data['id']) ? $data['id'] :'';
            delete_item($id);
        }
        public function switchDataToBill(){
            insert_data_to_bills();
        }
    }
?>