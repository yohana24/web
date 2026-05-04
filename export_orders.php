<?php
include 'db.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=orders_report.xls");

$from = $_GET['from'] ?? null;
$to = $_GET['to'] ?? null;

$where = "1=1";

if($from && $to){
    $where = "DATE(created_at) BETWEEN '$from' AND '$to'";
}
elseif($from){
    $where = "DATE(created_at) >= '$from'";
}
elseif($to){
    $where = "DATE(created_at) <= '$to'";
}

$sql = "SELECT order_number, total_amount, status, created_at
        FROM orders
        WHERE $where
        ORDER BY created_at DESC";

$result = $conn->query($sql);

echo "Order Number\tTotal\tStatus\tDate\n";

while($row = $result->fetch_assoc()){
    echo $row['order_number']."\t";
    echo $row['total_amount']."\t";
    echo $row['status']."\t";
    echo $row['created_at']."\n";
}
?>