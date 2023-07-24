<?php
include_once '../model/product.php';
include_once '../model/type.php';
class ProductController
{
    public function getById($id)
    {
        echo $id;
    }
    public function getAll()
    {
        $products = product_select_all();
        $newProducts = [];
        foreach ($products as $product) {
            $newProduct = [];
            foreach ($product as $key => $value) {
                if (!is_int($key)) {
                $newProduct[$key] = $value;
                }
            }
            $newProducts[] = $newProduct;
        }
        header('Content-type: text/javascript');
        echo json_encode($newProducts, JSON_PRETTY_PRINT);
    }
    public function deleteProduct(){
        $data = json_decode(file_get_contents('php://input'), true);
        $idProduct = $data['idProduct'];
        $delete = hang_hoa_delete($idProduct);
    }
    public function getAccess(){
        $access = product_select_by_loai('!=',1);
        $accessory = [];
        foreach ($access as $newAccess) {
            $newProduct = [];
            foreach ($newAccess as $key => $value) {
                if (!is_int($key)) {
                $newProduct[$key] = $value;
                }
            }
            $accessory[] = $newProduct;
        }
        header('Content-type: text/javascript');
        echo json_encode($accessory, JSON_PRETTY_PRINT);
    }
    public function getLap(){
        $laptop = product_select_by_loai('=',1);
        $laptops = [];
        foreach ($laptop as $newLaptop) {
            $newProduct = [];
            foreach ($newLaptop as $key => $value) {
                if (!is_int($key)) {
                $newProduct[$key] = $value;
                }
            }
            $laptops[] = $newProduct;
        }
        header('Content-type: text/javascript');
        echo json_encode($laptops, JSON_PRETTY_PRINT);
    }
    public function getNew(){
        $new = product_select_by_date();
        $newProduct = [];
        foreach ($new as $newProducts) {
            $news = [];
            foreach ($newProducts as $key => $value) {
                if (!is_int($key)) {
                $news[$key] = $value;
                }
            }
            $newProduct[] = $news;
        }
        header('Content-type: text/javascript');
        echo json_encode($newProduct, JSON_PRETTY_PRINT);
    }
    public function getView(){
        $view = product_select_view(); 
        $viewProducts = [];
        foreach ($view as $viewProduct) {
            $news = [];
            foreach ($viewProduct as $key => $value) {
                if (!is_int($key)) {
                $news[$key] = $value;
                }
            }
            $viewProducts[] = $news;
        }
        header('Content-type: text/javascript');
        echo json_encode($viewProducts, JSON_PRETTY_PRINT);
    }
    public function getType(){
        $type = loai_select_all();
        echo json_encode($type, JSON_PRETTY_PRINT);
    }
    public function detail($idProduct){
        $detail = product_select_by_id($idProduct);
        echo json_encode($detail, JSON_PRETTY_PRINT);
    }
    public function image(){
        $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
        $name = isset($_POST['name']) ?$_POST['name']:'';
        $imgUrl = isset($_POST['imgUrl']) ? $_POST['imgUrl'] : '';
        $price = isset($_POST['price']) ?$_POST['price']:'';
        $cate = isset($_POST['cate']) ?$_POST['cate']:'';
        $date = isset($_POST['date']) ?$_POST['date']:'';
        $des = isset($_POST['des']) ?$_POST['des']:'';
        $idP = isset($_POST['id']) ?$_POST['id']:'';
        if(isset($_FILES['imgFile'])){
            if(isset($_FILES['imgFile']['name'])){
                // file name
                $filename = $_FILES['imgFile']['name'];
                // Location
                $location = '../public/images/product/'.$filename;
            
                // file extension
                $file_extension = pathinfo($location, PATHINFO_EXTENSION);
                $file_extension = strtolower($file_extension);
            
                // Valid extensions
                $valid_ext = array("pdf","doc","docx","jpg","png","jpeg");
            
                $response = 0;
                if(in_array($file_extension,$valid_ext)){
                    // Upload file
                    if(move_uploaded_file($_FILES['imgFile']['tmp_name'],$location)){
                        $response = 1;
                    } 
                }
                switch($fname)
                    {
                        case 'add':
                            product_insert($name,$price,$filename,$cate,$date,$des);
                            break;
                        case 'update':
                            product_update($name,$price,$imgUrl,$cate,$date,$des,$idP);
                            break;
                    }
                exit;
            }
        }else{
            switch($fname)
                {
                    case 'add':
                        product_insert($name,$price,$imgUrl,$cate,$date,$des);
                        break;
                    case 'update':
                        product_update($name,$price,$imgUrl,$cate,$date,$des,$idP);
                        break;
                }
            exit;
        }
    }
    public function updateViewProduct(){
        $data = json_decode(file_get_contents('php://input'), true);
        $idProduct = $data['idProduct'];
        product_update_view($idProduct);
    }

    public function typeStatistics(){
        $data = select_min_max_in_type();
        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}
?>