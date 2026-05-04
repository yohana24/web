<?php
include 'db.php';

$type = $_GET['type'] ?? 'daily';

$where = "";

if($type == 'daily'){
    $where = "DATE(created_at) = CURDATE()";
}
elseif($type == 'monthly'){
    $where = "MONTH(created_at) = MONTH(CURDATE())
              AND YEAR(created_at) = YEAR(CURDATE())";
}
elseif($type == 'yearly'){
    $where = "YEAR(created_at) = YEAR(CURDATE())";
}
else{
    $where = "1=1";
}

$sql = "SELECT * FROM orders WHERE $where";
$result = $conn->query($sql);

$filename = "backup_" . $type . "_" . date("Y-m-d_H-i-s") . ".sql";

header('Content-Type: application/sql');
header('Content-Disposition: attachment; filename='.$filename);

echo "-- Backup File\n";
echo "-- Type: $type\n";
echo "-- Date: ".date("Y-m-d H:i:s")."\n\n";

while($row = $result->fetch_assoc()){

    echo "INSERT INTO orders (order_number, total_amount, status, created_at) VALUES (";

    echo "'".$row['order_number']."',";
    echo "'".$row['total_amount']."',";
    echo "'".$row['status']."',";
    echo "'".$row['created_at']."');\n";
}
?>