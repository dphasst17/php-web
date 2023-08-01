<?php
require_once 'pdo.php';


function upload_image($image,$ma_kh){
    $sql = "UPDATE users SET img = ? WHERE idUser=?;";
    pdo_execute($sql,$image,$ma_kh);
}
function update_user($name,$email,$id){
    $sql = "UPDATE users SET nameUser = ?, email = ? WHERE idUser=?;";
    pdo_execute($sql,$name,$email,$id);
}

function user_insert($ma_kh, $mat_khau, $ho_ten, $email, $hinh, $kich_hoat, $vai_tro){
    $sql = "INSERT INTO users(idUser, password, nameUser, email, img, roleUser) VALUES (?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $ma_kh, $mat_khau, $ho_ten, $email, $hinh, $vai_tro==2);
}

function user_update($ma_kh, $mat_khau, $ho_ten, $email, $hinh, $kich_hoat, $vai_tro){
    $sql = "UPDATE users SET password=?,nameUser=?,email=?,img=?,roleUser=? WHERE idUser=?";
    pdo_execute($sql, $mat_khau, $ho_ten, $email, $hinh, $vai_tro==2, $ma_kh);
}
function user_change_pass($new_pass,$ma_kh){
    $sql = "UPDATE users SET password = ? WHERE idUser=?;";
    pdo_execute($sql,$new_pass,$ma_kh);
}
function user_update_infor($ma_kh, $ho_ten, $email, $hinh){
    $sql = "UPDATE users SET nameUser=?,email=?,img=? WHERE idUser=?";
    pdo_execute($sql, $mat_khau, $ho_ten, $email, $hinh, $ma_kh);
}
function user_delete($ma_kh){
    $sql = "DELETE FROM users WHERE idUser=?";
    if(is_array($ma_kh)){
        foreach ($ma_kh as $ma) {
            pdo_execute($sql, $ma);
        }
    }
    else{
        pdo_execute($sql, $ma_kh);
    }
}

function user_select_all(){
    $sql = "SELECT * FROM users";
    return pdo_query($sql);
}

function user_select_by_id($ma_kh){
    $sql = "SELECT * FROM users WHERE idUser=? OR nameUser=?";
    return pdo_query_one($sql, $ma_kh,$ma_kh);
}

function user_exist($ma_kh){
    $sql = "SELECT count(*) FROM users WHERE idUser=?";
    return pdo_query_value($sql, $ma_kh) > 0;
}

function user_select_by_role($vai_tro){
    $sql = "SELECT * FROM users WHERE roleUser=?";
    return pdo_query($sql, $vai_tro);
}

function user_change_password($ma_kh, $mat_khau_moi){
    $sql = "UPDATE users SET password=? WHERE idUser=?";
    pdo_execute($sql, $mat_khau_moi, $ma_kh);
}
function user_login($ma_kh,$mat_khau){
    $sql = "SELECT * FROM users WHERE idUser = ? AND password=?";
    return pdo_query($sql,$ma_kh,$mat_khau);
}
function user_login_email($email){
    $sql = "SELECT * FROM users WHERE email = ?;";
    return pdo_query($sql,$email);
}
function insert_user_with_email($idUser,$name,$email){
    $sql = "INSERT INTO users (idUser,password,nameUser,img,email,roleUser)VALUES(?,'',?,'',?,2);";
    pdo_execute($sql, $idUser, $name, $email);
}