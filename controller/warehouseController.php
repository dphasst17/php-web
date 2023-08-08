<?php 
    include_once '../model/warehouse.php';
    class WareHouseController{
        public function getAll(){
            $data = get_all_warehouse();
            $getAll = [];
            foreach ($data as $product) {
                $newProduct = [];
                foreach ($product as $key => $value) {
                    if (!is_int($key)) {
                    $newProduct[$key] = $value;
                    }
                }
                $getAll[] = $newProduct;
            }
            header('Content-type: text/javascript');
            echo json_encode($getAll, JSON_PRETTY_PRINT);
        }
        public function getTotalProduct(){
            $products = get_total_product_in_ware();
            $total = [];
            foreach ($products as $product) {
                $newProduct = [];
                foreach ($product as $key => $value) {
                    if (!is_int($key)) {
                    $newProduct[$key] = $value;
                    }
                }
                $total[] = $newProduct;
            }
            header('Content-type: text/javascript');
            echo json_encode($total, JSON_PRETTY_PRINT);
        }
        public function insertWare(){
            $data = json_decode(file_get_contents('php://input'), true);
            $idProduct = $data['idProduct'];
            $idUser = $data['idUser'];
            $date = $data['date'];
            $count = $data['count'];
            $status = $data['status'];
            insert_ware_house($idProduct,$idUser,$date,$count,$status);
        }
    }
?>