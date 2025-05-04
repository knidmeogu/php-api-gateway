<?php
header('Content-Type: application/json');

$request_path = $_GET['request_path'] ?? '';
$valid_api_keys = 
    [
        'key123' => 'UserA', 
        'key456' => 'UserB'
    ];
$api_key = $_SERVER['HTTP_X_API_KEY'] ?? null;

// Authentication
if (!isset($valid_api_keys[$api_key])) 
{
    http_response_code(401);
    echo json_encode(["error" => "Invalid or missing API Key"]);
    exit;
}

// Rate limiting
$rate_file = "ratelimit_data/$api_key.json";
$limit = 10;
$window = 60; // seconds
$current_time = time();

if (file_exists($rate_file)) 
{
    $data = json_decode(file_get_contents($rate_file), true);
    if ($current_time - $data['timestamp'] < $window) 
    {
        if ($data['count'] >= $limit) 
        {
            http_response_code(429);
            echo json_encode(["error" => "Rate limit exceeded"]);
            exit;
        } 
        
        else 
        {
            $data['count']++;
        }
    } 
    
    else 
    {
        $data = 
        [
            "timestamp" => $current_time, 
            "count" => 1
        ];
    }
} 

else 
{
    $data = 
    [
        "timestamp" => $current_time, 
        "count" => 1
    ];
}
file_put_contents($rate_file, json_encode($data));

// Routing
switch ($request_path) 
{
    case 'users':
        include 'services/service_users.php';
        break;
    case 'products':
        include 'services/service_products.php';
        break;
    default:
        http_response_code(404);
        echo json_encode(["error" => "Not Found"]);
}

// Logging
$log_line = sprintf("[%s] - IP: %s - API Key: %s - Path: %s - Status: %d\n",
    date('Y-m-d H:i:s'),
    $_SERVER['REMOTE_ADDR'],
    $api_key ?? 'None',
    $request_path,
    http_response_code()
);
file_put_contents('logs/gateway.log', $log_line, FILE_APPEND);
