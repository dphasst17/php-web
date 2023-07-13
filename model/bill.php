<?php 
    require_once 'pdo.php';
    function select_bill_by_id($ma_kh){
        $sql = "SELECT p.nameProduct,p.price,p.imgProduct,h.countProduct FROM `bills` h JOIN `products` p ON h.idProduct = p.idProduct WHERE h.idUser = ?;";
        return pdo_query($sql,$ma_kh);
    }