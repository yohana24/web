<?php
session_start();
include 'db.php';

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

    // تجهيز استعلام للتحقق من الكمية في الجدول
    $check = $conn->prepare("SELECT stock_quantity FROM products WHERE product_id=?");
    $check->bind_param("i",$product_id);
    $check->execute();
    $res = $check->get_result()->fetch_assoc();

    // إذا المنتج مش موجود أو الكمية غير كافية
    if(!$res || $res['stock_quantity'] < $qty){
        echo json_encode([
            'success'=>false,
            'message'=>'Product '.$item['name'].' out of stock' // رسالة الخطأ
        ]);
        exit;
    }
}

// ===== حساب المجموع الكلي =====
$total = 0;
foreach($cart as $i){
    $total += $i['price'] * $i['quantity'];
}

// ===== إنشاء رقم الطلب الفريد =====
date_default_timezone_set('Africa/Cairo'); // وقت القاهرة المحلي

do {
    $order_number = 'ORD_' . date('Y-m-d_H-i-s') . '_' . rand(100,999);

    $check_stmt = $conn->prepare("SELECT order_id FROM orders WHERE order_number=?");
    $check_stmt->bind_param("s", $order_number);
    $check_stmt->execute();
    $check_res = $check_stmt->get_result();
} while($check_res->num_rows > 0); // استمر إذا الرقم موجود مسبقًا

// ===== إدخال الطلب في جدول orders =====
$stmt = $conn->prepare(
    "INSERT INTO orders
    (user_id,order_number,total_amount,status,created_at)
    VALUES(?,?,?,'Pending',NOW())"
);
$stmt->bind_param(
    "isd",
    $user_id,       // معرف المستخدم
    $order_number,  // رقم الطلب
    $total          // المجموع الكلي
);

if(!$stmt->execute()){
    echo json_encode([
        'success'=>false,
        'message'=>$stmt->error
    ]);
    exit;
}
$order_id = $conn->insert_id; // أخذ رقم الطلب اللي اتسجل

// ===== إدخال المنتجات في جدول order_items =====
$item_stmt = $conn->prepare(
    "INSERT INTO order_items
    (order_id,product_id,quantity,price,subtotal,note)
    VALUES (?,?,?,?,?,?)"
);

foreach($cart as $item){
    $subtotal = $item['price'] * $item['quantity']; // حساب المجموع لكل منتج
    $note = $item['note'] ?? ""; // الملاحظات (اختيارية)

    $item_stmt->bind_param(
        "iiidds",
        $order_id,          // رقم الطلب
        $item['product_id'],// معرف المنتج
        $item['quantity'],  // الكمية
        $item['price'],     // سعر الوحدة
        $subtotal,          // المجموع
        $note               // الملاحظة
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
    'order_number'=>$order_number // رقم الطلب لتأكيده في الواجهة
]);

?>