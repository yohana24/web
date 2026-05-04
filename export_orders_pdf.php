<?php
require 'vendor/autoload.php';
include 'db.php';

use Dompdf\Dompdf;

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

$html = "
<h2 style='text-align:center;'>Orders Report</h2>
<table border='1' width='100%' cellpadding='8'>
<tr>
<th>Order Number</th>
<th>Total</th>
<th>Status</th>
<th>Date</th>
</tr>
";

while($row = $result->fetch_assoc()){
    $html .= "
    <tr>
        <td>{$row['order_number']}</td>
        <td>{$row['total_amount']}</td>
        <td>{$row['status']}</td>
        <td>{$row['created_at']}</td>
    </tr>";
}

$html .= "</table>";

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("orders_report.pdf", ["Attachment" => true]);
?>