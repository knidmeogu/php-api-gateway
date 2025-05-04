<?php
header('Content-Type: application/json');
echo json_encode
([
    [
        "sku" => "product1", 
        "productName" => "vape device"
    ],

    [
        "sku" => "produtc2", 
        "productName" => "vape juice"
    ],

    [
        "sku" => "product3", 
        "productName" => "vape pod"
    ]
]);
