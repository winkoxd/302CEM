<?php

/*
Expected Format
[
   {
        "item_no,qty": "A001",
        "price_per_item": "10",
        "retailer_id": "5.5",
        "expected_shipment_date": "R001",
        "manufacturer_id": "2019-01-25  16:30:00",
        "null": ["M001"]
    }
    {
        "item_no,qty": "A002",
        "price_per_item": "5",
        "retailer_id": "6",
        "expected_shipment_date": "R001",
        "manufacturer_id": "2019-01-25  12:30:00",
        "null": ["M001"]
    }
]
*/

$servername = 'localhost';
$username = '302';
$password = '302';

if(isset($_GET['expKey'])) {
    $item_no = $_GET['expKey'];
}

try {
    $conn = new PDO("mysql:host=${servername};dbname=302", $username, $password, []);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    if(isset($_GET['expKey'])) {   
        $sql = "SELECT * FROM `exp_logistic` WHERE `exp_key` = $item_no";
    }else{
        $sql = 'SELECT * FROM `exp_logistic`';
    }
    $result = [];
    foreach ($conn->query($sql) as $row) {
        $result[] = $row;
    }
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
