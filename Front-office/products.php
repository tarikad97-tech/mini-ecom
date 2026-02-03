<?php
// 1. HEADERS
// Allow access from any origin (replace * with your React URL in production)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// 2. DATABASE CONFIGURATION
$host = 'localhost';
$db_name = 'mini_ecommerce';
$username = 'root';      // Change if your DB user is different
$password = '';          // Change if your DB has a password

try {
    $conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
    $conn->exec("set names utf8");
} catch(PDOException $exception) {
    http_response_code(500);
    echo json_encode(["message" => "Connection error: " . $exception->getMessage()]);
    exit();
}

// 3. HANDLE REQUESTS
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    // Check if a specific ID was requested (e.g., products.php?id=5)
    if (isset($_GET['id'])) {
        $query = "SELECT p.*, c.name as category_name 
                  FROM products p 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  WHERE p.id = :id 
                  LIMIT 0,1";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $_GET['id']);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            echo json_encode($product);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Product not found."]);
        }
    } 
    // Otherwise, return ALL products
    else {
        $query = "SELECT p.*, c.name as category_name 
                  FROM products p 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  ORDER BY p.created_at DESC";
        
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($products);
    }
}

elseif ($method == 'POST') {
    // Example logic to Create a Product (Optional)
    $data = json_decode(file_get_contents("php://input"));

    if(
        !empty($data->name) &&
        !empty($data->price) &&
        !empty($data->category_id)
    ){
        $query = "INSERT INTO products 
                  (name, description, price, stock, image, category_id, created_at) 
                  VALUES 
                  (:name, :description, :price, :stock, :image, :category_id, NOW())";

        $stmt = $conn->prepare($query);

        // Sanitize and bind
        $stmt->bindParam(":name", htmlspecialchars(strip_tags($data->name)));
        $stmt->bindParam(":description", htmlspecialchars(strip_tags($data->description)));
        $stmt->bindParam(":price", $data->price);
        $stmt->bindParam(":stock", $data->stock);
        $stmt->bindParam(":image", $data->image);
        $stmt->bindParam(":category_id", $data->category_id);

        if($stmt->execute()){
            http_response_code(201);
            echo json_encode(["message" => "Product created successfully."]);
        } else {
            http_response_code(503);
            echo json_encode(["message" => "Unable to create product."]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["message" => "Incomplete data."]);
    }
}
?>