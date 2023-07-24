<?php
require_once 'pdo.php';

/**
 * Thêm loại mới
 * @param String $ten_loai là tên loại
 * @throws PDOException lỗi thêm mới
 */
function type_insert($ten_loai){
    $sql = "INSERT INTO type(nameType) VALUES(?)";
    pdo_execute($sql, $ten_type);
}

function select_min_max_in_type(){
    $sql = "SELECT l.idType,l.nameType, MIN(h.price)AS min, ((MIN(h.price)+ MAX(h.price))/2) AS medium,MAX(h.price) AS max 
            from `type` l JOIN `products` h ON l.idType = h.idType GROUP BY l.idType;";
    return pdo_query($sql);
}
/**
 * Cập nhật tên loại
 * @param int $ma_loai là mã loại cần cập nhật
 * @param String $ten_loai là tên loại mới
 * @throws PDOException lỗi cập nhật
 */
function loai_update($ma_loai, $ten_loai){
    $sql = "UPDATE loai SET nameType=? WHERE idType=?";
    pdo_execute($sql, $ten_loai, $ma_loai);
}
/**
 * Xóa một hoặc nhiều loại
 * @param mix $ma_loai là mã loại hoặc mảng mã loại
 * @throws PDOException lỗi xóa
 */
function loai_delete($ma_loai){
    $sql = "DELETE FROM type WHERE idType=?";
    if(is_array($ma_loai)){
        foreach ($ma_loai as $ma) {
            pdo_execute($sql, $ma);
        }
    }
    else{
        pdo_execute($sql, $ma_loai);
    }
}
/**
 * Truy vấn tất cả các loại
 * @return array mảng loại truy vấn được
 * @throws PDOException lỗi truy vấn
 */
function loai_select_all(){
    $sql = "SELECT * FROM type";
    return pdo_query($sql);
}
/**
 * Truy vấn một loại theo mã
 * @param int $ma_loai là mã loại cần truy vấn
 * @return array mảng chứa thông tin của một loại
 * @throws PDOException lỗi truy vấn
 */
function loai_select_by_id($ma_loai){
    $sql = "SELECT * FROM type WHERE idType=?";
    return pdo_query_one($sql, $ma_loai);
}
/**
 * Kiểm tra sự tồn tại của một loại
 * @param int $ma_loai là mã loại cần kiểm tra
 * @return boolean có tồn tại hay không
 * @throws PDOException lỗi truy vấn
 */
function loai_exist($ma_loai){
    $sql = "SELECT count(*) FROM type WHERE idType=?";
    return pdo_query_value($sql, $ma_loai) > 0;
}