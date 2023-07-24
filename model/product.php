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

function product_select_all_1(){
    $sql= "SELECT products.*,type.nameType,(SELECT SUM(CASE WHEN statusWare = 'import' THEN countProduct ELSE 0 END) - SUM(CASE WHEN statusWare = 'export' THEN countProduct ELSE 0 END) 
    FROM warehouse WHERE idProduct = products.idProduct) AS totalProduct,
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
    LEFT JOIN `type` ON products.idType = type.idType
    ORDER BY idProduct;";
    return pdo_query($sql);
}
function product_select_all(){
    $sql="SELECT p.*,t.nameType,
    CONCAT_WS(',', CONCAT(UPPER('cpu'), ':', l.cpu), CONCAT(UPPER('capacity'), ':', r.capacity), CONCAT(UPPER('dpi'), ':', m.dpi), CONCAT(UPPER('resolution'), ':', mo.resolution), CONCAT(UPPER('connectionprotocol'), ':', h.connectionprotocol), CONCAT(UPPER('memory'), ':', v.memory), CONCAT(UPPER('layout'), ':', k.layout)) AS detail1,
    CONCAT_WS(',', CONCAT(UPPER('capacity'), ':', l.capacity), CONCAT(UPPER('busram'), ':', r.busram), CONCAT(UPPER('connection'), ':', m.connection), CONCAT(UPPER('sizeInch'), ':', mo.sizeInch), CONCAT(UPPER('capacitylevels'), ':', h.capacitylevels), CONCAT(UPPER('memoryspeed'), ':', v.memoryspeed), CONCAT(UPPER('connection'), ':', k.connection)) AS detail2,
    CONCAT_WS(',', CONCAT(UPPER('storage'), ':', l.storage), CONCAT(UPPER('typeram'), ':', r.typeram), CONCAT(UPPER('switch'), ':', m.switch), CONCAT(UPPER('scanfrequency'), ':', mo.scanfrequency), CONCAT(UPPER('size'), ':', h.size), CONCAT(UPPER('heartbeat'), ':', v.heartbeat), CONCAT(UPPER('switch'), ':', k.switch)) AS detail3,
    CONCAT_WS(',', CONCAT(UPPER('os'), ':', l.os), CONCAT(UPPER('ledlight'), ':', m.ledlight), CONCAT(UPPER('size'), ':', v.size), CONCAT(UPPER('keyboardmaterial'), ':', k.keyboardmaterial)) AS detail4
    FROM products p 
    LEFT JOIN ram r ON p.idProduct = r.idProduct 
    LEFT JOIN mouse m ON p.idProduct = m.idProduct 
    LEFT JOIN monitor mo ON p.idProduct = mo.idProduct 
    LEFT JOIN laptop l ON p.idProduct = l.idProduct 
    LEFT JOIN keyboard k ON p.idProduct = k.idProduct 
    LEFT JOIN harddrive h ON p.idProduct = h.idProduct 
    LEFT JOIN vga v ON p.idProduct = v.idProduct 
    LEFT JOIN type t ON p.idType = t.idType 
    ORDER BY p.idProduct;";
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

function product_update_view($ma_hh){
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
    $sql = "SELECT products.*,lo.nameType,
            CONCAT_WS(',', CONCAT(UPPER('cpu'), ':', l.cpu), CONCAT(UPPER('capacity'), ':', r.capacity), CONCAT(UPPER('dpi'), ':', m.dpi), CONCAT(UPPER('resolution'), ':', mo.resolution), CONCAT(UPPER('connectionprotocol'), ':', h.connectionprotocol), CONCAT(UPPER('memory'), ':', v.memory), CONCAT(UPPER('layout'), ':', k.layout)) AS detail1,
            CONCAT_WS(',', CONCAT(UPPER('capacity'), ':', l.capacity), CONCAT(UPPER('busram'), ':', r.busram), CONCAT(UPPER('connection'), ':', m.connection), CONCAT(UPPER('sizeInch'), ':', mo.sizeInch), CONCAT(UPPER('capacitylevels'), ':', h.capacitylevels), CONCAT(UPPER('memoryspeed'), ':', v.memoryspeed), CONCAT(UPPER('connection'), ':', k.connection)) AS detail2,
            CONCAT_WS(',', CONCAT(UPPER('storage'), ':', l.storage), CONCAT(UPPER('typeram'), ':', r.typeram), CONCAT(UPPER('switch'), ':', m.switch), CONCAT(UPPER('scanfrequency'), ':', mo.scanfrequency), CONCAT(UPPER('size'), ':', h.size), CONCAT(UPPER('heartbeat'), ':', v.heartbeat), CONCAT(UPPER('switch'), ':', k.switch)) AS detail3,
            CONCAT_WS(',', CONCAT(UPPER('os'), ':', l.os), CONCAT(UPPER('ledlight'), ':', m.ledlight), CONCAT(UPPER('size'), ':', v.size), CONCAT(UPPER('keyboardmaterial'), ':', k.keyboardmaterial)) AS detail4
            FROM products
            LEFT JOIN laptop l ON products.idProduct = l.idProduct
            LEFT JOIN mouse m ON products.idProduct = m.idProduct
            LEFT JOIN monitor mo ON products.idProduct = mo.idProduct
            LEFT JOIN ram r ON products.idProduct = r.idProduct
            LEFT JOIN harddrive h ON products.idProduct = h.idProduct
            LEFT JOIN vga v ON products.idProduct = v.idProduct
            LEFT JOIN keyboard k ON products.idProduct = k.idProduct
            LEFT JOIN `type` ON products.idType = type.idType
            LEFT JOIN type lo ON products.idType=lo.idType 
            WHERE nameProduct LIKE '%$keyword%' OR lo.nameType LIKE '%$keyword%' OR brand LIKE '%$keyword%'
            ORDER BY products.idProduct;";
    return pdo_query($sql);
}
