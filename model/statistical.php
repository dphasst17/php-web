<?php
require_once 'pdo.php';
function select_top5_product_by_count(){
    $sql = "SELECT h.idProduct,p.idType,SUM(`countProduct`)AS count 
        FROM `bills` h JOIN `products` p ON h.idProduct = p.idProduct GROUP BY `idProduct` 
        ORDER BY SUM(`countProduct`) DESC LIMIT 0,5;";
    return pdo_query($sql);
}
function select_top5_type_by_count(){
    $sql = "SELECT p.idType,SUM(`countProduct`)AS count 
    FROM `bills` h JOIN `products` p ON h.idProduct = p.idProduct GROUP BY p.idType ORDER BY SUM(`countProduct`) DESC LIMIT 0,5";
    return pdo_query($sql);
}
function top5_product_view(){
    $sql = "SELECT * FROM `products` ORDER BY `view` DESC LIMIT 0,5;";
    return pdo_query($sql);
}
function monthly_revenue(){
    $sql="SELECT SUM(totalProduct)AS doanh_thu, DATE_FORMAT(dateBuy, '%Y-%m') AS month FROM bills GROUP BY month ORDER BY month ASC;";
    return pdo_query($sql);
}