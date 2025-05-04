<?php
header('Content-Type: application/json');
echo json_encode
([
    [
        "id" => 1, 
        "name" => "Kenneth"
    ],

    [
        "id" => 2, 
        "name" => "Florence"
    ],

    [
        "id" => 3, 
        "name" => "Jenifer"
    ],

    [
        "id" => 4, 
        "name" => "Kristine"
    ]
]);
