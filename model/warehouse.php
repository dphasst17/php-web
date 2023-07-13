<?php 
    require_once 'pdo.php';

    function insert_ware_house($idProduct,$idUser,$date,$count,$status){
        $sql = "INSERT INTO warehouse(idProduct,idpersonIOX,dateIOX,countProduct,statusWare) VALUES(?,?,?,?,?);";
        pdo_execute($sql,$idProduct,$idUser,$date,$count,$status);
    }
    function getWareHouse_by_status($statusWare){
        $sql = "SELECT * FROM warehouse WHERE statusWare = ? ;";
        return pdo_query($sql,$statusWare);
    }
    function get_total_product_in_ware(){
        $sql = "SELECT idProduct, 
                SUM(CASE WHEN statusWare = 'import' THEN countProduct ELSE 0 END) - SUM(CASE WHEN statusWare = 'export' THEN countProduct ELSE 0 END) 
                AS totalProduct FROM warehouse GROUP BY idProduct;";
        return pdo_query($sql);
    }
?>