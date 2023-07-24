<?php 
    include_once '../model/warehouse.php';
    class WareHouseController{
        public function getAll(){
            $data = get_all_warehouse();
            echo json_encode($data);
        }
        public function getTotalProduct(){
            $data = get_total_product_in_ware();
            echo json_encode($data);
        }
    }
?>