<?php
session_start();
include 'db.php';

// رقم الترابيزة محفوظ من login.php بعد مسح QR
$table_id = $_SESSION['table_id'] ?? null;

// منع الطلب لو ما فيش table_id
if(!$table_id){
    echo json_encode([
        'success'=>false,
        'message'=>'Please scan table QR code first'
    ]);
    exit;
}

// ===== تحديد نوع المحتوى للرد بالـ JSON =====
header('Content-Type: application/json');

// ===== التحقق من تسجيل الدخول =====
$user_id = $_SESSION['user_id'] ?? null; 
if(!$user_id){
    echo json_encode([
        'success'=>false,
        'message'=>'Not logged in' 
    ]);
    exit;
}

// ===== جلب البيانات المرسلة من الـ JS =====
$input = json_decode(file_get_contents('php://input'), true);
$cart = $input['cart'] ?? []; 

// ===== التحقق من السلة =====
if(empty($cart)){
    echo json_encode([
        'success'=>false,
        'message'=>'Cart empty' // السلة فاضية
    ]);
    exit;
}

// ===== التحقق من كمية كل منتج في المخزن =====
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

// ===== حساب المجموع الكلي =====
$total = 0;
foreach($cart as $i){
    $total += $i['price'] * $i['quantity'];
}

// ===== إنشاء رقم الطلب الفريد مع الميلي ثانية لتجنب التكرار =====
date_default_timezone_set('Africa/Cairo'); // وقت القاهرة المحلي

do {
    $order_number = 'ORD_' . date('Y-m-d_H-i-s') . '_' . round(microtime(true) * 1000);

    $check_stmt = $conn->prepare("SELECT order_id FROM orders WHERE order_number=?");
    $check_stmt->bind_param("s", $order_number);
    $check_stmt->execute();
    $check_res = $check_stmt->get_result();
} while($check_res->num_rows > 0);

// ===== إدخال الطلب في جدول orders =====
$status = "Pending";

$stmt = $conn->prepare(
    "INSERT INTO orders (user_id, table_id, order_number, total_amount, status, created_at)
     VALUES (?, ?, ?, ?, ?, NOW())"
);

// ===== تصحيح bind_param =====
$stmt->bind_param(
        "iisds",
    $user_id,
    $table_id,
    $order_number,
    $total,
    $status
);

if(!$stmt->execute()){
    echo json_encode([
        'success'=>false,
        'message'=>$stmt->error
    ]);
    exit;
}

$order_id = $conn->insert_id; // رقم الطلب الجديد

// ===== إدخال المنتجات في جدول order_items =====
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

    // ===== خصم الكمية من المخزن =====
    $update = $conn->prepare("UPDATE products SET stock_quantity = stock_quantity - ? WHERE product_id=?");
    $update->bind_param("ii",$item['quantity'],$item['product_id']);
    $update->execute();
}

// ===== إرسال الرد النهائي للـ JS =====
echo json_encode([
    'success'=>true,
    'order_number'=>$order_number
]);
?>