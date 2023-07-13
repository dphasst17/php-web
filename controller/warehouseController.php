<?php 
    include '../model/warehouse.php';
    class WareHouseController{
        public function getAll(){
            $data = get_total_product_in_ware();
            echo json_encode($data);
        }
    }
?>