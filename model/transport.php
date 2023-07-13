<?php
    require_once 'pdo.php';
    function insert_product_onTransport_table($ma_kh){
        $sql="INSERT INTO transports(idUser,idProduct,countProduct) SELECT idUser,idProduct,countProduct FROM carts WHERE idUser = ?;";
        pdo_execute($sql,$ma_kh);
    }
    function add_infor_user_onTransport_table($name,$phone,$city,$methods,$costs,$ma_kh){
        $sql = "UPDATE transports SET status='Chờ xác nhận', fullName='$name', phone='$phone', address='$city', method='$methods', costs='$costs' WHERE idUser = ?;";
        pdo_execute($sql,$ma_kh);
    };

    function update_status_by_id($status,$id){
        $sql = "UPDATE transports SET status = ? WHERE idTrans = ?;";
        pdo_execute($sql,$status,$id);
    }
    function update_status_all($newStatus,$oldStatus){
        $sql = "UPDATE transports SET status = ? WHERE status = ?;";
        pdo_execute($sql,$newStatus,$oldStatus);
    }
    function insert_data_to_bills(){
        $sql = "INSERT INTO bills(idUser,idProduct,dateBuy,countProduct,totalProduct) SELECT o.idUser,o.idProduct,(?)AS dateBuy,o.countProduct,(o.countProduct * p.price)AS totalProduct 
                FROM transports o JOIN products p ON o.idProduct = p.idProduct WHERE status = 'Thành công';";
        pdo_execute($sql);   
    }
    function select_transport(){
        $sql = "SELECT * from transports ORDER BY idUser;";
        return pdo_query($sql);
    }
    function view_transport_by_user($ma_kh){
        $sql = "SELECT h.nameProduct, h.price, v.countProduct, v.status FROM `transports` v JOIN `products` h ON v.idProduct = h.idProduct WHERE idUser = ?;";
        return pdo_query($sql,$ma_kh);
    }
    function delete_item($ma_vc){
        $sql = "DELETE FROM transports WHERE idTrans = ?;";
        pdo_execute($sql,$ma_vc);
    }

