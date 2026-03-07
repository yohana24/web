<?php

session_start();

include 'db.php';

header('Content-Type: application/json');

// ===== LOGIN CHECK =====
$user_id = $_SESSION['user_id'] ?? null;
if(!$user_id){
    echo json_encode([
        'success'=>false,
        'message'=>'Not logged in'
    ]);
    exit;
}

// ===== GET DATA =====
$input = json_decode(file_get_contents('php://input'), true);
$cart = $input['cart'] ?? [];

if(empty($cart)){
    echo json_encode([
        'success'=>false,
        'message'=>'Cart empty'
    ]);
    exit;
}

// ===== CHECK STOCK FOR EACH PRODUCT =====
foreach($cart as $item){
    $product_id = $item['product_id'];
    $qty = $item['quantity'];

    $check = $conn->prepare("SELECT stock_quantity FROM products WHERE product_id=?");
    $check->bind_param("i",$product_id);
    $check->execute();
    $res = $check->get_result()->fetch_assoc();

    if(!$res || $res['stock_quantity'] < $qty){
        echo json_encode([
            'success'=>false,
            'message'=>'Product '.$item['name'].' out of stock'
        ]);
        exit;
    }
}

// ===== TOTAL =====
$total = 0;
foreach($cart as $i){
    $total += $i['price'] * $i['quantity'];
}

// ===== ORDER NUMBER =====
$order_number = 'ORD'.time();

// ===== INSERT ORDER =====
$stmt = $conn->prepare(
    "INSERT INTO orders
    (user_id,order_number,total_amount,status,created_at)
    VALUES(?,?,?,'Pending',NOW())"
);
$stmt->bind_param(
    "isd",
    $user_id,
    $order_number,
    $total
);
$stmt->execute();
$order_id = $conn->insert_id;

// ===== INSERT ITEMS =====
$item_stmt = $conn->prepare(
    "INSERT INTO order_items
    (order_id,product_id,quantity,price,subtotal,note)
    VALUES (?,?,?,?,?,?)"
);

foreach($cart as $item){
    $subtotal = $item['price'] * $item['quantity'];
    $note = $item['note'] ?? "";

    $item_stmt->bind_param(
        "iiidds",
        $order_id,
        $item['product_id'],
        $item['quantity'],
        $item['price'],
        $subtotal,
        $note
    );
    $item_stmt->execute();

    // ===== DEDUCT STOCK =====
    $update = $conn->prepare("UPDATE products SET stock_quantity = stock_quantity - ? WHERE product_id=?");
    $update->bind_param("ii",$item['quantity'],$item['product_id']);
    $update->execute();
}

echo json_encode([
    'success'=>true,
    'order_number'=>$order_number
]);

?>