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
        $sql = "SELECT w.idProduct,p.nameProduct,p.imgProduct,p.price,
            SUM(CASE WHEN statusWare = 'import' THEN countProduct ELSE 0 END) - SUM(CASE WHEN statusWare = 'export' THEN countProduct ELSE 0 END) 
            AS totalProduct FROM warehouse w JOIN products p ON w.idProduct = p.idProduct GROUP BY w.idProduct;";
        return pdo_query($sql);
    }
    function get_all_warehouse(){
        $sql="SELECT w.*,p.nameProduct FROM `warehouse` w JOIN products p ON w.idProduct = p.idProduct ORDER BY dateIOX DESC;";
        return pdo_query($sql);
    }
    function delete_warehouse_by_id($idWarehouse){
        $sql="DELETE FROM warehouse WHERE id=?;";
        pdo_execute($sql,$idWarehouse);
    }
?>