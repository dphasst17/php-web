<?php
require_once 'pdo.php';

function add_to_cart($idUser,$idProduct,$count){
    $data = select_product_in_cart_detail($idUser,$idProduct);
    if (!empty($data)) {
        $product = $data[0];
        update_cart($product['countProduct'] + 1,$product['idCart']);
    } else {
        $sql = "INSERT INTO carts(idUser,idProduct,countProduct) VALUES (?,?,?);";
        pdo_execute($sql,$idUser,$idProduct,$count);
    } 
}

function select_product_in_cart_detail($ma_kh,$ma_hh){
    $sql = "SELECT p.idProduct,p.nameProduct,c.countProduct,c.idCart FROM carts c JOIN products p ON c.idProduct = p.idProduct WHERE idUser = ? AND c.idProduct = ?;";
    return pdo_query($sql,$ma_kh,$ma_hh);
}

function select_product_in_cart($ma_kh){
    $sql = "SELECT p.idProduct,p.nameProduct, p.price,p.imgProduct,c.* FROM carts c JOIN products p ON c.idProduct = p.idProduct WHERE idUser = ?;";
    return pdo_query($sql,$ma_kh);
}

function update_cart($count,$ma_gh){
    $sql = "UPDATE carts SET countProduct = ? WHERE idCart = ?;";
    pdo_execute($sql,$count,$ma_gh);
}

function delete_cart($ma_gh){
    $sql = "DELETE FROM carts WHERE idCart = $ma_gh;";
    pdo_execute($sql);
}
function delete_cart_all($ma_kh){
    $sql = "DELETE FROM carts WHERE idUser = '$ma_kh';";
    pdo_execute($sql);
}
function product_insert($ten_hh, $don_gia, $hinh, $ma_loai, $ngay_nhap, $mo_ta){
    $sql = "INSERT INTO products(nameProduct, price, discount, imgProduct, idType, view, dateAdded, `des`) VALUES (?,?,'0',?,?,'0',?,?);";
    pdo_execute($sql, $ten_hh, $don_gia, $hinh, $ma_loai, $ngay_nhap, $mo_ta);
}

function product_update($ten_hh, $don_gia, $hinh, $ma_loai, $ngay_nhap, $mo_ta,$ma_hh){
    $sql = "UPDATE products SET nameProduct=?,price=?,imgProduct=?,idType=?,dateAdded=?,`des`=? WHERE idProduct=?";
    pdo_execute($sql, $ten_hh, $don_gia, $hinh, $ma_loai, $ngay_nhap, $mo_ta, $ma_hh);
}

function product_delete($ma_hh){
    $sql = "DELETE FROM products WHERE  idProduct=?";
    pdo_execute($sql, $ma_hh);
}

function product_select_all(){
    $sql= "SELECT products.*,
    CASE
        WHEN products.idType = 1 THEN CONCAT('CPU:',laptop.cpu)
        WHEN products.idType = 2 THEN CONCAT('LAYOUT:',keyboard.layout)
        WHEN products.idType = 3 THEN CONCAT('RESOLUTION:',monitor.resolution)
        WHEN products.idType = 4 THEN CONCAT('CAPACITY:',ram.capacity)
        WHEN products.idType = 5 THEN CONCAT('CONNECTION:',harddrive.connectionprotocol)
        WHEN products.idType = 6 THEN CONCAT('MEMORY:',vga.memory)
        WHEN products.idType = 7 THEN CONCAT('DPI:',mouse.dpi)
        
    END AS detail1,
    CASE
        WHEN products.idType = 1 THEN CONCAT('RAM:',laptop.ram)
        WHEN products.idType = 2 THEN CONCAT('CONNECTION:',keyboard.connection)
        WHEN products.idType = 3 THEN CONCAT('SIZE INCH:',monitor.sizeInch)
        WHEN products.idType = 4 THEN CONCAT('BUS RAM:',ram.busram)
        WHEN products.idType = 5 THEN CONCAT('CAPACITY LEVELS:',harddrive.capacitylevels)
        WHEN products.idType = 6 THEN CONCAT('MEMORY SPEED:',vga.memoryspeed)
        WHEN products.idType = 7 THEN CONCAT('CONNECTION:',mouse.connection)
    END AS detail2,
    CASE
        WHEN products.idType = 1 THEN CONCAT('STORAGE:',laptop.storage)
        WHEN products.idType = 2 THEN CONCAT('SWITCH:',keyboard.switch)
        WHEN products.idType = 3 THEN CONCAT('SCAN FREQUENCY:',monitor.scanfrequency)
        WHEN products.idType = 4 THEN CONCAT('TYPE:',ram.typeram)
        WHEN products.idType = 5 THEN CONCAT('SIZE:',harddrive.size)
        WHEN products.idType = 6 THEN CONCAT('HEARTBEAT:',vga.heartbeat)
        WHEN products.idType = 7 THEN CONCAT('SWITCH:',mouse.switch)
    END AS detail3
    FROM products
    LEFT JOIN laptop ON products.idProduct = laptop.idProduct
    LEFT JOIN mouse ON products.idProduct = mouse.idProduct
    LEFT JOIN monitor ON products.idProduct = monitor.idProduct
    LEFT JOIN ram ON products.idProduct = ram.idProduct
    LEFT JOIN harddrive ON products.idProduct = harddrive.idProduct
    LEFT JOIN vga ON products.idProduct = vga.idProduct
    LEFT JOIN keyboard ON products.idProduct = keyboard.idProduct
    ORDER BY idProduct;";
    return pdo_query($sql);
}

function product_select_by_id($ma_hh){
    $sql = "SELECT * FROM products WHERE idProduct=?";
    return pdo_query_one($sql, $ma_hh);
}

function product_select_by_date(){
    $sql = "SELECT * FROM `products` ORDER BY dateAdded DESC LIMIT 0,4;";
    return pdo_query($sql);
}
function product_exist($ma_hh){
    $sql = "SELECT count(*) FROM products WHERE idProduct=?";
    return pdo_query_value($sql, $ma_hh) > 0;
}

function product_tang_so_luot_xem($ma_hh){
    $sql = "UPDATE products SET view = view + 1 WHERE idProduct=?";
    pdo_execute($sql, $ma_hh);
}

function product_select_view(){
    $sql = "SELECT * FROM products ORDER BY view DESC LIMIT 0, 8";
    return pdo_query($sql);
}


function product_select_by_loai($operator, $ma_loai){
    $sql = "SELECT * FROM products WHERE idType $operator ?";
    return pdo_query($sql, $ma_loai);
}

function product_select_by_loai_different_id($operator, $ma_loai, $ma_hh){
    $sql = "SELECT * FROM products WHERE idType $operator ? AND idProduct != ? ORDER BY RAND() LIMIT 0,5;";
    return pdo_query($sql, $ma_loai , $ma_hh);
}

function product_select_keyword($keyword){
    $sql = "SELECT * FROM products hh JOIN type lo ON lo.idType=hh.idType WHERE nameProduct LIKE '%$keyword%' OR nameType LIKE '%$keyword%';";
    return pdo_query($sql);
}
