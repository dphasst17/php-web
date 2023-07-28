<?php
require_once 'pdo.php';

function comment_insert($ma_kh, $ma_hh, $noi_dung, $ngay_bl){
    $sql = "INSERT INTO comments(idUser,idProduct,commentValue, dateComment) VALUES (?,?,?,?)";
    pdo_execute($sql, $ma_kh, $ma_hh, $noi_dung, $ngay_bl);
}

function comment_update($ma_bl, $ma_kh, $ma_hh, $noi_dung, $ngay_bl){
    $sql = "UPDATE comments SET idUser=?,idProduct=?,commentValue=?,dateComment=? WHERE idComment=?";
    pdo_execute($sql, $ma_kh, $ma_hh, $noi_dung, $ngay_bl, $ma_bl);
}

function comment_delete($ma_bl){
    $sql = "DELETE FROM comments WHERE idComment=?";
    pdo_execute($sql, $ma_bl);
}

function comment_select_all(){
    $sql = "SELECT * FROM comments bl ORDER BY dateComment DESC";
    return pdo_query($sql);
}
function comment_select_all_by_id(){
    $sql = "SELECT * FROM comments bl ORDER BY idComment ASC";
    return pdo_query($sql);
}

function comment_select_by_id($ma_bl){
    $sql = "SELECT * FROM comments WHERE idComment=?";
    return pdo_query_one($sql, $ma_bl);
}

function comment_exist($ma_bl){
    $sql = "SELECT count(*) FROM comments WHERE idComment=?";
    return pdo_query_value($sql, $ma_bl) > 0;
}
function comment_select_by_hang_hoa_user($ma_hh){
    $sql = "SELECT b.*, h.nameUser,h.img FROM comments b JOIN users h ON h.idUser=b.idUser WHERE b.idProduct=? ORDER BY dateComment DESC;";
    return pdo_query($sql, $ma_hh);
}